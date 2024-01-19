<?php
class ProjectModel extends CI_Model {
    public function __construct() {
        parent::__construct();
    }

    public function getProjects() {
        $query = $this->db->get('projects');
    
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return array();
        }
    }

    public function getProjectsPaginated($limit, $start) {
        $this->db->limit($limit, $start);
        $query = $this->db->get('projects');

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return array();
        }
    }

    public function countProjects() {
        return $this->db->count_all('projects');
    }

public function getInvitedProjects($entityId, $role, $limit, $offset) {
    $this->db->select('projects.*');
    $this->db->from('projects');

    
    if (!in_array($role, ['admin', 'gestor'])) {
        $this->db->join('invitations', 'invitations.project_id = projects.project_id');
        $this->db->where('invitations.entity_id', $entityId);
        $this->db->where('invitations.status', 'invited');
    }

    $this->db->limit($limit, $offset);
    $query = $this->db->get();

    if ($query->num_rows() > 0) {
        return $query->result();
    } else {
        return array();
    }
}

public function countInvitedProjects($entityId, $role) {
    
    $this->db->from('projects');

    
    if (!in_array($role, ['admin', 'gestor'])) {
        $this->db->join('invitations', 'invitations.project_id = projects.project_id');
        $this->db->where('invitations.entity_id', $entityId);
        $this->db->where('invitations.status', 'invited');
    }

    return $this->db->count_all_results();
}

    
}
?>
