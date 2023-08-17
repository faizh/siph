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

        if ( !isset($input->ketinggian_air) ){
            $response = array(
                'status'    => false,
                'msg'       => 'parameter ketinggian_air is required'
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

        $component_status = $this->m_monitoring->getComponentStatus($this->m_monitoring->ultrasonikId());
        $insert_log = $this->m_monitoring->insertLogStatus(array(
            "component_status_id"   => $component_status->id,
            "status"                => $ketinggian_air
        ));

        if ($insert_log) {
            $response = array(
                'status'    => true,
                'msg'       => 'update success'
            );
        } else {
            $response = array(
                'status'    => false,
                'msg'       => 'insert log failed'
            );
        }

        echo json_encode($response);
    }

    public function update_kelembaban_tanah() {
        $input = (object) $this->input->post();

        if ( !isset($input->kelembaban_tanah) ){
            $response = array(
                'status'    => false,
                'msg'       => 'parameter kelembaban_tanah is required'
            );

            echo json_encode($response);
            exit;
        }

        if (empty($input->id_tanah)){
            $response = array(
                'status'    => false,
                'msg'       => 'parameter id_tanah is null'
            );

            echo json_encode($response);
            exit;
        }

        if ($input->kelembaban_tanah == null) {
            $response = array(
                'status'    => false,
                'msg'       => 'parameter id_tanah is null'
            );

            echo json_encode($response);
            exit;
        }

        $kelembaban_tanah     = $input->kelembaban_tanah;
        $id_tanah             = $input->id_tanah;

        if ($id_tanah == 1) {
            $component_id = $this->m_monitoring->soilMoistureId();
        } elseif ($id_tanah == 2) {
            $component_id = $this->m_monitoring->soilMoistureId2();
        } else {
            $response = array(
                'status'    => false,
                'msg'       => 'parameter id_tanah is invalid'
            );

            echo json_encode($response);
            exit;
        }

        $update = $this->m_monitoring->updateComponentStatus(
            array('component_status' => $kelembaban_tanah), 
            array('component_id' => $component_id)
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

        $component_status = $this->m_monitoring->getComponentStatus($component_id);
        $insert_log = $this->m_monitoring->insertLogStatus(array(
            "component_status_id"   => $component_status->id,
            "status"                => $kelembaban_tanah
        ));

        if ($insert_log) {
            $response = array(
                'status'    => true,
                'msg'       => 'update success'
            );
        } else {
            $response = array(
                'status'    => false,
                'msg'       => 'insert log failed'
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

        if (empty($input->type)){
            $response = array(
                'status'    => false,
                'msg'       => 'parameter type is null'
            );

            echo json_encode($response);
            exit;
        }

        $status     = $input->status;
        $type       = $input->type;

        if ($status == 'on') {
            $status = 1;
        }else {
            $status = 0;
        }

        if ($type == 'in') {
            $component_id = $this->m_monitoring->katupId();
        } elseif ($type == 'out') {
            $component_id = $this->m_monitoring->katupOutId();
        } else {
            $response = array(
                'status'    => false,
                'msg'       => 'type value is invalid'
            );

            echo json_encode($response);
            exit;
        }
        
        $update = $this->m_monitoring->updateComponentStatus(
            array('component_status' => $status), 
            array('component_id' => $component_id)
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

    public function update_sensor_ldr() {
        $input = (object) $this->input->post();

        if ( !isset($input->intensitas_cahaya) ){
            $response = array(
                'status'    => false,
                'msg'       => 'parameter intensitas_cahaya is required'
            );

            echo json_encode($response);
            exit;
        }

        if ($input->intensitas_cahaya == null) {
            $response = array(
                'status'    => false,
                'msg'       => 'parameter intensitas_cahaya is null'
            );

            echo json_encode($response);
            exit;
        }

        $intensitas_cahaya     = $input->intensitas_cahaya;

        $update = $this->m_monitoring->updateComponentStatus(
            array('component_status' => $intensitas_cahaya), 
            array('component_id' => $this->m_monitoring->sensorLdr())
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

        $component_status = $this->m_monitoring->getComponentStatus($this->m_monitoring->sensorLdr());
        $insert_log = $this->m_monitoring->insertLogStatus(array(
            "component_status_id"   => $component_status->id,
            "status"                => $intensitas_cahaya
        ));

        if ($insert_log) {
            $response = array(
                'status'    => true,
                'msg'       => 'update success'
            );
        } else {
            $response = array(
                'status'    => false,
                'msg'       => 'insert log failed'
            );
        }

        echo json_encode($response);
    }

}