<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ProjectDetailsController extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('ProjectDetailsModel');
        $this->load->model('ProjectAllocationModel');
        $this->load->database();
        $this->load->library('session');
        $this->load->helper('url');
    }

    public function index($project_id) {
        $data['project'] = $this->ProjectDetailsModel->getProjectDetails($project_id);
        $data['allocated_people'] = $this->ProjectDetailsModel->getAllocatedPeople($project_id);
        $data['project_members'] = $this->ProjectAllocationModel->getMembersByProject($project_id);
        
        $entity_id = $this->session->userdata('entity_id');
        
        $data['isProjectCreator'] = $this->ProjectDetailsModel->isProjectCreator($entity_id, $project_id);
        $data['no_allocated_people'] = empty($data['allocated_people']);
        
        $data['userRole'] = $this->session->userdata('role');
        $data['entity_id'] = $entity_id; 

        $this->load->view("comum/header");
        $this->load->view('project_details', $data);
        $this->load->view("comum/footer");
    }

    public function joinProject($project_id) {
        $entity_id = $this->session->userdata('entity_id');
        $this->load->model('ProjectDetailsModel');
        $entity_name = $this->ProjectDetailsModel->getEntityNameById($entity_id);
        
        if (!$entity_name) {
            echo 'Entity name not found.';
            return;
        }
    
        $existingAllocation = $this->ProjectAllocationModel->getAllocationByEntityAndProject($entity_id, $project_id);
        
        if ($existingAllocation) {
            redirect('project_details/show/' . $project_id);
            return;
        }
    
        $default_values = array(
            'function' => '',
            'percentage' => 0,
            'hours_per_day' => 0,
            'hours_per_month' => 0,
            'hourly_cost' => 0,
            'monthly_cost' => 0
        );
    
        $data = array(
            'entity_id' => $entity_id,
            'project_id' => $project_id,
            'person_name' => $entity_name,
        ) + $default_values;
    
        $data['hours_per_day'] = min($data['hours_per_day'], 8);
        $data['hours_per_month'] = $data['hours_per_day'] * 22;
        $data['monthly_cost'] = $data['hours_per_month'] * $data['hourly_cost'];
    
        try {
            $this->ProjectAllocationModel->insertAllocation($data);
            $this->ProjectAllocationModel->updateNumberOfPeopleAllocated($project_id);
            redirect('project_details/show/' . $project_id);
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
            return;
        }
    }
    

    public function deleteProject($project_id) {
        $this->db->trans_start();
        $this->db->delete('project_allocation', array('project_id' => $project_id));
        $this->db->delete('projects', array('project_id' => $project_id));
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            echo "An error occurred while deleting the project.";
        } else {
            redirect('projects');
        }
    }

    public function update_allocation() {
        log_message('debug', 'Post Data: ' . json_encode($_POST));
    
        $entity_id = $this->input->post('entity_id');
        $project_id = $this->input->post('project_id');
    
        $edited_data = array(
            'function' => $this->input->post('function'),
            'percentage' => $this->input->post('percentage'),
            'hours_per_day' => min($this->input->post('hours_per_day'), 8),
            'hours_per_month' => $this->input->post('hours_per_day') * 22,
            'hourly_cost' => $this->input->post('hourly_cost'),
            'monthly_cost' => $this->input->post('hours_per_month') * $this->input->post('hourly_cost')
        );
    
        try {
            $this->ProjectAllocationModel->updateAllocation($entity_id, $project_id, $edited_data);
    
            $response = array('status' => 'success', 'message' => 'Allocation updated successfully');
            echo json_encode($response);
        } catch (Exception $e) {
            log_message('error', 'Error updating allocation: ' . $e->getMessage());
    
            $response = array('status' => 'error', 'message' => 'Error updating allocation: ' . $e->getMessage());
            echo json_encode($response);
        }
    }
}
