<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {
    public function __construct() {
      parent::__construct();
      $this->load->database();
  }
// login and register
  public function insert_user($data) {
    // Hash the password before inserting it into the database
    $data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);

    $this->db->insert('users', $data);
  }

  public function get_user($username) {
    $query = $this->db->get_where('users', array('username' => $username));
    return $query->row_array();
  }
  public function get_all_users() {
    $query = $this->db->get('users');
    if ($this->db->error()["code"]!= 0) {
        // Handle database error
        return false;
    }
    if ($query->num_rows() == 0) {
        // Handle empty result set
        return array();
    }
    return $query->result();
  }
  //--------------------------------------------------------//
  //table control

  public function ban_user($user_id) {
    $this->db->where('id', $user_id);
    $this->db->update('users', array('status' => 'banned'));
  }

  public function unban_user($user_id) {
    $this->db->where('id', $user_id);
    $this->db->update('users', array('status' => 'unbanned'));
  }


    public function get_user_by_id($user_id) {
        $this->db->where('id', $user_id);
        $query = $this->db->get('users');
        return $query->row_array();
  }

  public function get_users_pagination($usersPerPage, $currentPage) {
    $offset = ($currentPage - 1) * $usersPerPage;

    // Fetch users from the database with pagination
    $this->db->limit($usersPerPage, $offset);
    $query = $this->db->get('users');
    return $query->result();
  }

  public function count_users() {
    return $this->db->count_all('users');
  }

  public function get_total_users() {
    return $this->db->count_all('users');
  }

//Location
  
public function saveAddress($userId, $address, $city, $country, $postalCode) {
  $data = array(
      'city' => $city,
      'country' => $country,
      'address' => $address,
      'postal_code' => $postalCode
  );

  $this->db->where('id', $userId);
  $this->db->update('users', $data);
}


public function assign_role_seller($user_id) {
  $this->db->where('id', $user_id);
  $this->db->update('users', array('role' => 'seller'));
}

public function removeRoleSeller($user_id) {
  $this->db->where('id', $user_id);
  $this->db->update('users', array('role' => 'user'));
}

}

