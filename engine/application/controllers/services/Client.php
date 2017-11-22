<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of Client
 *
 * @author marwansaleh 1:31:58 PM
 */
class Client extends REST_Api {
    
    function __construct($config = 'rest') {
        parent::__construct($config);
    }
    
    public function get_get($id){
        $this->load->model(array('ref_client_m'));
        $result = array('status'=>FALSE);
        
        $client = $this->ref_client_m->get($id);
        if ($client){
            $result['status'] = TRUE;
            $result['item'] = $client;
        }else{
            $result['message'] = 'Tidak ada data client dengan ID:'.$id;
        }
        $this->response($result);
    }
    
    public function save_post(){
        $this->load->model(array('ref_client_m'));
        $result = array('status'=>FALSE);
        
        $fullname = $this->post('fullname');
        $captive = $this->post('captive');
        
        //check apakah sudah ada
        if ($this->ref_client_m->get_count(array('fullname'=>$fullname))){
            $result['message'] = 'Nama Client yang sama sudah ada di database';
        }else{

            $id = $this->ref_client_m->save(array(
                'fullname'      => $fullname,
                'captive'       => $captive,
                'created'       => time()
            ), $this->post('id'));

            if ($id){
                $result['status'] = TRUE;
                $result['item'] = $this->ref_client_m->get($id);
            }else{
                $result['message'] = $this->ref_client_m->get_last_message();
            }
        }
        $this->response($result);
    }
    
    public function datatable_get(){
        $this->load->model(array('ref_client_m'));
        
        $draw = $this->get('draw');
        $length = $this->get('length');
        $start = $this->get('start');
        $order_arr = $this->get('order');
        $columns_arr = $this->get('columns');
        $search = $this->get('search') ? $this->get('search') : NULL;
        
        //get order by and direction from the order & columns array
        $order_by = $columns_arr[$order_arr[0]['column']]['data'];
        $order_dir = $order_arr[0]['dir']; 
        
        
        $totalRecords = $this->ref_client_m->get_count();
        
        //set filtered if any
        if ($search && $search['value']){
            $this->db->like('fullname', $search['value']);
        }
        //get filtered count
        $totalFiltered = $this->ref_client_m->get_count();
        
        $result = array('draw' => $draw, 'start'=>$start, 'recordsTotal'=>$totalRecords, 'recordsFiltered'=>$totalFiltered, 'items'=>array());

        if ($totalRecords > 0){
            
            //set filtered if any
            if ($search && $search['value']){
                $this->db->like('fullname', $search['value']);
            }
            //apply offset and limit of data
            $this->db->order_by($order_by,$order_dir);
            $this->db->offset($start)->limit($length);
            
            $query_result = $this->ref_client_m->get_by();
            if ($query_result){
                foreach ($query_result as $item){
                    $item->created = date('Y-m-d H:i', $item->created);
                    $result['items'][] = $item;
                }
            }
        }
        $this->response($result);
    }
    
    public function select2_get(){
        $this->load->model(array('ref_client_m'));
        
        $q = $this->get('q') ? $this->get('q') : '';
        $page = $this->get('page') ? $this->get('page') : 1;
        $length = 15;

        $start = ($page-1) * $length;

        //apply offset and limit of data
        $this->db->like('fullname',$q);
        $query_result = $this->ref_client_m->get_offset('*',NULL,$start,$length);

        $items = array();
        if ($query_result){
            $count = count($query_result);

            foreach ($query_result as $item){
                $item->text = $item->fullname;
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
    
    public function deletes_delete(){
        $this->load->model(array('ref_client_m'));
        $result = array('status'=>FALSE);
        
        $ids = $this->delete('ids');
        $deleted_count = 0;
        if ($ids && count($ids)){
            $result['deleted'] = array();
            $messages = array();
            foreach ($ids as $id){
                $item = $this->ref_client_m->get($id);
                if ($this->ref_client_m->delete($id)){
                    $result['deleted'] [] = $item; 
                    $deleted_count++;
                }else{
                    $messages[] = 'Gagal menghapus data client dengan ID:'.$id;
                }
            }
            if ($deleted_count==0){
                $result['message'] = implode('<br>', $messages);
            }else{
                $result['status'] = TRUE;
            }
        }else{
            $result['message'] = 'Data ID tidak valid';
        }
        
        $this->response($result);
    }
    
    public function delete_delete($id){
        $this->load->model(array('ref_client_m'));
        $result = array('status'=>FALSE);
        
        $item = $this->ref_client_m->get($id);
        if ($id && $this->ref_client_m->delete($id)){
            $result['status'] = TRUE;
            $result['item'] = $item;
        }else{
            $result['message'] = 'Gagal menghapus data client dengan ID:'.$id;
        }
        $this->response($result);
    }
    
    public function index_post(){
        $this->load->model(array('ref_client_m'));
        
        $name = $this->post('name');
        $captive = $this->post('captive');
        
        $save = $this->ref_client_m->save(array(
            'fullname' => $name,
            'captive' => $captive
        ));
        
        if($save){
            $return['status'] = TRUE;
        }else{
            $return['message'] = 'Error when saving data';
        }
        
        $this->response($return);
    }
}

/**
 * Filename : Client.php
 * Location : application/controllers/services/Client.php
 */
