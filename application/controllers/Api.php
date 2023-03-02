<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller {

    function __construct()
    {
        parent::__construct();

        $this->load->model('m_monitoring');
    }

    public function get_status_katup() {
        $status_lampu   = $this->m_monitoring->getComponentStatus($this->m_monitoring->katupId());
        
        $response       = array(
            'status'    => true,
            'data'      => $status_lampu->component_status,
            'msg'       => 'success'
        );

        echo json_encode($response);
    }

    public function get_status_lampu() {
        $status_lampu   = $this->m_monitoring->getComponentStatus($this->m_monitoring->lampuId());
        
        $response       = array(
            'status'    => true,
            'data'      => $status_lampu->component_status,
            'msg'       => 'success'
        );

        echo json_encode($response);
    }

    public function get_status_pompa() {
        $status_lampu   = $this->m_monitoring->getComponentStatus($this->m_monitoring->pompaId());
        
        $response       = array(
            'status'    => true,
            'data'      => $status_lampu->component_status,
            'msg'       => 'success'
        );

        echo json_encode($response);
    }

    public function update_ketinggian_air() {
        $input = (object) $this->input->post();

        if (empty($input->ketinggian_air)){
            $response = array(
                'status'    => false,
                'msg'       => 'parameter ketinggian_air is null'
            );

            echo json_encode($response);
            exit;
        }

        $ketinggian_air     = $input->ketinggian_air;

        $update = $this->m_monitoring->updateComponentStatus(
            array('component_status' => $ketinggian_air), 
            array('component_id' => $this->m_monitoring->ultrasonikId())
        );

        if ($update) {
            $response = array(
                'status'    => true,
                'msg'       => 'update success'
            );
        } else {
            $response = array(
                'status'    => false,
                'msg'       => 'update failed'
            );
        }

        echo json_encode($response);
    }

    public function update_kelembaban_tanah() {
        $input = (object) $this->input->post();

        if (empty($input->kelembaban_tanah)){
            $response = array(
                'status'    => false,
                'msg'       => 'parameter kelembaban_tanah is null'
            );

            echo json_encode($response);
            exit;
        }

        $kelembaban_tanah     = $input->kelembaban_tanah;

        $update = $this->m_monitoring->updateComponentStatus(
            array('component_status' => $kelembaban_tanah), 
            array('component_id' => $this->m_monitoring->soilMoistureId())
        );

        if ($update) {
            $response = array(
                'status'    => true,
                'msg'       => 'update success'
            );
        } else {
            $response = array(
                'status'    => false,
                'msg'       => 'update failed'
            );
        }

        echo json_encode($response);
    }

    public function update_status_katup() {
        $input = (object) $this->input->post();

        if (empty($input->status)){
            $response = array(
                'status'    => false,
                'msg'       => 'parameter status is null'
            );

            echo json_encode($response);
            exit;
        }

        $status     = $input->status;

        if ($status == 'on') {
            $status = 1;
        }else {
            $status = 0;
        }

        $update = $this->m_monitoring->updateComponentStatus(
            array('component_status' => $status), 
            array('component_id' => $this->m_monitoring->katupId())
        );

        if ($update) {
            $response = array(
                'status'    => true,
                'msg'       => 'Update Success'
            );
        } else {
            $response = array(
                'status'    => false,
                'msg'       => 'Update Failed'
            );
        }

        echo json_encode($response);
    }

    public function update_status_pompa() {
        $input = (object) $this->input->post();

        if (empty($input->status)){
            $response = array(
                'status'    => false,
                'msg'       => 'parameter status is null'
            );

            echo json_encode($response);
            exit;
        }

        $status     = $input->status;

        if ($status == 'on') {
            $status = 1;
        }else {
            $status = 0;
        }

        $update = $this->m_monitoring->updateComponentStatus(
            array('component_status' => $status), 
            array('component_id' => $this->m_monitoring->pompaId())
        );

        if ($update) {
            $response = array(
                'status'    => true,
                'msg'       => 'update success'
            );
        } else {
            $response = array(
                'status'    => false,
                'msg'       => 'update failed'
            );
        }

        echo json_encode($response);
    }

    public function update_status_lampu() {
        $input = (object) $this->input->post();

        if (empty($input->status)){
            $response = array(
                'status'    => false,
                'msg'       => 'parameter status is null'
            );

            echo json_encode($response);
            exit;
        }

        $status     = $input->status;

        if ($status == 'on') {
            $status = 1;
        }else {
            $status = 0;
        }

        $update = $this->m_monitoring->updateComponentStatus(
            array('component_status' => $status), 
            array('component_id' => $this->m_monitoring->lampuId())
        );

        if ($update) {
            $response = array(
                'status'    => true,
                'msg'       => 'update success'
            );
        } else {
            $response = array(
                'status'    => false,
                'msg'       => 'update failed'
            );
        }

        echo json_encode($response);
    }

}