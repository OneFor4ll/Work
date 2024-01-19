<?php
class ProjectDetailsModel extends CI_Model {
    public function __construct() {
        parent::__construct();
        $this->load->database(); 
    }

    public function getProjectDetails($project_id) {
        
        $query = $this->db->get_where('projects', array('project_id' => $project_id));

        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return false; 
        }
    }

    public function getAllocatedPeople($project_id) {
        $query = $this->db->get_where('project_allocation', array('project_id' => $project_id));
        
    
        if ($query->num_rows() > 0) {
            $result = $query->result();
            return $result;
        } else {
            return array(); 
        }
    }
    
    public function isProjectCreator($entity_id, $project_id) {
        
        $query = $this->db->get_where('projects', array('project_id' => $project_id, 'entity_id' => $entity_id));
    
        return $query->num_rows() > 0;
    }
    public function deleteProject($project_id) {
        
        $this->db->delete('invitations', array('project_id' => $project_id));
        
        
        $this->db->delete('projects', array('project_id' => $project_id));
    
        redirect('projects');
    }
    
    
public function getEntityNameById($entity_id) {
    $query = $this->db->get_where('entities', array('entity_id' => $entity_id));

    if ($query->num_rows() > 0) {
        $result = $query->row();
        return $result->name; 
    } else {
        return false;
    }
}


}
