<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Monitoring extends CI_Controller {

    function __construct()
    {
        parent::__construct();

        if (!$this->session->userdata('logged_in')){
            redirect('');
        }
    }

    public function index() {
        $page = 'monitoring';

        $this->load->view('includes/v_header', compact('page'));
        $this->load->view('contents/v_monitoring');
        $this->load->view('includes/v_footer');
    }
}