<?php
class Login extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('login_model');
        $this->load->helper('url'); 
        $this->load->library('session'); 
        $this->load->database();
    
    }

    public function index() {
        if ($this->session->userdata('user_id')) {
            redirect('projects');
        }
        $this->load->view('login_view');
    }

    public function process_login() {
        $username = $this->input->post('username');
        $password = $this->input->post('password');
    
        $user = $this->login_model->validate_user($username, $password);
    
        if ($user) {
            $this->session->set_userdata('entity_id', $user->entity_id); 
    
            
            if ($user->role === 'admin') {
                $this->session->set_userdata('role', 'admin');
            } else if ($user->role === 'gestor') {
                $this->session->set_userdata('role', 'gestor');
            } else {
                
                $this->session->set_userdata('role', 'user');
            }
    
            redirect('projects');
        } else {
            $this->session->set_flashdata('error', 'Nome de utilizador ou palavra-passe incorretos.');
            redirect('login');
        }
    }
    
    
    
 
    public function logout() {
        $this->session->unset_userdata('entity_id');
        $this->session->unset_userdata('role'); 

        redirect('login'); 
    }
    
}
?>