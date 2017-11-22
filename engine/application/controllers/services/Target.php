<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
FileName	Target
Created On	11:03:48 AM
@garaulo (fauziansyah26@gmail.com)
Description 	:
*/

class Target extends REST_Api{
    private $mailSubject = 'REMINDER TARGET PRODUKSI 3 BULAN KEDEPAN';
    private $mail_conf;
    private $mktLib;
    private $_year_prod;
    private $_month_prod;
    
    function __construct($config = 'rest') {
        parent::__construct($config);
        
        $this->load->model(array('ref_target_m','ref_client_m','rel_agenda_m',
                                'rel_mail_m','ref_mail_conf_m','ref_rekap_m'));
        
        $this->mail_conf = $this->ref_mail_conf_m->get(NULL, TRUE);
        
        // Add Sender Name
        $this->mail_conf->sender_name = 'BSM APP';
        
        $this->mktLib = new Marketinglib();
    }
    
    public function datatable_get($is_supervisor = FALSE, $month_prod = NULL, $year_prod = NULL){
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
        
        if($this->me != ID_USER_ROOT && !$is_supervisor){
            // filter data by me
            $this->db->where('broker', $this->me);
        }
        
        if($month_prod){
            if(!$year_prod){
                $split = explode("-",$month_prod);
                $month_prod = $split[0];
                $year_prod = $split[1];
            }
            
            $this->db->where('month_prod',$month_prod);
            $this->db->where('year_prod',$year_prod);
        }else{
            $this->db->where('month_prod',intval(date('m')));
            $this->db->where('year_prod',date('Y'));
        }
        
        // get rekap id
        $rekap = $this->ref_rekap_m->get(NULL,TRUE);
        
        // add where clause
        $where = array(
            'rekap' => $rekap->id
        );
        
        $totalRecords = $this->ref_target_m->get_count($where);
        
        //set filtered if any
        if ($search && $search['value']){
            $this->db->like('target', $search['value']);
            $this->db->or_like('criteria', $search['value']);
            
            // search by client
            $this->_like_client($search['value']);
        }
        
        //get filtered count
        $totalFiltered = $this->ref_target_m->get_count($where);
//        print_r($this->db->last_query());exit;
        $result = array('draw' => $draw, 'start'=>$start, 'recordsTotal'=>$totalRecords, 'recordsFiltered'=>$totalFiltered, 'items'=>array());

        if ($totalRecords > 0){
            
            //set filtered if any
            if ($search && $search['value']){
                $this->db->like('target', $search['value']);
                $this->db->or_like('criteria', $search['value']);
                
                // search by client
                $this->_like_client($search['value']);
            }
            //apply offset and limit of data
            $this->db->order_by($order_by,$order_dir);
            $this->db->offset($start)->limit($length);
            
            $query_result = $this->ref_target_m->get_by($where);
            
            if ($query_result){
                foreach ($query_result as $item){
                    // add broker id from rekap table
                    $item->broker = $rekap->broker;
                    
                    if($is_supervisor){
                        $bidang_broker = $this->userService->get_user($item->broker)->bidang->id;
                        if(!in_array($bidang_broker, $this->_is_supervisor()['bidang'])){
                            continue;
                        }
                    }
                    
                    if($item->broker == ID_USER_ROOT){
                        $item->editable = true;
                    }else{
                        $item->editable = false;
                    }
                    $item->editable = ($this->me == ID_USER_ROOT) ? TRUE:FALSE;
                    $item->broker = $this->userService->get_user($item->broker)->nama;
                    $item->client_name = $this->ref_client_m->get($item->client)->fullname;
                    $item->target = number_format($item->target,2);
                    $item->criteria = ucfirst($item->criteria);
                    $item->agenda_count = $this->_count_agenda($item->id);
                    
                    $result['items'][] = $item;
                }
            }
        }
        $this->response($result);
    }
    
    private function _count_agenda($id){
        $count = $this->rel_agenda_m->get_count(array(
            'target_id' => $id
        ));
        
        return $count;
    }
    
    private function _like_client($search){
        $this->load->model('ref_client_m');
        
        $this->db->like('fullname',$search);
        $data = $this->ref_client_m->get();
        
        foreach($data as $item){
            $this->db->or_like('client', $item->id);
        }
    } 
    
    public function index_get($id){
        $item = $this->ref_target_m->get($id);
        
        $this->response(array(
            'item' => $this->_modify_fields($item)
        ));
    }
    
    private function _modify_fields($item){
        $this->load->model(array('ref_client_m','ref_rekap_m'));
        
        $item->client_name = $this->ref_client_m->get($item->client)->fullname;
        $item->target = number_format($item->target,2);
        
        // get broker id from rekap
        $rekap = $this->ref_rekap_m->get($item->rekap);
        
        $item->broker_name = $this->userService->get_user($rekap->broker)->nama;
        $item->month_prod = $rekap->year_prod . '-' . sprintf('%02d', $rekap->month_prod);
        
        return $item;
    }
    
