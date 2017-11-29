<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of Event
 *
 * @author marwansaleh 1:31:58 PM
 */
class Event extends REST_Api {
    
    function __construct($config = 'rest') {
        parent::__construct($config);
        
    }
    
    public function index_post(){
        $this->load->model(array('ref_event_m'));
        $result = array('status'=>FALSE, 'message'=>'');
        
        $id = $this->post('id');
        $nama_kegiatan = $this->post('nama_kegiatan');
        $tanggal = $this->post('tanggal');
        $jumlah_hari = $this->post('jumlah_hari');
        $seat = $this->post('seat');
        $lokasi = $this->post('lokasi');
        
        $data_update = array(
            'nama_kegiatan'     => $nama_kegiatan,
            'tanggal'           => $tanggal,
            'jumlah_hari'       => $jumlah_hari,
            'seat'              => $seat,
            'lokasi'            => $lokasi,
        );
        
        $success_id=$this->ref_event_m->save($data_update, $id);
        if ($success_id){
            $result['status'] = TRUE;
            $result['item'] = $this->ref_event_m->get($success_id);
        }else{
            $result['message'] = $this->ref_event_m->get_last_message();
        }
        
        $this->response($result);
    }
    
    public function index_get(){
        $this->load->model(array('ref_event_m','rel_participant_m'));
        
        $draw = $this->get('draw');
        $length = $this->get('length');
        $start = $this->get('start');
        $order_arr = $this->get('order');
        $columns_arr = $this->get('columns');
        $search = $this->get('search') ? $this->get('search') : NULL;
        
        //get order by and direction from the order & columns array
        $order_by = $columns_arr[$order_arr[0]['column']]['data'];
        $order_dir = $order_arr[0]['dir']; 
        
        $totalRecords = $this->ref_event_m->get_count();
        
        //set filtered if any
        if ($search && $search['value']){
            $this->db->like('nama_kegiatan', $search['value']);
        }
        //get filtered count
        $totalFiltered = $this->ref_event_m->get_count();
        
        $result = array('draw' => $draw, 'start'=>$start, 'recordsTotal'=>$totalRecords, 'recordsFiltered'=>$totalFiltered, 'items'=>array());

        if ($totalRecords > 0){
            
            //set filtered if any
            if ($search && $search['value']){
                $this->db->like('nama_kegiatan', $search['value']);
            }
            //apply offset and limit of data
            $this->db->order_by($order_by,$order_dir);
            $this->db->offset($start)->limit($length);
            
            $query_result = $this->ref_event_m->get_by();
            if ($query_result){
                foreach ($query_result as $item){
                    $item->jumlah_peserta = $this->rel_participant_m->get_count(array('event'=>$item->id));
                    $result['items'][] = $item;
                }
            }
        }
        $this->response($result);
    }
    
    public function get_get(){
        $this->load->model(array('ref_event_m'));
        $result = array('status'=>FALSE);
        
        $id = $this->get('id');
        $item = $this->ref_event_m->get($id);
        
        if ($item){
            $result['status'] = TRUE;
            $result['item'] = $item;
        }else{
            $result['message'] = 'Data peserta dengan ID:'.$id.' tidak ditemukan';
        }
        $this->response($result);
    }
    
    public function detail_get(){
        $this->load->model(array('ref_event_m','rel_participant_m', 'rel_member_m'));
        $result = array('status'=>FALSE);
        
        $id = $this->get('id');
        $item = $this->ref_event_m->get($id);
        
        if ($item){
            $item->participants = array();
            $participants = $this->rel_participant_m->get_by(array('event'=>$id));
            if ($participants){
                foreach ($participants as $participant){
                    $member = $this->rel_member_m->get($participant->anggota);
                    $member->present = $participant->present;
                    $item->participants [] = $member;
                }
            }
            $result['status'] = TRUE;
            $result['item'] = $item;
        }else{
            $result['message'] = 'Data event dengan ID:'.$id.' tidak ditemukan';
        }
        $this->response($result);
    }
}

/**
 * Filename : Event.php
 * Location : application/controllers/services/Event.php
 */
