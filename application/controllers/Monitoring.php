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
        $status_soilMoisture_1  = $this->m_monitoring->getComponentStatus($this->m_monitoring->soilMoistureId());
        $status_soilMoisture_2  = $this->m_monitoring->getComponentStatus($this->m_monitoring->soilMoistureId2());
        $durasi_lampu           = $this->m_monitoring->getLampDuration();

        /** processing data for graph kelembaban tanah 1 */
        $components_status      = $component_status = $this->m_monitoring->getComponentStatus($this->m_monitoring->soilMoistureId());
        $logData                = $this->m_monitoring->getComponentStatusLog($component_status->id);
        foreach ($logData as $log) {
            $tanah1Times[] = $log->hours;
            $tanah1Status[] = $log->status;
        }
        krsort($tanah1Times);
        krsort($tanah1Status);

        /** processing data for graph kelembaban tanah 2 */
        $components_status      = $component_status = $this->m_monitoring->getComponentStatus($this->m_monitoring->soilMoistureId2());
        $logData                = $this->m_monitoring->getComponentStatusLog($component_status->id);
        foreach ($logData as $log) {
            $tanah2Times[] = $log->hours;
            $tanah2Status[] = $log->status;
        }
        krsort($tanah2Times);
        krsort($tanah2Status);

        /** processing data for graph ketinggian air */
        $components_status      = $component_status = $this->m_monitoring->getComponentStatus($this->m_monitoring->ultrasonikId());
        $logData                = $this->m_monitoring->getComponentStatusLog($component_status->id);
        foreach ($logData as $log) {
            $ketinggianAirTimes[] = $log->hours;
            $ketinggianAirStatus[] = $log->status;
        }
        krsort($ketinggianAirTimes);
        krsort($ketinggianAirStatus);

        /** processing data for graph intensitas cahaya */
        $components_status      = $component_status = $this->m_monitoring->getComponentStatus($this->m_monitoring->sensorLdr());
        $logData                = $this->m_monitoring->getComponentStatusLog($component_status->id);
        foreach ($logData as $log) {
            $intensitasCahayaTimes[] = $log->hours;
            $intensitasCahayaStatus[] = $log->status;
        }
        krsort($intensitasCahayaTimes);
        krsort($ketinggianAirStatus);
        

        $components = array(
            'katup'         => $status_katup->component_status,
            'lampu'         => $status_lampu->component_status,
            'pompa'         => $status_pompa->component_status,
            'ultrasonik'    => $status_ultrasonik->component_status,
            'soilMoisture1'  => $status_soilMoisture_1->component_status,
            'soilMoisture2'  => $status_soilMoisture_2->component_status,
            'durasiLampu'   => $durasi_lampu,
        );

        $graph = array(
            'tanah1Times'   => $tanah1Times,
            'tanah1Status'  => $tanah1Status,
            'tanah2Times'   => $tanah2Times,
            'tanah2Status'  => $tanah2Status,
            'ketinggianAirTimes' => $ketinggianAirTimes,
            'ketinggianAirStatus' => $ketinggianAirStatus,
            'intensitasCahayaStatus' => $intensitasCahayaStatus,
            'intensitasCahayaTimes' => $intensitasCahayaTimes
        );

        $this->load->view('includes/v_header', compact('page'));
        $this->load->view('contents/v_monitoring', compact('components', 'graph'));
        $this->load->view('includes/v_footer');
    }
}