    public function index_post(){
        $arr = array(
            'client' => $this->post('client'),
            'target' => $this->post('target'),
            'criteria' => $this->post('criteria'),
            'rekap' => $this->post('rekap'),
            'created_by' => $this->me
        );
        
        $save = $this->ref_target_m->save($arr);
        if($save){
            $return['status'] = TRUE;
        }else{
            $return['message'] = 'Error when saving data';
        }
        
        $this->response($return);
    }
    
    public function delete_delete(){
        $this->load->model('rel_agenda_m');
        $ok = TRUE;
        foreach($this->delete('itemIds') as $item){
            $del = $this->ref_target_m->delete($item);
            
            // delete agenda that belongs to target
            if($del){
                $del = $this->rel_agenda_m->delete_where(array('target_id' => $item));
            }
            
            if(!$del){
                $ok = FALSE;
                break;
            }
        }
        
        if($ok){
            $return['status'] = TRUE;
        }else{
            $return['message'] = 'Error when deleting data';
        }
        
        $this->response($return);
    }
    
    public function index_put($id){
        $sent_notif = false;
        
        foreach ($this->put() as $key=>$val){
            $data = array(
                $key => $val
            );
            
            if($key === 'is_achieved'){
                $data['achieved_date'] = date('Y-m-d H:i:s');
                $sent_notif = TRUE;
            }
        }
        
        $update = $this->ref_target_m->save($data, $id);
        
        if($update){
            $return['status'] = TRUE;
            
            // insert notif to managers
            $targetdata = $this->ref_target_m->get($id);
            $this->insert_notif(NOTIF_TYPE_MESSAGE,NOTIF_DEF_IS_ACHIEVED,array(
                '*BROKER_NAME*' => $this->meDetail->nama,
                '*TARGET_ID*' => $id,
                '*CLIENT_NAME*' => $this->ref_client_m->get($targetdata->client)->fullname
            ));
        }else{
            $return['message'] = 'Error when updating data';
        }
        
        $this->response($return);
    }
    
    public function get_get($groupId = NULL){
        
        // define month and year production
        $this->_month_prod = $this->get('month') ? $this->get('month'):date('m');
        $this->_year_prod = $this->get('year') ? $this->get('year'):date('Y');
        
        $bidangs = $this->mktLib->get_mkt_grups($groupId);
        
        foreach($bidangs as $bidang){
            $staffs = $this->mktLib->get_staff($bidang->id);
            
            $bidang->sum_target_renew = $this->_sum_of_target($staffs,'target_renew');
            $bidang->sum_target_new = $this->_sum_of_target($staffs,'target_new');
            $bidang->sum_achieve_renew = $this->_sum_of_target($staffs,'achievement_renew');
            $bidang->sum_achieve_new = $this->_sum_of_target($staffs,'achievement_new');
            
            $bidang->brokers = $this->_get_brokers($staffs);
        }
        
        if($bidangs){
            $return['status'] = TRUE;
            $return['items'] = $bidangs;
        }else{
            $return['message'] = 'Error when getting data';
        }
        
        $this->response($return);
    }
    
    private function _sum_of_target($staffs, $field){
        $return = 0;
        
        foreach($staffs as $staff){
            $this->db->where('broker',$staff->id);
            $this->db->where('month_prod', $this->_month_prod);
            $this->db->where('year_prod', $this->_year_prod);
            $rekap = $this->ref_rekap_m->get(NULL,TRUE);
            
            $return = $rekap ? $return + $rekap->$field: $return + 0;
        }
        
        return number_format($return,2);
    }
    
    private function _get_brokers($staffs){
        foreach($staffs as $staff){
            $this->db->where('broker',$staff->id);
            $this->db->where('month_prod', $this->_month_prod);
            $this->db->where('year_prod', $this->_year_prod);
            $this->db->select('sum(target_renew) as `targets_renew`,sum(target_new) as `targets_new`, sum(achievement_renew) as `achieves_renew`, sum(achievement_new) as `achieves_new`');
            $target = $this->ref_rekap_m->get(NULL,TRUE);
            
            $staff->target_renew = number_format(floatval($target->targets_renew),2);
            $staff->target_new = number_format(floatval($target->targets_new),2);
            $staff->achieve_renew = number_format(floatval($target->achieves_renew),2);
            $staff->achieve_new = number_format(floatval($target->achieves_new),2);
            $staff->sisa_renew = number_format(floatval($target->achieves_renew) - floatval($target->targets_renew),2);
            $staff->sisa_new = number_format(floatval($target->achieves_new) - floatval($target->targets_new),2);
        }
        
        return $staffs;
    }
    
    /**
     * check user as supervisor
     * @return array
     */
    private function _is_supervisor(){
        $me = $this->userService->get_user($this->me);
        $level = $me->level;
        
        $bidangs = $this->userService->get_bidang(TRUE);
        
        $mybidang = array();
        foreach($bidangs as $item){
            if($item->id === $me->bidang->id || $item->parent === $me->bidang->id){
                $mybidang[] = $item->id;
            }
        }
        
        $array = array(
            'status' => is_supervisor($level),
            'bidang' => $mybidang
        );
        
        return $array;
    }
}