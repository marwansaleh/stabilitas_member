<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of Dashboard
 *
 * @author marwansaleh 1:31:58 PM
 */
class Dashboard extends REST_Api {
    
    function __construct($config = 'rest') {
        parent::__construct($config);
    }
    
    public function agendas_get(){
        $this->load->model(array('rel_agenda_m','ref_target_m'));
        $result = array('status'=>FALSE, 'items'=>array());
        
        $where = array('agenda_status <='=>AGENDA_ST_APPROVE);
        
        $agendas = $this->rel_agenda_m->get_by($where);
        if ($agendas){
            $result['status'] = TRUE;
            $result['items'] = $this->_is_mine($agendas);
        }else{
            $result['message'] = 'Tidak ada data agenda';
        }
        $this->response($result);
    }
    
    private function _is_mine($items){
        $this->load->model('ref_rekap_m');
        
        $new_items = array();
        foreach($items as $item){
            // get target
            $targetdata = $this->ref_target_m->get($item->target_id);
            
            // get rekap
            $rekap = $this->ref_rekap_m->get($targetdata->rekap);
            
            // check if item belongs to me
            if($rekap->broker === $this->me){
                $new_items[] = $item;
            }
        }
//        print_r($new_items);exit;
        return $this->_modify_fields($new_items);
    }
    
    private function _modify_fields($items){
        $this->load->model(array('ref_client_m','ref_target_m'));
        
        foreach($items as $item){
            // Get Target Data
            $targetdata = $this->ref_target_m->get($item->target_id);
            
            $item->client_name = $this->ref_client_m->get($targetdata->client)->fullname;
        }
        
        return $items;
    }
    
    public function summary_ao_get($aoId){
        // get sum
        $stats = array(
            'month' => array(),
            'target_renew' => array(),
            'target_new' => array(),
            'achieve_renew' => array(),
            'achieve_new' => array()
        );
        
        // get year
        $year = date('Y');
        for($i = 1;$i <= 12; $i++){
            array_push($stats['month'], get_month_name($i,"short"));
            array_push($stats['target_renew'], $this->_get_sum($i, $year,$aoId,'target_renew'));
            array_push($stats['target_new'], $this->_get_sum($i, $year,$aoId,'target_new'));
            array_push($stats['achieve_renew'], $this->_get_sum($i, $year,$aoId,'achievement_renew'));
            array_push($stats['achieve_new'], $this->_get_sum($i, $year,$aoId,'achievement_new'));
        }
        
        if($stats['target_renew'] || $stats['achieve_renew'] || $stats['achieve_renew'] || $stats['achieve_new']){
            $result['status'] = TRUE;
            $result['stats'] = $stats;
            $result['ao_name'] = $this->userService->get_user($aoId)->nama;
        }else{
            $result['message'] = 'Error when get data';
        }
        
        $this->response($result);
    }
    
    private function _get_sum($month,$year,$aoId=NULL,$type = 'target_renew'){
        $this->load->model('ref_rekap_m');
            
        $this->db->where('month_prod',$month);
        $this->db->where('year_prod',$year);
        $this->db->where('broker',$aoId);
        $rekap = $this->ref_rekap_m->get(NULL,TRUE);
        
        return $rekap ? $rekap->$type:0;
    }
    
    public function broker_get($id){
        $this->load->model('ref_rekap_m');
        
        $this->db->where('month_prod',date('m'));
        $this->db->where('year_prod',date('Y'));
        $this->db->where('broker',$id);
        $item = $this->ref_rekap_m->get(NULL,TRUE);
        
        if($item){
            $return['status'] = TRUE;
            
            // modify fields
            $item->achievement_new = number_format($item->achievement_new,2);
            $item->achievement_renew = number_format($item->achievement_renew,2);
            $item->target_new = number_format($item->target_new,2);
            $item->target_renew = number_format($item->target_renew,2);
            $item->month_prod = get_month_name($item->month_prod);
            
            $return['item'] = $item;
        }else{
            $return['message'] = 'No data found';
        }
        
        $this->response($return);
    }
}

/**
 * Filename : Dashboard.php
 * Location : application/controllers/services/Dashboard.php
 */
