<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->database(); 
        $this->load->model('registration_model');
        $this->load->helper('url');
    }

    public function index() {
        $this->load->view('registration_view');
    }

    public function process_registration() {
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('nif', 'NIF', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('phone', 'Phone', 'numeric');
        $this->form_validation->set_rules('address', 'Address', 'required');
        $this->form_validation->set_rules('manager_name', 'Manager Name', 'required');
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
        
        if ($this->form_validation->run() === FALSE) {
            $this->load->view('registration_view');
        } else {
            $name = $this->input->post('name');
            $nif = $this->input->post('nif');
            $email = $this->input->post('email');
            $phone = $this->input->post('phone');
            $address = $this->input->post('address');
            $manager_name = $this->input->post('manager_name');
            $username = $this->input->post('username');
            $password = $this->input->post('password');
            $default_role = 'user';

            if (
                $this->registration_model->is_name_exists($name) ||
                $this->registration_model->is_nif_exists($nif) ||
                $this->registration_model->is_email_exists($email) ||
                $this->registration_model->is_phone_exists($phone) ||
                $this->registration_model->is_address_exists($address) ||
                $this->registration_model->is_manager_name_exists($manager_name) ||
                $this->registration_model->is_username_exists($username) ||
                $this->registration_model->is_password_exists($password)
            ) {
                $error_messages = array();

            if ($this->registration_model->is_name_exists($name)) {
                $error_messages['name'] = 'Este nome já está em utilização.';
            }
            if ($this->registration_model->is_nif_exists($nif)) {
                $error_messages['nif'] = 'Este NIF já está em utilização.';
            }
            if ($this->registration_model->is_email_exists($email)) {
                $error_messages['email'] = 'Este endereço de email já está registado.';
            }
            if ($this->registration_model->is_phone_exists($phone)) {
                $error_messages['phone'] = 'Este número de telefone já está em utilização.';
            }
            if ($this->registration_model->is_address_exists($address)) {
                $error_messages['address'] = 'Este endereço já está em utilização.';
            }
            if ($this->registration_model->is_manager_name_exists($manager_name)) {
                $error_messages['manager_name'] = 'Este nome de gestor já está em utilização.';
            }
            if ($this->registration_model->is_username_exists($username)) {
                $error_messages['username'] = 'Este nome de utilizador já está em utilização.';
            }
            if ($this->registration_model->is_password_exists($password)) {
                $error_messages['password'] = 'Esta palavra-passe já está em utilização.';
            }

            
                $this->session->set_flashdata('custom_errors', $error_messages);
            
                $this->load->view('registration_view');
            } else {
                $data = array(
                    'name' => $name,
                    'nif' => $nif,
                    'email' => $email,
                    'phone' => $phone,
                    'address' => $address,
                    'manager_name' => $manager_name,
                    'username' => $username,
                    'password' => password_hash($password, PASSWORD_BCRYPT),
                    'role' => $default_role
                );
    
                $this->registration_model->register_user($data);
                redirect('login');
            }
        }
    }    
}
?>
