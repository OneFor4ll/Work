<?php
class Cart extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->library('email');
        $this->load->model('Cart_model');
    }

    public function cartView() {
        $cartProducts = $this->Cart_model->getCartProducts();
        $totalPrice = $this->calculateTotalPrice($cartProducts);
        $totalQuantity = $this->calculateTotalQuantity($cartProducts);

        
        $user_id = $this->session->userdata('id');
        $location = $this->Cart_model->getLocation($user_id);

        
        $cardNumber = $this->session->userdata('card_number');
        $cardExpiry = $this->session->userdata('card_expiry');
        $cardCvv = $this->session->userdata('card_cvv');

        $paymentCompleted = $this->session->flashdata('payment_completed');

        $data['cartProducts'] = $cartProducts;
        $data['totalPrice'] = $totalPrice;
        $data['totalQuantity'] = $totalQuantity;
        $data['country'] = $location['country'];
        $data['phone_number'] = $location['phone_number'];
        $data['address'] = $location['address'];
        $data['postal_code'] = $location['postal_code'];
        $data['first_name'] = $location['first_name'];
        $data['last_name'] = $location['last_name'];
        $data['cardNumber'] = isset($cardNumber) ? $cardNumber : ''; 
        $data['cardExpiry'] = isset($cardExpiry) ? $cardExpiry : ''; 
        $data['cardCvv'] = isset($cardCvv) ? $cardCvv : ''; 

        $this->load->view("comum/header");
        $this->load->view('cart_view', $data);
        $this->load->view("comum/footer");
    }

    private function calculateTotalPrice($cartProducts) {
        $totalPrice = 0;

        foreach ($cartProducts as $product) {
            $totalPrice += $product->price * $product->total_quantity;
        }

        return $totalPrice;
    }

    public function add() {
        $product_id = $this->input->post('product_id');
        $selectedSize = $this->input->post('selected_size');
        $selectedColor = $this->input->post('selected_color');

        if (empty($selectedSize) || empty($selectedColor)) {
            echo "Selecione o tamanho e a cor antes de adicionar ao carrinho.";
            return;
        }

        $this->Cart_model->addProductToCart($product_id, $selectedSize, $selectedColor);
        $cartCount = $this->Cart_model->getCartCount();

        echo $cartCount;
    }

    public function count() {
        $cartCount = $this->Cart_model->getCartCount();
        echo $cartCount;
    }

    private function calculateTotalQuantity($cartProducts) {
        $totalQuantity = 0;

        foreach ($cartProducts as $product) {
            $totalQuantity += $product->total_quantity;
        }

        return $totalQuantity;
    }

    public function clear() {
        $this->Cart_model->clearCart();
        redirect('cart/view'); 
    }

    public function update_quantity() {
        $product_id = $this->input->post('product_id');
        $action = $this->input->post('action');

        
        $currentQuantity = $this->Cart_model->getProductQuantity($product_id);

        
        if ($action === 'increase') {
            $newQuantity = $currentQuantity + 1;
        } elseif ($action === 'decrease' && $currentQuantity > 1) {
            $newQuantity = $currentQuantity - 1;
        } else {
            $newQuantity = $currentQuantity;
        }

        
        if ($this->Cart_model->updateProductQuantity($product_id, $newQuantity)) {
            
            echo '<script>window.location.reload();</script>';
        } else {
            
            
            redirect('error-page');
        }
    }

    

    public function local() {
        $user_id = $this->session->userdata('id');
        $hasLocation = $this->Cart_model->hasLocation($user_id);

        $location = $this->Cart_model->getLocation($user_id);

        $cardNumber = $this->session->userdata('card_number');
        $cardExpiry = $this->session->userdata('card_expiry');
        $cardCvv = $this->session->userdata('card_cvv');

        $data['hasLocation'] = $hasLocation;
        $data['city'] = $location['city'];
        $data['address'] = $location['address'];
        $data['country'] = $location['country'];
        $data['phone_number'] = $location['phone_number'];
        $data['postal_code'] = $location['postal_code'];
        $data['first_name'] = $location['first_name'];
        $data['last_name'] = $location['last_name'];
        $data['cardNumber'] = $cardNumber;
        $data['cardExpiry'] = $cardExpiry;
        $data['cardCvv'] = $cardCvv;

        $this->load->view("comum/header");
        $this->load->view('local_view', $data);
        $this->load->view("comum/footer");
    }

    public function save_location() {
        $user_id = $this->session->userdata('id');
        $city = $this->input->post('city');
        $address = $this->input->post('address');
        $country = $this->input->post('country');
        $phone_number = $this->input->post('phone_number');
        $postal_code = $this->input->post('postal_code');
        $first_name = $this->input->post('first_name');
        $last_name = $this->input->post('last_name');

        $this->Cart_model->saveLocation($user_id, $city, $address, $country, $phone_number, $postal_code, $first_name, $last_name);

        redirect('cart/view');
    }

    

    public function pagar() {
        $this->load->view("comum/header");
        $this->load->view('payment_view');
        $this->load->view("comum/footer");
    }

    public function process_payment() {
        $cardNumber = $this->input->post('card_number');
        $cardExpiry = $this->input->post('card_expiry');
        $cardCvv = $this->input->post('card_cvv');

        $this->session->set_userdata('card_number', $cardNumber);
        $this->session->set_userdata('card_expiry', $cardExpiry);
        $this->session->set_userdata('card_cvv', $cardCvv);

        redirect('cart/view');
    }

    

    public function completePayment() {
        $this->Cart_model->clearCart();

        $this->sendOrderEmail();

        $this->session->set_flashdata('payment_completed', 'Payment was completed.');

        redirect('cart/view');
    }

    public function sendOrderEmail() {
        $cartProducts = $this->Cart_model->getCartProducts();
        $totalPrice = $this->calculateTotalPrice($cartProducts);
        $totalQuantity = $this->calculateTotalQuantity($cartProducts);
        $userEmail = $this->session->userdata('email');

        $subject = 'Order Confirmation';
        $message = 'Thank you for your order! Here are the details:' . "\n\n";
        $message .= 'Products:' . "\n";
        foreach ($cartProducts as $product) {
            $message .= '- ' . $product->name . ' (' . $product->total_quantity . ' x $' . $product->price . ')' . "\n";
        }
        $message .= "\n";
        $message .= 'Total Price: €' . $totalPrice . "\n";
        $message .= 'Total Quantity: ' . $totalQuantity . "\n";

        $this->load->library('email');
        $this->email->from('al220012@gmail.com', 'Vladimiro');
        $this->email->to($userEmail);
        $this->email->subject($subject);
        $this->email->message($message);

        if ($this->email->send()) {
            echo '<script>alert("Email sent successfully.");</script>';
        } else {
            echo '<script>alert("Error sending email. Please try again.");</script>';
        }
    }
}
?>
