<?php
class CreateProjectModel extends CI_Model {
    public function __construct() {
        parent::__construct();
        $this->load->database(); 
    }

    public function createProject($data) {
        $this->db->insert('projects', $data);
        $project_id = $this->db->insert_id();

        return $project_id;
    }
}
