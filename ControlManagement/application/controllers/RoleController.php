<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class RoleController extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('EntityModel');
        $this->load->helper('url');
        $this->load->database();
        $this->load->library('session');
        $this->load->library('pagination');
    }

    public function index($offset = 0) {
        $limit = 10;

        $config['base_url'] = base_url('RoleController/index');
        $config['total_rows'] = $this->EntityModel->countAllEntities();
        $config['per_page'] = $limit;

        $this->pagination->initialize($config);

        $data['entities'] = $this->EntityModel->getEntities($limit, $offset);
        $data['pagination'] = $this->pagination->create_links();

        $this->load->view("comum/header");
        $this->load->view('list_entities_by_role', $data);
        $this->load->view("comum/footer");
    }

    public function increaseRole($entityId) {
        $result = $this->EntityModel->increaseRole($entityId);

        if ($result) {
            $this->session->set_flashdata('success', 'Role increased successfully.');
        } else {
            $this->session->set_flashdata('error', 'Failed to increase role.');
        }

        redirect('role');
    }

    public function removeRole($entityId) {
        $result = $this->EntityModel->removeRole($entityId);

        if ($result) {
            $this->session->set_flashdata('success', 'Role removed successfully.');
        } else {
            $this->session->set_flashdata('error', 'Failed to remove role.');
        }

        redirect('role');
    }
}
?>
