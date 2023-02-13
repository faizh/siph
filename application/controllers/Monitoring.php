<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Monitoring extends CI_Controller {

    public function index() {
        $this->load->view('includes/v_header');
        $this->load->view('contents/v_monitoring');
        $this->load->view('includes/v_footer');
    }
}