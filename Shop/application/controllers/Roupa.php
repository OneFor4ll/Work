<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Roupa extends CI_Controller {
    
    public function index() {
        $this->load->helper('url'); // Load the URL Helper

        $color = $this->input->get('color');
        $type = $this->input->get('type');
        
        $this->load->model('Roupa_model');
        $this->load->model('Cart_model');
        $data['products'] = $this->Roupa_model->getProductsByFilters($color, $type);
        //$data['productsD'] = $this->Cart_model->getCartProducts()?? [];
        $data['selectedType'] = isset($_GET['type']) ? $_GET['type'] : '';

        $this->load->view("comum/header");
        $this->load->view('roupa_view', $data);
        $this->load->view("comum/footer");
    }
}
