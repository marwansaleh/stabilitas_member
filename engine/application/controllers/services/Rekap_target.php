<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*
 * File Name : Rekap_target
 * Created On : Aug 29, 2017 9:00:10 AM
 * @author garaulo (fauziansyah26@gmail.com)
 * Description : 
 */

class Rekap_target extends REST_Api {
    private $mktLib;
    
    function __construct($config = 'rest') {
        parent::__construct($config);
        
        $this->load->model(array('ref_rekap_m','rel_broker_move_m'));
        
        $this->mktLib = new Marketinglib();
    }
    
    public function datatable_get($month_prod = NULL, $year_prod = NULL){
        $draw = $this->get('draw');
        $length = $this->get('length');
        $start = $this->get('start');
        $order_arr = $this->get('order');
        $columns_arr = $this->get('columns');
        $search = $this->get('search') ? $this->get('search') : NULL;
        
        // handling session
        if(!$this->me){
            exit('No Session Found!');
        }
        
        //get order by and direction from the order & columns array
        $order_by = $columns_arr[$order_arr[0]['column']]['data'];
        $order_dir = $order_arr[0]['dir']; 
        
        if($month_prod && $year_prod){
            $this->db->where('month_prod',$month_prod);
            $this->db->where('year_prod',$year_prod);
        }
        
        $totalRecords = $this->ref_rekap_m->get_count();
//        print_r($this->db->last_query());exit;
        //set filtered if any
        if ($search && $search['value']){
            $this->db->like('target', $search['value']);
            $this->db->or_like('achievement', $search['value']);
        }
        
        if($month_prod && $year_prod){
            $this->db->where('month_prod',$month_prod);
            $this->db->where('year_prod',$year_prod);
        }
        
        //get filtered count
        $totalFiltered = $this->ref_rekap_m->get_count();
        
        $result = array('draw' => $draw, 'start'=>$start, 'recordsTotal'=>$totalRecords, 'recordsFiltered'=>$totalFiltered, 'items'=>array());

        if ($totalRecords > 0){
            
            //set filtered if any
            //set filtered if any
            if ($search && $search['value']){
                $this->db->like('target', $search['value']);
                $this->db->or_like('achievement', $search['value']);
            }

            if($month_prod && $year_prod){
                $this->db->where('month_prod',$month_prod);
                $this->db->where('year_prod',$year_prod);
            }
            
            //apply offset and limit of data
            $this->db->order_by($order_by,$order_dir);
            $this->db->offset($start)->limit($length);
            
            $query_result = $this->ref_rekap_m->get_by();
            if ($query_result){
                foreach ($query_result as $item){
                    if($item->broker == ID_USER_ROOT){
                        $item->editable = true;
                    }else{
                        $item->editable = false;
                    }
                    $item->editable = ($this->me == ID_USER_ROOT) ? TRUE:FALSE;
                    $item->broker = $this->userService->get_user($item->broker)->nama;
                    $item->month_prod = get_month_name($item->month_prod);
                    $item->target_renew = number_format($item->target_renew,2);
                    $item->target_new = number_format($item->target_new,2);
                    $item->achievement_renew = number_format($item->achievement_renew,2);
                    $item->achievement_new = number_format($item->achievement_new,2);
                    $item->grup = $this->mktLib->get_mkt_grups($item->grup,TRUE)->nama;
                    
                    $result['items'][] = $item;
                }
            }
        }
        
        $this->response($result);
    }
    
    public function index_get($all = FALSE){
        if(!$all) $this->db->where('broker', $this->me);
        
        $this->db->order_by('year_prod asc, month_prod asc');
        $data = $this->ref_rekap_m->get();
        
        if($data){
            $return['status'] = TRUE;
            
            //modify field
            foreach($data as $item){
                $item->month_prod_name = get_month_name($item->month_prod);
            }
            
            $return['items'] = $data;
        }else{
            $return['message'] = 'No Data Found';
        }
        
        $this->response($return);
    }
    
    public function get_get($id){
        $item = $this->ref_rekap_m->get($id);
        
        if($item){
            $item->broker_name = $this->userService->get_user($item->broker)->nama;
            
            $return['status'] = TRUE;
            $return['item'] = $item;
        }else{
            $return['message'] = 'Error when get data';
        }
        
        $this->response($return);
    }
    
    public function getdata_post(){
        $month = $this->post('month');
        $year = $this->post('year');
        
        $this->db->where('month_prod',$month);
        $this->db->where('year_prod',$year);
        $this->db->where('broker', $this->me);
        $this->db->order_by('month_prod asc, year_prod asc');
        $item = $this->ref_rekap_m->get(NULL, TRUE);
        
        if($item){
            $return['status'] = TRUE;
            $return['item'] = $this->_modify_field($item);
        }else{
            $return['message'] = 'No data found';
        }
        
        $this->response($return);
    }
    
