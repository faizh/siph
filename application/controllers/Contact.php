<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contact extends CI_Controller {

    public function index()
    {
        $page = 'contact';

        $this->load->view('includes/v_header', compact('page'));
        $this->load->view('contents/v_team');
        $this->load->view('includes/v_footer');
    }
}