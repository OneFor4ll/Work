<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->database(); 
        $this->load->model('Products_model'); 
        $this->load->model('Cart_model'); 

    }

    public function view($product_id) {
        $product = $this->Products_model->get_product($product_id); 
        if ($product) {
            $data['product'] = $product;
            $this->load->view('comum/header');
            $this->load->view('product_view', $data); 
            $this->load->view('comum/footer');
        } else {
            
        }
    }

    public function addToCart() {
        if ($this->session->userdata('logged_in')) {
            $product_id = $this->input->post('product_id');
            $selectedSize = $this->input->post('selected_size');
            $selectedColor = $this->input->post('selected_color');
    
            
            $this->Cart_model->addProductToCart($product_id, $selectedSize, $selectedColor);
    
            
            $cartCount = $this->Cart_model->getCartCount();
            echo $cartCount;
        } else {
            
        }
    }
    

    
}
