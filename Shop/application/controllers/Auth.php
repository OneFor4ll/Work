<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

  public function __construct()
  {
      parent::__construct();
      $this->load->library('session');
      $this->load->helper('url');
      $this->load->database(); 
  }
  
  public function register()
{
    $this->load->model('User_model');
    $this->load->library('form_validation');

    $this->form_validation->set_rules('username', 'Username', 'required|is_unique[users.username]');
    $this->form_validation->set_rules('password', 'Password', 'required');
    $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[users.email]');
    $this->form_validation->set_rules('first_name', 'First Name', 'required');
    $this->form_validation->set_rules('last_name', 'Last Name', 'required');
    $this->form_validation->set_rules('phone_number', 'Phone Number', 'required');

    if ($this->form_validation->run() == FALSE) {
        $this->load->view("comum/header");
        $this->load->view('register');
        $this->load->view("comum/footer");
    } else {
        $user_data = array(
            'first_name' => $this->input->post('first_name'),
            'last_name' => $this->input->post('last_name'),
            'username' => $this->input->post('username'),
            'password' => $this->input->post('password'),
            'email' => $this->input->post('email'),
            'phone_number' => $this->input->post('phone_number'),
            'role' => "user"
        );

        $this->User_model->insert_user($user_data);

        $this->session->set_flashdata('success', 'Registration successful!');
        redirect('auth/login');
    }
}

  public function login() {
    $this->load->model('User_model');
    $this->load->library('form_validation');
    $this->form_validation->set_rules('username', 'Username', 'required');
    $this->form_validation->set_rules('password', 'Password', 'required');
    if ($this->form_validation->run() == FALSE) {
      
        
        $this->load->view("comum/header");
        $this->load->view('login');
        $this->load->view("comum/footer");

    } else {
        
        $user_data = array(
            'username' => $this->input->post('username'),
            'password' => $this->input->post('password')
        );
        
        $this->db->select('*');
        $this->db->from('users');
        $this->db->where('username', $user_data['username']);
        $query = $this->db->get();
        var_dump($query);
        $user = $this->User_model->get_user($user_data['username']);

        if (!$user) {
            
            $this->session->set_flashdata('error', 'User does not exist.');
            redirect('auth/login');
         } else if (!password_verify($user_data['password'], $user['password'])) {
            
            $this->session->set_flashdata('error', 'Invalid password.');
            redirect('auth/login');
        } else {
          if($user['status'] == 'banned'){
            $this->session->set_flashdata('error', 'Utilizador Banido');
            redirect('auth/login');
          }
            
            $this->session->set_userdata('user_id', $user['id']);
            
            
            $user_data = array(
                'username' => $user['username'],
                'id' => $user['id'],
                'role' => $user['role'],
                'logged_in' => true 
            );
            $this->session->set_userdata($user_data);
            
            redirect('');
        }

    }
}
  public function logout()
  {
    $this->session->sess_destroy();
    redirect(base_url());
  }
}