<?php
class InviteModel extends CI_Model {
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function getUsers() {
        $this->db->where('role', 'user');
        return $this->db->get('entities')->result();
    }

    public function isUserFullyAllocated($userId) {
        
        $this->db->where('entity_id', $userId);
        $this->db->select_sum('percentage');
        $totalAllocation = $this->db->get('project_allocation')->row()->percentage;

        
        return ($totalAllocation >= 100);
    }

    public function sendInvitation($userId, $projectId) {
        
        if ($this->isUserFullyAllocated($userId)) {
            return false; 
        }

        
        $existingInvitation = $this->db->get_where('invitations', array(
            'entity_id' => $userId,
            'project_id' => $projectId
        ))->row();
    
        if ($existingInvitation) {
            
            $this->db->where('entity_id', $userId);
            $this->db->where('project_id', $projectId);
            $this->db->update('invitations', array('status' => 'invited'));
    
            return true;
        } else {
            
            $data = array(
                'entity_id' => $userId,
                'project_id' => $projectId,
                'status' => 'invited'
            );
            $this->db->insert('invitations', $data);
            
            return true;
        }
    }


    public function getProjectsInfo($userId) {
        $this->db->select('projects.name as project_name, project_allocation.percentage');
        $this->db->from('project_allocation');
        $this->db->join('projects', 'project_allocation.project_id = projects.project_id');
        $this->db->where('project_allocation.entity_id', $userId);
    
        $result = $this->db->get()->result();
    
        if (!empty($result)) {
            $projectsInfo = '';
            foreach ($result as $project) {
                $projectsInfo .= $project->project_name . ' (' . $project->percentage . '%), ';
            }
    
            $projectsInfo = rtrim($projectsInfo, ', ');
    
            return $projectsInfo;
        } else {
            return 'Free'; 
        }
    }

    
    public function getUsersPaginated($limit, $start) {
        $this->db->where('role', 'user');
        $this->db->limit($limit, $start);
        return $this->db->get('entities')->result();
    }

    public function record_count() {
        $this->db->where('role', 'user');
        return $this->db->count_all_results('entities');
    }
    
}

