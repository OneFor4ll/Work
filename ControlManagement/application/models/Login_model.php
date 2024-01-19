<?php
class Login_model extends CI_Model {
    public function __construct() {
        parent::__construct();
    }

    public function validate_user($username, $password) {
        $query = $this->db->where('username', $username)->get('entities');
        
        if ($query === null) {
            die($this->db->error());
        }
        
        $user = $query->row();
    
        if ($user && password_verify($password, $user->password)) {
            return $user;
        } else {
            return false;
        }
    }
    
}
?>