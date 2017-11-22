<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

/*
 * File Name : Supervisor
 * Created On : Aug 31, 2017 2:19:43 PM
 * author @garaulo (fauziansyah26@gmail.com)
 * Description : 
 */

class Supervisor extends REST_Api{
    private $mktLib;
    
    function __construct($config = 'rest') {
        parent::__construct($config);
        
        $this->load->model('ref_rekap_m');
        
        $this->mktLib = new Marketinglib();
    }
    
    public function staff_get($idGroup=NULL){
        $staffs = $this->mktLib->get_staff($idGroup);
        
        if($staffs){
            $return['status'] = TRUE;
            $return['staffs'] = $staffs;
        }else{
            $return['message'] = 'No data found';
        }
        
        $this->response($return);
    }
    
    public function summary_stats_get($groupId=NULL){
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
            array_push($stats['target_renew'], $this->_get_sum($i, $year,$groupId,'target_renew'));
            array_push($stats['target_new'], $this->_get_sum($i, $year,$groupId,'target_new'));
            array_push($stats['achieve_renew'], $this->_get_sum($i, $year,$groupId,'achievement_renew'));
            array_push($stats['achieve_new'], $this->_get_sum($i, $year,$groupId,'achievement_new'));
        }
        
        if($stats['target_renew'] || $stats['achieve_renew'] || $stats['target_new'] || $stats['achieve_new']){
            $result['status'] = TRUE;
            $result['stats'] = $stats;
        }else{
            $result['message'] = 'Error when get data';
        }
        
        $this->response($result);
    }
    
    private function _get_sum($month,$year,$groupId=NULL,$type = 'achievement'){
//        $staffs = $this->mktLib->get_staff($groupId);
//        
//        // get sum
//        $sum = 0;
//        
//        foreach($staffs as $staff){
//            $this->db->where('month_prod',$month);
//            $this->db->where('year_prod',$year);
//            $this->db->where('broker',$staff->id);
//            $rekap = $this->ref_rekap_m->get(NULL,TRUE);
//            
//            $sum += $rekap ? $rekap->$type:0;
//        }
        if($groupId){
            $this->db->where('grup',$groupId);
        }
        
        $sum = $this->ref_rekap_m->get_select_where('sum('.$type.') as `result`',array(
            'month_prod' => $month,
            'year_prod' => $year
        ),TRUE);
//        print_r($this->db->last_query());exit;
        return $sum->result !== NULL ? $sum->result:0;
    }
    
    public function get_groups_get(){
        $groups = $this->mktLib->get_mkt_grups();
        
        if($groups){
            $return['status'] = TRUE;
            $return['groups'] = $groups;
        }else{
            $return['message'] = 'Error when grabbing data';
        }
        
        $this->response($return);
    }
}

/*
 * file name: Supervisor.php
 */