    private function _modify_field($item){
        $item->target_renew = number_format($item->target_renew, 2);
        $item->target_new = number_format($item->target_new, 2);
        $item->achievement_renew = number_format($item->achievement_renew, 2);
        $item->achievement_new = number_format($item->achievement_new, 2);
        
        return $item;
    }
    
    public function index_post(){
        $data = $this->array_from_post(array(
            'month_prod','year_prod','grup','broker',
            'target_renew','target_new','achievement_renew','achievement_new'
        ));
        
        // check if data is exist
        $check = $this->ref_rekap_m->get_by(array(
            'broker' => $data['broker'],
            'month_prod' => $data['month_prod'],
            'year_prod' => $data['year_prod']
        ));
        
        if($check){
            $return['message'] = 'Data target sudah ada. Mohon cek kembali';
            
            $this->response($return);exit;
        }
        
        if($this->ref_rekap_m->save($data)){
            // remove target and achievement
            unset($data['target_renew']);
            unset($data['target_new']);
            unset($data['achievement_renew']);
            unset($data['achievement_new']);
            
            if($this->_save_broker_movement($data)){
                $return['status'] = TRUE;
            }else{
                $return['status'] = FALSE;
            }
        }else{
            $return['message'] = 'Error when saving data';
        }
        
        $this->response($return);
    }
    
    public function index_put(){
        $data = $this->array_from_post(array(
            'month_prod','year_prod','grup','broker',
            'target_renew','target_new','achievement_renew','achievement_new'
        ), $this->put());
        
        $id = $this->put('id');
        
        if($this->ref_rekap_m->save($data,$id)){
            $return['status'] = TRUE;
        }else{
            $return['message'] = 'Error when update data';
        }
        
        $this->response($return);
    }
    
    public function index_delete(){
        $success = TRUE;
        foreach($this->delete('ids') as $del){
            $act = $this->ref_rekap_m->delete($del);
            
            if(!$act){
                $success = FALSE;
                break;
            }
        }
        
        if($success){
            $return['status'] = TRUE;
        }else{
            $return['message'] = 'Error when deleting data';
        }
        
        $this->response($return);
    }
    
    public function move_post(){
        $failSave = 0;
        $month_now = date('m');
        $year_now = date('Y');
        
        $data = $this->array_from_post(array(
            'broker','id_rekap'
        ));
        
        foreach($data['id_rekap'] as $rekapId){
            $rekap = $this->ref_rekap_m->get($rekapId);
            
            $broker_movement_data = array(
                'month_prod' => $rekap->month_prod,
                'year_prod' => $rekap->year_prod,
                'grup' => $rekap->grup,
                'broker' => $data['broker']
            );

            // check if month is past or still
            if($rekap->year_prod <= $year_now && $rekap->month_prod <= $month_now){
                $failSave++;
                continue;
            }

            if($this->ref_rekap_m->save(array('broker'=>$data['broker']),$rekapId)){
                if($this->_save_broker_movement($broker_movement_data)){
                    $return['status'] = TRUE;
                }else{
                    $return['status'] = FALSE;
                }
            }else{
                $return['message'] = $this->ref_rekap_m->_last_message();
            }
        }
        
        // add message if any fail
        if($failSave > 0){
            $return['message'] = $failSave . ' data dari ' . count($data['id_rekap']) . ' tidak bisa diproses';
        }
        
        $this->response($return);
    }
    
    private function _save_broker_movement($data){
        if($this->rel_broker_move_m->save($data)){
            return TRUE;
        }
        
        return FALSE;
    }
    
    public function comparison_get(){
        $data_before = $this->array_from_post(array(
            'broker','month_prod','year_prod','grup'
        ), $this->get());
        
        $data_after = $data_before;
        
        unset($data['broker']);
        
        $detail_after = $this->ref_rekap_m->get_by($data,TRUE);
        
        // remove group from array
        unset($data['grup']);
        
        $detail_before = $this->ref_rekap_m->get_by($data,TRUE);
        if($detail_after && $detail_before){
            $return['status'] = TRUE;
            $return['detail']= array(
                'before' => $detail_before,
                'after' => $detail_after
            );
        }else{
            $return['message'] = $this->ref_rekap_m->_last_message();
        }
        
        $this->response($return);
    }
}

/*
 * file name: Rekap_target.php
 */
