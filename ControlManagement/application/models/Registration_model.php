<?
class Registration_model extends CI_Model {
    public function __construct() {
        parent::__construct();
    }

    public function register_user($data) {
        if ($this->db->insert('entities', $data)) {
            return true;
        } else {
            $error = $this->db->error();
            log_message('error', 'Database Error: ' . $error['message']);
            return false;
        }        
    }    

    public function is_name_exists($name) {
        $query = $this->db->get_where('entities', array('name' => $name));
        return $query->num_rows() > 0;
    }

    public function is_nif_exists($nif) {
        $query = $this->db->get_where('entities', array('nif' => $nif));
        return $query->num_rows() > 0;
    }

    public function is_email_exists($email) {
        $query = $this->db->get_where('entities', array('email' => $email));
        return $query->num_rows() > 0;
    }

    public function is_phone_exists($phone) {
        $query = $this->db->get_where('entities', array('phone' => $phone));
        return $query->num_rows() > 0;
    }

    // Define the missing method is_address_exists()
    public function is_address_exists($address) {
        $query = $this->db->get_where('entities', array('address' => $address));
        return $query->num_rows() > 0;
    }
    public function is_manager_name_exists($manager_name) {
        $query = $this->db->get_where('entities', array('manager_name' => $manager_name));
        return $query->num_rows() > 0;
    }
    public function is_username_exists($username) {
        $this->db->where('username', $username);
        $query = $this->db->get('entities');

        return $query->num_rows() > 0;
    }    

    public function is_password_exists($password) {
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
    
        $this->db->where('password', $hashedPassword);
        $query = $this->db->get('entities');
    
        return $query->num_rows() > 0;
    }
    
}

?>