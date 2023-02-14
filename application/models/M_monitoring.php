<?php 

class M_monitoring extends CI_Model {

    function katupId(){
        return 1;
    }

    function lampuId() {
        return 2;
    }

    function pompaId() {
        return 3;
    }

    function ultrasonikId() {
        return 4;
    }

    function soilMoistureId() {
        return 5;
    }

    function durasiLampuId() {
        return 6;
    }

    public function getComponentStatus($component_id){
        $this->db->select('*');
        $this->db->where('component_id', $component_id);
        return $this->db->get('t_component_status')->row();
    }

    public function updateComponentStatus($data, $condition) {
        if( !$this->db->update('t_component_status', $data, $condition) ){
            return false;
        }else{
            return true;
        }

    }

}