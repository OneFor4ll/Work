<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Products_model extends CI_Model {
    public function get_product($product_id) {
        $query = $this->db->get_where('products', array('id' => $product_id));

        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return null; // Product not found
        }
    }
}

