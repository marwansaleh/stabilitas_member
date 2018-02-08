<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of Training
 *
 * @author marwansaleh 1:31:58 PM
 */
class Training extends REST_Api {
    
    function __construct($config = 'rest') {
        parent::__construct($config);
        
    }
    
    public function index_post(){
        $this->load->model(array('ref_training_m'));
        $result = array('status'=>FALSE, 'message'=>'');
        
        $id = $this->post('id');
        $training = $this->post('training');
        $penyelenggara = $this->post('penyelenggara');
        $tahun = $this->post('tahun');
        
        $data_update = array(
            'training'          => $training,
            'penyelenggara'     => $penyelenggara,
            'tahun'             => $tahun
        );
        
        $success_id=$this->ref_training_m->save($data_update, $id);
        if ($success_id){
            $result['status'] = TRUE;
            $result['item'] = $this->ref_training_m->get($success_id);
        }else{
            $result['message'] = $this->ref_training_m->get_last_message();
        }
        
        $this->response($result);
    }
    
    public function index_get(){
        $this->load->model(array('ref_training_m','rel_training_m'));
        
        $draw = $this->get('draw');
        $length = $this->get('length');
        $start = $this->get('start');
        $order_arr = $this->get('order');
        $columns_arr = $this->get('columns');
        $search = $this->get('search') ? $this->get('search') : NULL;
        
        //get order by and direction from the order & columns array
        $order_by = $columns_arr[$order_arr[0]['column']]['data'];
        $order_dir = $order_arr[0]['dir']; 
        
        $totalRecords = $this->ref_training_m->get_count();
        
        //set filtered if any
        if ($search && $search['value']){
            $this->db->like('training', $search['value']);
            $this->db->or_like('penyelenggara', $search['value']);
            $this->db->or_like('tahun', $search['value']);
        }
        //get filtered count
        $totalFiltered = $this->ref_training_m->get_count();
        
        $result = array('draw' => $draw, 'start'=>$start, 'recordsTotal'=>$totalRecords, 'recordsFiltered'=>$totalFiltered, 'items'=>array());

        if ($totalRecords > 0){
            
            //set filtered if any
            if ($search && $search['value']){
                $this->db->like('training', $search['value']);
                $this->db->or_like('penyelenggara', $search['value']);
                $this->db->or_like('tahun', $search['value']);
            }
            //apply offset and limit of data
            $this->db->order_by($order_by,$order_dir);
            $this->db->offset($start)->limit($length);
            
            $query_result = $this->ref_training_m->get_by();
            if ($query_result){
                foreach ($query_result as $item){
                    $item->jumlah_peserta = $this->rel_training_m->get_count(array('pelatihan'=>$item->id));
                    $result['items'][] = $item;
                }
            }
        }
        $this->response($result);
    }
    
    public function get_get(){
        $this->load->model(array('ref_training_m'));
        $result = array('status'=>FALSE);
        
        $id = $this->get('id');
        $item = $this->ref_training_m->get($id);
        
        if ($item){
            $result['status'] = TRUE;
            $result['item'] = $item;
        }else{
            $result['message'] = 'Data training dengan ID:'.$id.' tidak ditemukan';
        }
        $this->response($result);
    }
    
    public function detail_get(){
        $this->load->model(array('ref_training_m','rel_training_m', 'rel_member_m'));
        $result = array('status'=>FALSE);
        
        $id = $this->get('id');
        $item = $this->ref_training_m->get($id);
        
        if ($item){
            $item->participants = array();
            $sql = "SELECT P.anggota, M.nama, M.nama_perusahaan, M.jabatan FROM `rel_pelatihan_anggota` P
                    JOIN `rel_anggota` M ON M.id=P.anggota
                    WHERE P.pelatihan=$id";
            $participants = $this->db->query($sql)->result();
            if ($participants){
                $item->participants = $participants;
            } else {
                $item->participants = null;
            }
            
            $result['status'] = TRUE;
            $result['item'] = $item;
        }else{
            $result['message'] = 'Data training dengan ID:'.$id.' tidak ditemukan';
        }
        $this->response($result);
    }
}

/**
 * Filename : Training.php
 * Location : application/controllers/services/Training.php
 */
