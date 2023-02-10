<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    public function index()
    {
        $this->load->view('includes/v_header');
        $this->load->view('contents/v_home');
        $this->load->view('includes/v_footer');
    }
}