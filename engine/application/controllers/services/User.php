<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of User
 *
 * @author marwansaleh 1:31:58 PM
 */
class User extends REST_Api {
    
    function __construct($config = 'rest') {
        parent::__construct($config);
        
    }
    
    public function index_post(){
        $this->load->model(array('auth_user_m'));
        $result = array('status'=>FALSE, 'message'=>'');
        
        $id = $this->post('id');
        $username = $this->post('username');
        $group_user = $this->post('group_user');
        $organisation = $this->post('organisation');
        $sex = $this->post('sex');
        $active = $this->post('active');
        $fullname = $this->post('fullname');
        $change_password = $this->post('change_password');
        $retype_password = $this->post('retype_password');
        
        $continue = TRUE;
        
        $data_update = array(
            'username'      => $username,
            'group_user'    => $group_user,
            'organisation'  => $organisation,
            'sex'           => $sex,
            'active'        => $active,
            'fullname'      => $fullname
        );
        
        if (!$id){
            //check whether same username exists
            if ($this->auth_user_m->get_count(array('username'=>$username))){
                $result['message'] = 'Same username already exists';
                $continue = FALSE;
            }else if (empty ($change_password) || empty ($retype_password)){
                $result['message'] = 'Password must not empty';
                $continue = FALSE;
            }else if ($change_password != $retype_password){
                $result['message'] = 'Password not matches';
                $continue = FALSE;
            }
            
            $data_update = array_merge($data_update, array(
                'password'      => _hash_($change_password),
                'inserted'      => time()
            ));
        }else{
            if (!empty($change_password)){
                if ($change_password != $retype_password){
                    $result['message'] = 'Password not matches';
                    $continue = FALSE;
                }
                
                $data_update = array_merge($data_update, array('password'=>  _hash_($change_password)));
            }
        }
        
        //if everything is ok, try to update
        if ($continue){
            if ($this->auth_user_m->save($data_update, $id)){
                $result['status'] = TRUE;
            }else{
                $result['message'] = $this->auth_user_m->get_last_message();
            }
        }
        
        $this->response($result);
    }
    
    public function datatable_get(){
        $this->load->model(array('auth_user_m','ref_user_group_m','ref_user_org_m'));
        
        $draw = $this->get('draw');
        $length = $this->get('length');
        $start = $this->get('start');
        $order_arr = $this->get('order');
        $columns_arr = $this->get('columns');
        $search = $this->get('search') ? $this->get('search') : NULL;
        
        //get order by and direction from the order & columns array
        $order_by = $columns_arr[$order_arr[0]['column']]['data'];
        $order_dir = $order_arr[0]['dir']; 
        
        $totalRecords = $this->auth_user_m->get_count();
        
        //set filtered if any
        if ($search && $search['value']){
            $this->db->like('username', $search['value']);
            $this->db->or_like('fullname', $search['value']);
        }
        //get filtered count
        $totalFiltered = $this->auth_user_m->get_count();
        
        $result = array('draw' => $draw, 'start'=>$start, 'recordsTotal'=>$totalRecords, 'recordsFiltered'=>$totalFiltered, 'items'=>array());

        if ($totalRecords > 0){
            
            //set filtered if any
            if ($search && $search['value']){
                $this->db->like('username', $search['value']);
                $this->db->or_like('fullname', $search['value']);
            }
            //apply offset and limit of data
            $this->db->order_by($order_by,$order_dir);
            $this->db->offset($start)->limit($length);
            
            $query_result = $this->auth_user_m->get_by();
            if ($query_result){
                foreach ($query_result as $item){
                    $item->inserted_dt = date("Y-m-d H:i", $item->inserted);
                    $item->group_user = $this->ref_user_group_m->get($item->group_user);
                    $item->organisation = $this->ref_user_org_m->get($item->organisation);
                    $result['items'][] = $item;
                }
            }
        }
        $this->response($result);
    }
    
    public function get_get($id){
        $this->load->model(array('auth_user_m'));
        $result = array('status'=>FALSE);
        
        $item = $this->auth_user_m->get($id);
        if ($item){
            $result['status'] = TRUE;
            $result['item'] = $item;
        }else{
            $result['message'] = 'Data user dengan ID:'.$id.' tidak ditemukan';
        }
        $this->response($result);
    }
    
    public function deletes_delete(){
        $this->load->model(array('auth_user_m'));
        $result = array('status'=>FALSE);
        
        $ids = $this->delete('itemIds');
        
        $success = 0;
        $failed = 0;
        foreach ($ids as $id){
            if ($this->auth_user_m->delete($id)){
                $success++;
            }else{
                $failed++;
            }
        }
        
        $result['status'] = TRUE;
        $result['deleted'] = $success;
        $result['failed'] = $failed;
        
        $this->response($result);
    }
}

/**
 * Filename : User.php
 * Location : application/controllers/services/User.php
 */
