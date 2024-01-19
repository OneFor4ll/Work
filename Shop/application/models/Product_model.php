<?php

class Product_Model extends CI_Model {
    protected $table = 'products';
    
    
    public function __construct() {
        parent::__construct();
        $this->load->database(); 
    }
    
    public function isAdmin() {
        $userRole = $this->session->userdata('role');
        return $userRole === 'admin';
    }

    public function getProducts() {
        $query = $this->db->get('products');
        return $query->result_array();
    }

    public function isSeller() {
        $userRole = $this->session->userdata('role');
        return $userRole === 'seller';
    }

    public function addProduct($product_data) {
        return $this->db->insert('products', $product_data);
    }

    public function assoc($id_user,$id_prod) {
        return $this->db->insert('users_products', [ 'user_id'=> $id_user, 'product_id' => $id_prod]);
    }
    
    public function getProductsPaginated($limit, $offset) {
        $this->db->select("products.*, users.id AS user_id");
        $this->db->from("users_products");
        $this->db->join("products", "products.id = users_products.product_id");
        $this->db->join("users", "users.id = users_products.user_id");
    
        if (!$this->isAdmin()) {
            $this->db->where('user_id', $this->session->userdata('id'));
        }
    
        $this->db->limit($limit, $offset);
    
        $query = $this->db->get();
    
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return array();
        }
    }
    
    
    
    public function getProductById($product_id) {
        $query = $this->db->get_where('products', array('id' => $product_id));
        return $query->row_array();
    }
    
    public function deleteProduct($product_id) {
        return $this->db->delete('products', array('id' => $product_id));
    }

    public function delete_all_products(){
    // Perform the deletion of all products from the database
    $this->db->empty_table('products');
    }

    public function updateProduct($id) {
        $selected_colors = $this->input->post('color');
        $color = $selected_colors ? implode(',', $selected_colors) : 'None';
    
        $selected_size = $this->input->post('size');
        $size = $selected_size ? implode(',', $selected_size) : 'None';
    
        $data = array(
            'name' => $this->input->post('name'),
            'price' => $this->input->post('price'),
            'color' => $color,
            'size' => $size,
            'promotion' => $this->input->post('promotion'),
            'type' => $this->input->post('type')
        );
    
        $promotion_percent = ($data['promotion'] ?: 0) / 100;
        $final_price = $data['price'] - ($data['price'] * $promotion_percent);
        $data['final_price'] = $final_price;
    
        if ($_FILES['image']['name']) {
            $config['upload_path'] = 'uploads';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['max_size'] = 2048; // 2MB
            $this->load->library('upload', $config);
    
            if ($this->upload->do_upload('image')) {
                $upload_data = $this->upload->data();
                $data['image'] = $upload_data['file_name'];
    
                $product = $this->getProductById($id);
                $old_image_path = 'uploads/' . $product['image'];
                if (file_exists($old_image_path)) {
                    unlink($old_image_path);
                }
            } else {
                $error = $this->upload->display_errors();
                return false;
            }
        }
    
        $this->db->where('id', $id);
        return $this->db->update($this->table, $data);
    }
    
    public function getTotalProducts() {
        $query = $this->db->get('products');
        return $query->num_rows();
    }

    public function getUserTotalProducts() {
        if (!$this->isAdmin()) {
            $this->db->where('user_id', $this->session->userdata('id'));
        }
    
        $query = $this->db->get('users_products');
        return $query->num_rows();
    }
    
}

