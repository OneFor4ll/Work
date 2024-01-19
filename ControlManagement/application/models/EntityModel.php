<?php
class EntityModel extends CI_Model {
    public function getAllEntities() {
        $this->db->select('*');
        $this->db->from('entities');
        $query = $this->db->get();
        return $query->result();
    }

    public function increaseRole($entityId) {
        $this->db->where('entity_id', $entityId);
        $this->db->update('entities', array('role' => 'gestor'));
        return $this->db->affected_rows() > 0;
    }

    public function removeRole($entityId) {
        $this->db->where('entity_id', $entityId);
        $this->db->update('entities', array('role' => 'user')); 
        return $this->db->affected_rows() > 0;
    }


    public function getEntitiesByRole($role) {
        $this->db->select('*');
        $this->db->from('entities');
        $this->db->where('role', $role);
        $query = $this->db->get();
        return $query->result();
    }

    public function countAllEntities() {
        return $this->db->count_all('entities');
    }
    
    public function getEntities($limit, $offset) {
        $this->db->limit($limit, $offset);
        $query = $this->db->get('entities');
        return $query->result();
    }
    
}
?>