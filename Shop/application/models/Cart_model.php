<?php
class Cart_model extends CI_Model {
    public function __construct() {
        parent::__construct();
        $this->load->database(); 
        $this->load->library('session');
    }

    public function addProductToCart($product_id, $selectedSize, $selectedColor) {
        $user_id = $this->session->userdata('id');

        $this->db->where('id_product', $product_id);
        $this->db->where('user_id', $user_id);
        $this->db->where('selected_size', $selectedSize);
        $this->db->where('selected_color', $selectedColor);
        $query = $this->db->get('cart_products');

        if ($query->num_rows() > 0) {
            $row = $query->row();
            $quantity = $row->quantity + 1;

            $this->db->set('quantity', $quantity);
            $this->db->where('id', $row->id);
            $this->db->update('cart_products');
        } else {
            $data = array(
                "id_product" => $product_id,
                "user_id" => $user_id,
                "selected_size" => $selectedSize,
                "selected_color" => $selectedColor,
                "quantity" => 1
            );

            $this->db->insert('cart_products', $data);
        }

        return true;
    }

    public function getCartCount() {
        $this->db->where('user_id', $this->session->userdata('id'));
        $query = $this->db->get('cart_products');
        return $query->num_rows();
    }

    public function getCartProducts() {
        $user_id = $this->session->userdata('id');

        $this->db->select('products.*, cart_products.quantity AS total_quantity, cart_products.selected_color, cart_products.selected_size');
        $this->db->from('cart_products');
        $this->db->join('products', 'cart_products.id_product = products.id');
        $this->db->where('cart_products.user_id', $user_id);
        $this->db->group_by('cart_products.selected_color, cart_products.selected_size, cart_products.id_product');
        $query = $this->db->get();

        return $query->result();
    }

    public function clearCart() {
        $user_id = $this->session->userdata('id');

        $this->db->where('user_id', $user_id);
        $this->db->delete('cart_products');
    }

    public function getProductQuantity($product_id) {
        $this->db->where('id_product', $product_id);
        $this->db->where('user_id', $this->session->userdata('id'));
        $query = $this->db->get('cart_products');

        if ($query->num_rows() > 0) {
            $row = $query->row();
            return $row->quantity;
        }

        return 0;
    }

    public function updateProductQuantity($product_id, $quantity) {
        $user_id = $this->session->userdata('id');

        $this->db->where('id_product', $product_id);
        $this->db->where('user_id', $user_id);
        $this->db->set('quantity', $quantity);
        $this->db->update('cart_products');

        if ($this->db->affected_rows() > 0) {
            $this->db->select('quantity');
            $this->db->from('cart_products');
            $this->db->where('id_product', $product_id);
            $this->db->where('user_id', $user_id);
            $query = $this->db->get();

            if ($query->num_rows() > 0) {
                $row = $query->row();
                return $row->quantity; 
            }
        }

        return 0; 
    }
    

    // Local model

    public function saveLocation($user_id, $city, $address, $country, $phone_number, $postal_code) {
        $data = array(
            'city' => $city,
            'country' => $country,
            'address' => $address,
            'phone_number' => $phone_number,
            'postal_code' => $postal_code,
        );

        $this->db->where('id', $user_id);
        $this->db->update('users', $data);
    }

    public function getLocation($user_id) {
        $this->db->select('city, country, address, phone_number, postal_code, first_name, last_name');
        $this->db->where('id', $user_id);
        $query = $this->db->get('users');

        if ($query->num_rows() > 0) {
            $row = $query->row();
            return array(
                'city' => $row->city,
                'country' => $row->country,
                'address' => $row->address,
                'phone_number' => $row->phone_number,
                'postal_code' => $row->postal_code,
                'first_name' => $row->first_name,
                'last_name' => $row->last_name
            );
        }

        return null;
    }

    public function hasLocation($user_id) {
        $this->db->select('city, country, address');
        $this->db->where('id', $user_id);
        $query = $this->db->get('users');

        if ($query->num_rows() > 0) {
            $row = $query->row();
            return !empty($row->city) && !empty($row->country) && !empty($row->address);
        }

        return false;
    }
}
?>
