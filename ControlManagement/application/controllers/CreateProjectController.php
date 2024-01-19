<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CreateProjectController extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('CreateProjectModel');
        $this->load->model('ProjectAllocationModel');
        $this->load->helper('url');
        $this->load->database(); 
        $this->load->library('session');
    }

    public function index() {
        $this->load->view("comum/header");
        $this->load->view('create_project');
        $this->load->view("comum/footer");
    }

    public function create() {
        if ($this->session->has_userdata('entity_id')) {
            $entity_id = $this->session->userdata('entity_id');
            
            $project_data = array(
                'name' => $this->input->post('name'),
                'execution_time' => $this->input->post('execution_time'),
                'entity_id' => $entity_id
            );

            $project_id = $this->CreateProjectModel->createProject($project_data);

            if ($project_id !== false) {
                $this->ProjectAllocationModel->updateNumberOfPeopleAllocated($project_id);
                redirect('project_details/show/' . $project_id);
            } else {
                echo "Project creation failed.";
            }
        }
    }
}
