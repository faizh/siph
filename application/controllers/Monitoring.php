<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Monitoring extends CI_Controller {

    function __construct()
    {
        parent::__construct();

        if (!$this->session->userdata('logged_in')){
            redirect('');
        }

        $this->load->model('m_monitoring');
    }

    public function index() {
        $page = 'monitoring';

        
        $status_katup           = $this->m_monitoring->getComponentStatus($this->m_monitoring->katupId());
        $status_lampu           = $this->m_monitoring->getComponentStatus($this->m_monitoring->lampuId());
        $status_pompa           = $this->m_monitoring->getComponentStatus($this->m_monitoring->pompaId());
        $status_ultrasonik      = $this->m_monitoring->getComponentStatus($this->m_monitoring->ultrasonikId());
        $status_soilMoisture    = $this->m_monitoring->getComponentStatus($this->m_monitoring->soilMoistureId());
        $status_durasiLampu     = $this->m_monitoring->getComponentStatus($this->m_monitoring->durasiLampuId());

        $components = array(
            'katup'         => $status_katup->component_status,
            'lampu'         => $status_lampu->component_status,
            'pompa'         => $status_pompa->component_status,
            'ultrasonik'    => $status_ultrasonik->component_status,
            'soilMoisture'  => $status_soilMoisture->component_status,
            'durasiLampu'   => $status_durasiLampu->component_status,
        );

        $this->load->view('includes/v_header', compact('page'));
        $this->load->view('contents/v_monitoring', compact('components'));
        $this->load->view('includes/v_footer');
    }
}