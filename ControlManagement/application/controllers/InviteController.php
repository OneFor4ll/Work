<?php
class InviteController extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('InviteModel');
        $this->load->library('session');
        $this->load->library('pagination'); 
        $this->load->helper('url');
    }

    public function index($projectId) {
        $config = array();
        $config["base_url"] = base_url("InviteController/index/{$projectId}");
        $config["total_rows"] = $this->InviteModel->record_count();
        $config["per_page"] = 10;
        $config["uri_segment"] = 4;

        $this->pagination->initialize($config);

        $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;

        $data['users'] = $this->InviteModel->getUsersPaginated($config["per_page"], $page);
        $data['links'] = $this->pagination->create_links();
        $data['projectId'] = $projectId;

        $this->load->view("comum/header");
        $this->load->view('invite_view', $data);
        $this->load->view("comum/footer");
    }

    public function sendInvitation($userId, $projectId) {
        $result = $this->InviteModel->sendInvitation($userId, $projectId);
    
        if ($result) {
            $this->session->set_flashdata('success_message', 'Invitation sent successfully.');
        } else {
            $this->session->set_flashdata('error_message', 'Error sending invitation. User is fully allocated.');
        }
        redirect('invite/' . $projectId);
    }
    
    
}
?>
