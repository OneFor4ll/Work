<?
class ProjectAllocationModel extends CI_Model {
    public function getMembersByProject($project_id) {
        $this->db->where('project_id', $project_id);
        $query = $this->db->get('project_allocation');
        
        if ($query->num_rows() > 0) {
            return $query->result();
        }
        
        return array();
    }

    public function getAllocatedPeople($project_id) {
        $this->db->where('project_id', $project_id);
        $query = $this->db->get('project_allocation');

        if ($query->num_rows() > 0) {
            return $query->result();
        }

        return array(); 
    }

    public function insertAllocation($data) {
        $this->db->insert('project_allocation', $data);
    }
    
    public function getAllocationByEntityAndProject($entity_id, $project_id) {
        $query = $this->db->get_where('project_allocation', array('entity_id' => $entity_id, 'project_id' => $project_id));

        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return false;
        }
    }

    public function updateNumberOfPeopleAllocated($project_id) {
        $this->db->where('project_id', $project_id);
        $this->db->from('project_allocation');
        $num_people = $this->db->count_all_results();
    
        $this->db->where('project_id', $project_id);
        $this->db->update('projects', array('num_people' => $num_people));
    }

    public function updateAllocation($entity_id, $project_id, $data) {
        $this->db->where(array('entity_id' => $entity_id, 'project_id' => $project_id));
        $this->db->update('project_allocation', $data);
    }

}
