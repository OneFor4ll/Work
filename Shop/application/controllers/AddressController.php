<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AddressController extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('User_model');
        $this->load->helper('url');

    }
    
    public function addressForm() {
        $this->load->view("comum/header");
        $this->load->view('address_form');
        $this->load->view("comum/footer");
}
  
    public function saveAddress() {
      $this->load->library('form_validation');
      $this->form_validation->set_rules('address', 'Address', 'required');
      $this->form_validation->set_rules('city', 'City', 'required');
      $this->form_validation->set_rules('country', 'Country', 'required');
      $this->form_validation->set_rules('postal_code', 'Postal Code', 'required'); 
      
      if ($this->form_validation->run() == FALSE) {
          
          $this->load->view("comum/header");
          $this->load->view('address_form');
          $this->load->view("comum/footer");
  
      } else {
          
          $address = $this->input->post('address');
          $city = $this->input->post('city');
          $country = $this->input->post('country');
          $postalCode = $this->input->post('postal_code'); 
          
          $userId = $this->session->userdata('id'); 
  
          $this->User_model->saveAddress($userId, $address, $city, $country, $postalCode); 
          
          redirect('');
      }
  }
  
}

