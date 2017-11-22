<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of Pic
 *
 * @author marwansaleh 1:31:58 PM
 */
class Pic extends REST_Api {
    
    function __construct($config = 'rest') {
        parent::__construct($config);
    }
    
    public function get_get($id){
        $this->load->model(array('rel_pic_m'));
        $result = array('status'=>FALSE);
        
        $item = $this->rel_person_m->get($id);
        if ($client){
            $result['status'] = TRUE;
            $result['item'] = $item;
        }else{
            $result['message'] = 'Tidak ada data PIC dengan ID:'.$id;
        }
        $this->response($result);
    }
    
    public function datatable_get(){
        $this->load->model(array('rel_person_m'));
        
        $draw = $this->get('draw');
        $length = $this->get('length');
        $start = $this->get('start');
        $order_arr = $this->get('order');
        $columns_arr = $this->get('columns');
        $search = $this->get('search') ? $this->get('search') : NULL;
        
        //get order by and direction from the order & columns array
        $order_by = $columns_arr[$order_arr[0]['column']]['data'];
        $order_dir = $order_arr[0]['dir']; 
        
        
        $totalRecords = $this->rel_person_m->get_count();
        
        //set filtered if any
        if ($search && $search['value']){
            $this->db->like('fullname', $search['value']);
        }
        //get filtered count
        $totalFiltered = $this->rel_person_m->get_count();
        
        $result = array('draw' => $draw, 'start'=>$start, 'recordsTotal'=>$totalRecords, 'recordsFiltered'=>$totalFiltered, 'items'=>array());

        if ($totalRecords > 0){
            
            //set filtered if any
            if ($search && $search['value']){
                $this->db->like('fullname', $search['value']);
            }
            //apply offset and limit of data
            $this->db->order_by($order_by,$order_dir);
            $this->db->offset($start)->limit($length);
            
            $query_result = $this->rel_person_m->get_by();
            if ($query_result){
                foreach ($query_result as $item){
                    $result['items'][] = $item;
                }
            }
        }
        $this->response($result);
    }
    
    public function query_get(){
        $this->load->model(array('rel_pic_m'));
        
        $q = $this->get('q') ? $this->get('q') : '';
        $add_field = $this->get('add_field');
        $length = $this->get('length') ? $this->get('length'):15;
        
        if ($add_field){
            $where = array($add_field['field'] => $add_field['value']);
        }else{
            $where = NULL;
        }
        //apply offset and limit of data
        $this->db->like('fullname',$q);
        $result = $this->rel_pic_m->get_offset('*',$where,0,$length);

        $this->response($result);
    }
    
    public function select2_get(){
        $this->load->model(array('rel_person_m'));
        
        $q = $this->get('q') ? $this->get('q') : '';
        $page = $this->get('page') ? $this->get('page') : 1;
        $length = 15;

        $start = ($page-1) * $length;

        //apply offset and limit of data
        $this->db->like('fullname',$q);
        $query_result = $this->rel_person_m->get_offset('*',NULL,$start,$length);

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
        $this->load->model(array('rel_person_m'));
        $result = array('status'=>FALSE);
        
        $ids = $this->delete('ids');
        $deleted_count = 0;
        if ($ids && count($ids)){
            $result['deleted'] = array();
            $messages = array();
            foreach ($ids as $id){
                $item = $this->rel_person_m->get($id);
                if ($this->rel_person_m->delete($id)){
                    $result['deleted'] [] = $item; 
                    $deleted_count++;
                }else{
                    $messages[] = 'Gagal menghapus data PIC dengan ID:'.$id;
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
        $this->load->model(array('rel_person_m'));
        $result = array('status'=>FALSE);
        
        $item = $this->rel_person_m->get($id);
        if ($id && $this->rel_person_m->delete($id)){
            $result['status'] = TRUE;
            $result['item'] = $item;
        }else{
            $result['message'] = 'Gagal menghapus data PIC dengan ID:'.$id;
        }
        $this->response($result);
    }
}

/**
 * Filename : Pic.php
 * Location : application/controllers/services/Pic.php
 */
