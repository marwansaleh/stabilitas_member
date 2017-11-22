<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 * File Name : Account_officers
 * Created On : Sep 5, 2017 3:21:57 PM
 * @author garaulo (fauziansyah26@gmail.com)
 * Description : 
 */

class Account_officers extends REST_Api{
    private $mktSvc;
    
    function __construct($config = 'rest') {
        parent::__construct($config);
        
        $this->userSvc = new UserService();
        $this->mktSvc = new Marketinglib();
    }
    
    public function select2_get(){
        $q = $this->get('q') ? $this->get('q') : '';
        $page = $this->get('page') ? $this->get('page') : 1;
        $length = 15;
        
        $start = ($page-1) * $length;

        //apply offset and limit of data
        $query_result = $this->userService->get_user_like($q, $length);

        $items = array();
        if ($query_result){
            $count = count($query_result);

            foreach ($query_result as $item){
                $item->text = $item->nama;
                $item->value = $item->id;
                $items[] = $item;
            }
        }else{
            $count = 0;
        }

        $endCount = $start + $length;
        $morePages = $endCount > $count;

        $result = array(
            'results' => $items,
            'pagination' => array(
                'more' => $morePages
            )
        );

        $this->response($result);
    }
    
    public function groups_get($id=NULL){
        $data = $this->mktSvc->get_mkt_grups($id);
        
        if($data){
            $return['status'] = TRUE;
            $return['items'] = $data;
        }else{
            $return['message'] = 'Eror no marketing group found';
        }
        
        $this->response($return);
    }
    
    public function datatable_get(){
        $this->load->model(array('rel_broker_move_m'));
        $where = array();
        
        // check get
        if($this->get('broker')){
            $where['broker'] = $this->get('broker');
        }
        
        $draw = $this->get('draw');
        $length = $this->get('length');
        $start = $this->get('start');
        $order_arr = $this->get('order');
        $columns_arr = $this->get('columns');
        $search = $this->get('search') ? $this->get('search') : NULL;
        
        //get order by and direction from the order & columns array
        $order_by = $columns_arr[$order_arr[0]['column']]['data'];
        $order_dir = $order_arr[0]['dir']; 
        
        $totalRecords = $this->rel_broker_move_m->get_count();
        
        //set filtered if any
        if ($search && $search['value']){
            $where['broker'] = $search['value'];
        }
        //get filtered count
        $totalFiltered = $this->rel_broker_move_m->get_count($where);
        
        $result = array('draw' => $draw, 'start'=>$start, 'recordsTotal'=>$totalRecords, 'recordsFiltered'=>$totalFiltered, 'items'=>array());

        if ($totalRecords > 0){
            //apply offset and limit of data
            $this->db->order_by($order_by,$order_dir);
            $this->db->offset($start)->limit($length);
            
            $query_result = $this->rel_broker_move_m->get_by($where);
            if ($query_result){
                foreach ($query_result as $item){
                    $result['items'][] = $this->_modify_fields($item);
                }
            }
        }
        $this->response($result);
    }
    
    private function _modify_fields($item){
        $item->broker = $this->userService->get_user($item->broker)->nama;
        $item->grup = $this->mktSvc->get_mkt_grups($item->grup,TRUE)->nama;
        $item->month_prod = get_month_name($item->month_prod);
        
        return $item;
    }
}

/*
 * file name: Account_officers.php
 */
