<?php
class Products extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model('product_model');
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->library('form_validation');
    }
    
    public function index() {
        if (!($this->session->userdata('logged_in') && ($this->product_model->isAdmin() || $this->product_model->isSeller()))) {
            redirect('auth');
        }
    
        $data['admin'] = $this->session->userdata('logged_in') && ($this->product_model->isAdmin() || $this->product_model->isSeller());
    
        $currentPage = $this->input->get('page') ? $this->input->get('page') : 1;
        $itemsPerPage = $this->input->get('items_per_page') ? (int) $this->input->get('items_per_page') : 5;
    
        $offset = ($currentPage - 1) * $itemsPerPage;
    
        $data['products'] = $this->product_model->getProductsPaginated($itemsPerPage, $offset);
    
        if ($this->product_model->isAdmin()) {
            $totalProducts = $this->product_model->getTotalProducts();
        } else {
            $totalProducts = $this->product_model->getUserTotalProducts();
        }
    
        $totalPages = ceil($totalProducts / $itemsPerPage);
    
        $data['currentPage'] = $currentPage;
        $data['itemsPerPage'] = $itemsPerPage;
        $data['totalPages'] = $totalPages;
    
        $this->load->view("comum/header");
        $this->load->view('products_view', $data);
        $this->load->view("comum/footer");
    }
    

    public function add()
    {
        if ($this->session->userdata('logged_in') && ($this->product_model->isAdmin() || $this->product_model->isSeller())) {
            $this->form_validation->set_rules('name', 'Product Name', 'required');
            $this->form_validation->set_rules('price', 'Price', 'required');
            $this->form_validation->set_rules('promotion', 'Promotion', 'numeric');
            $this->form_validation->set_rules('type', 'Type', 'required');
    
            if ($this->form_validation->run() == false) {
                $data['products'] = $this->product_model->getProducts();
                $this->load->view('products_view', $data);
            } else {
                $selected_colors = $this->input->post('color');
                $color = $selected_colors ? implode(',', $selected_colors) : 'None';
    
                $selected_size = $this->input->post('size');
                $size = $selected_size ? implode(',', $selected_size) : 'None';
    
                $product_data = array(
                    'name' => $this->input->post('name'),
                    'price' => $this->input->post('price'),
                    'color' => $color,
                    'size' => $size,
                    'promotion' => $this->input->post('promotion'),
                    'type' => $this->input->post('type')
                );
    
                $promotion_percent = $product_data['promotion'] / 100;
                $final_price = $product_data['price'] - ($product_data['price'] * $promotion_percent);
                $product_data['final_price'] = $final_price;
    
                $config['upload_path'] = 'uploads';
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $config['max_size'] = 2048; // 2MB
                $this->load->library('upload', $config);
    
                if ($this->upload->do_upload('image')) {
                    $upload_data = $this->upload->data();
                    $product_data['image'] = $upload_data['file_name'];
    
                    $product = $this->product_model->addProduct($product_data);
                    $prod_id = $this->db->insert_id();
                    $user_id = $this->session->userdata('id');
    
                    if ($product) {
                        $this->product_model->assoc($user_id, $prod_id);
                        $currentPage = $this->input->get('page') ? $this->input->get('page') : 1;
                        $this->session->set_userdata('current_page', $currentPage);
    
                        redirect($_SERVER['HTTP_REFERER']);
                    } else {
                        $data['db_error'] = 'Failed to add the product to the database.';
                        $data['products'] = $this->product_model->getProducts();
                        $this->load->view('products_view', $data);
                    }
                } else {
                    $error = $this->upload->display_errors();
                    $data['upload_error'] = $error;
                    $data['products'] = $this->product_model->getProducts();
                    $this->load->view('products_view', $data);
                }
            }
        }
    }
    
    
    public function edit($product_id)
    {
        if (!($this->session->userdata('logged_in') && ($this->product_model->isAdmin() || $this->product_model->isSeller()))) {
            redirect('auth');
        }
    
        if (!$this->product_model->isAdmin() && !$this->product_model->isSeller() && $this->product_model->getProductById($product_id)['user_id'] !== $this->session->userdata('id')) {
            redirect('products');
        }
    
        $this->form_validation->set_rules('name', 'Product Name', 'required');
        $this->form_validation->set_rules('price', 'Price', 'required');
        $this->form_validation->set_rules('promotion', 'Promotion', 'numeric');
        $this->form_validation->set_rules('type', 'Type', 'required');
    
        if ($this->form_validation->run() == false) {
            $data['product'] = $this->product_model->getProductById($product_id);
            $data['is_edit'] = true;
    
            $currentPage = $this->input->get('page') ? $this->input->get('page') : 1;
            $productsPerPage = 5;
            $offset = ($currentPage - 1) * $productsPerPage;
    
            $data['products'] = $this->product_model->getProductsPaginated($productsPerPage, $offset);
    
            $totalProducts = $this->product_model->isAdmin() ? $this->product_model->getTotalProducts() : $this->product_model->getUserTotalProducts();
    
            $totalPages = ceil($totalProducts / $productsPerPage);
    
            $data['currentPage'] = $currentPage;
            $data['productsPerPage'] = $productsPerPage;
            $data['totalPages'] = $totalPages;
    
            $this->load->view("comum/header");
            $this->load->view('products_view', $data);
            $this->load->view("comum/footer");
        } else {
            $product_data = array(
                'name' => $this->input->post('name'),
                'price' => $this->input->post('price'),
                'promotion' => $this->input->post('promotion'),
                'type' => $this->input->post('type')
            );
    
            if ($_FILES['image']['name']) {
                $config['upload_path'] = 'uploads';
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $config['max_size'] = 2048; // 2MB
                $this->load->library('upload', $config);
    
                if ($this->upload->do_upload('image')) {
                    $upload_data = $this->upload->data();
                    $product_data['image'] = $upload_data['file_name'];
    
                    $old_image = $this->product_model->getProductById($product_id)['image'];
                    if ($old_image) {
                        $old_image_path = 'uploads/' . $old_image;
                        if (file_exists($old_image_path)) {
                            unlink($old_image_path);
                        }
                    }
                } else {
                    $data['upload_error'] = $this->upload->display_errors();
                    $data['product'] = $this->product_model->getProductById($product_id);
                    $data['is_edit'] = true;
    
                    $currentPage = $this->input->get('page') ? $this->input->get('page') : 1;
                    $productsPerPage = 5;
                    $offset = ($currentPage - 1) * $productsPerPage;
    
                    $data['products'] = $this->product_model->getProductsPaginated($productsPerPage, $offset);
    
                    $totalProducts = $this->product_model->isAdmin() ? $this->product_model->getTotalProducts() : $this->product_model->getUserTotalProducts();
    
                    $totalPages = ceil($totalProducts / $productsPerPage);
    
                    $data['currentPage'] = $currentPage;
                    $data['productsPerPage'] = $productsPerPage;
                    $data['totalPages'] = $totalPages;
    
                    $this->load->view("comum/header");
                    $this->load->view('products_view', $data);
                    $this->load->view("comum/footer");
                    return;
                }
            }
    
            $result = $this->product_model->updateProduct($product_id, $product_data);
            if ($result) {
                $currentPage = $this->input->get('page') ? $this->input->get('page') : 1;
                redirect("/products?page=" . $currentPage);
            } else {
                echo "Product not found.";
            }
        }
    }
    
    
    
    public function delete($product_id) {
        $product = $this->product_model->getProductById($product_id);
    
        $this->product_model->deleteProduct($product_id);
    
        $imageFileName = $product['image'];
        if (!empty($imageFileName)) {
            $imagePath = 'uploads/' . $imageFileName;
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }
    
        redirect($_SERVER['HTTP_REFERER']);
    }
    
    
    public function delete_all() {
        $this->product_model->delete_all_products();
    
        $imageFiles = glob('uploads/*');
    
        foreach ($imageFiles as $file) {
            if (is_file($file)) {
                unlink($file);
            }
        }
    
        redirect('products');
    }
}

