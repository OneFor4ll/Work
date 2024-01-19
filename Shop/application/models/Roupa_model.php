<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Roupa_model extends CI_Model {
    
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    
    public function getProductsByFilters($color, $type) {
        $this->db->select('*');
        $this->db->from('products');
        
        if (!empty($color)) {
            $this->db->like('color', $color);
        }
        
        if (!empty($type)) {
            $this->db->like('type', $type);
        }
        
        $query = $this->db->get();
        return $query->result();
    }
}