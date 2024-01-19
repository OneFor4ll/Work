<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
    }

  public function index() {
    $this->load->view('comum/header');
    $this->load->view('main');
    $this->load->view('comum/footer');
  }

}
