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

    function soilMoistureId2() {
        return 7;
    }

    function durasiLampuId() {
        return 6;
    }

    function sensorLdr() {
        return 8;
    }

    function katupOutId() {
        return 9;
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

    public function getLampDuration()
    {
        $query = "
        SELECT cs.`created_dtm`
        FROM `t_component_status` cs 
        WHERE cs.`component_id` = 2 AND cs.`component_status` = 1";

        $duration = $this->db->query($query)->row();

        if (empty($duration->created_dtm)) {
            return "-";
        }

        date_default_timezone_set("Asia/Jakarta");
        $diff = $this->timeDifference($duration->created_dtm, date('Y-m-d H:i:s'));
        
        return $diff;
    }

    function timeDifference($start, $stop){
        $diff = strtotime($stop) - strtotime($start);
        $fullHours   = floor($diff/(60*60));
        $fullMinutes = floor(($diff-($fullHours*60*60))/60);
        $fullSeconds = floor($diff-($fullHours*60*60)-($fullMinutes*60));

        return sprintf("%02d",$fullHours) . "h " . sprintf("%02d",$fullMinutes) . "m";
    }

    function insertLogStatus($data=array()) {
        if( !$this->db->insert('t_component_status_log', $data) ){
            return false;
        }else{
            return true;
        }
    }

    function getComponentStatusLog($component_status_id) {
        $query = "SELECT 
                csl.`status`,
                DATE_FORMAT(csl.`created_dtm`, '%H:%i:%s') AS hours
                FROM `t_component_status` cs
                JOIN `t_component_status_log` csl ON csl.`component_status_id` = cs.`id`
                WHERE cs.`id` = ?
                GROUP BY hours
                ORDER BY csl.`created_dtm` DESC
                LIMIT 5";
        
        return $this->db->query($query, array($component_status_id))->result();   
    }

}