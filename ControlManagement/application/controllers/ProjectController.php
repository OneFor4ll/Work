<?php
class ProjectController extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('ProjectModel');
        $this->load->model('ProjectAllocationModel');
        $this->load->helper('url');
        $this->load->database(); 
        $this->load->library('session');
        $this->load->library('pagination');

    }

    public function index() {
        
        $role = $this->session->userdata('role');
    
        $config = array();
        $config["base_url"] = base_url("ProjectController/index");
        $config["total_rows"] = $this->ProjectModel->countInvitedProjects($this->session->userdata('entity_id'), $role);
        $config["per_page"] = 5; 
        $config["uri_segment"] = 3;
    
        $this->pagination->initialize($config);

        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        
        
        $data['projects'] = $this->ProjectModel->getInvitedProjects($this->session->userdata('entity_id'), $role, $config["per_page"], $page);
        foreach ($data['projects'] as &$project) {
            $project->allocated_people = $this->ProjectAllocationModel->getAllocatedPeople($project->project_id);
        }
        
        
        $data["links"] = $this->pagination->create_links();
        
        $data['role'] = $role; 
        $this->load->view("comum/header");
        $this->load->view('project_list', $data);
        $this->load->view("comum/footer");
        
    }
    
    
}
?>
