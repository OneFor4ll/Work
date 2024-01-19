<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->library(array('pagination', 'parser'));
    }
    public function index() {
        $usersPerPage = $this->input->get('users_per_page') ?? $this->session->userdata('users_per_page') ?? 5; 
        $currentPage = $this->input->get('page') ?? 1; 
        
        $totalUsers = $this->User_model->get_total_users();
    
        $totalPages = ceil($totalUsers / $usersPerPage);
        
        $currentPage = min($currentPage, $totalPages);
    
        $offset = ($currentPage - 1) * $usersPerPage;
        
        $query = "SELECT * FROM `users` WHERE role != 'admin' LIMIT $offset, $usersPerPage";
        $users = $this->db->query($query)->result();
        $this->session->set_userdata('users_per_page', $usersPerPage);
        $data = array(
            'users' => $users,
            'role' => $this->session->userdata('role'),
            'banned_user_id' => $this->session->flashdata('banned_user_id'),
            'banned_message' => $this->session->flashdata('message'),
            'usersPerPage' => $usersPerPage,
            'currentPage' => $currentPage,
            'totalPages' => $totalPages
        );
    
        $this->load->view("comum/header");
        $this->parser->parse('users_view', $data);
        $this->load->view("comum/footer");
    }
    
    
    public function ban_user($user_id) {
        $this->User_model->ban_user($user_id);
        $this->session->set_flashdata('banned_user_id', $user_id);
        $this->session->set_flashdata('message', 'User banned successfully.');
        redirect('admin');
    }
    
    public function unban_user($user_id) {
        $this->User_model->unban_user($user_id);
        $this->session->set_flashdata('banned_user_id', $user_id);
        $this->session->set_flashdata('message', 'User unbanned successfully.');
        redirect('admin');
    }
        
    public function view_user($user_id) {
        $user = $this->User_model->get_user_by_id($user_id);
        $data = array('user' => $user);
        $this->load->view('admin/user', $data);
    }

    public function assign_role_seller($user_id) {
        
        if (!$this->session->userdata('logged_in') || $this->session->userdata('role') !== 'admin') {
            redirect('admin'); 
        }
    
        
        $this->User_model->assign_role_seller($user_id);
    
        
        redirect('admin');
    }
    
    public function remove_role_seller($user_id) {
        $this->User_model->removeRoleSeller($user_id);
        $this->session->set_flashdata('message', 'Role removed successfully.');
        redirect('admin');
    }
        
    
}
