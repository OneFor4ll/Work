<?php
class ReportsController extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('ReportModel'); 
        $this->load->helper('url');
        $this->load->library('session');
    }

    public function projectReports() {
        $this->load->library('pagination');
        
        $config['base_url'] = base_url('ReportsController/projectReports');
        $config['total_rows'] = $this->ReportModel->getProjectReportsCount();
        $config['per_page'] = 10;
        $config['uri_segment'] = 3;
    
        $this->pagination->initialize($config);
    
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
    
        $data['project_reports'] = $this->ReportModel->getProjectReportsPaginated($config['per_page'], $page);
        $data['pagination_links'] = $this->pagination->create_links();
    
        $this->load->view("comum/header");
        $this->load->view('project_reports', $data);
        $this->load->view("comum/footer");
    }
    
    public function personReports() {
        $this->load->library('pagination');
        
        $config['base_url'] = base_url('ReportsController/personReports');
        $config['total_rows'] = $this->ReportModel->getPersonReportsCount();
        $config['per_page'] = 10;
        $config['uri_segment'] = 3;
    
        $this->pagination->initialize($config);
    
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
    
        $data['person_reports'] = $this->ReportModel->getPersonReportsPaginated($config['per_page'], $page);
        $data['pagination_links'] = $this->pagination->create_links();
    
        $this->load->view("comum/header");
        $this->load->view('person_reports', $data);
        $this->load->view("comum/footer");
    }
}
