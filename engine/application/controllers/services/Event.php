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
            $item->presents = 0;
            $item->participants = array();
            $participants = $this->rel_participant_m->get_by(array('event'=>$id));
            if ($participants){
                foreach ($participants as $participant){
                    $member = $this->rel_member_m->get($participant->anggota);
                    $member->present = $participant->present;
                    $item->participants [] = $member;
                    $item->presents = $participant->present > 0 ? ($item->presents+1) : $item->presents;
                }
            }
            
            $result['status'] = TRUE;
            $result['item'] = $item;
        }else{
            $result['message'] = 'Data event dengan ID:'.$id.' tidak ditemukan';
        }
        $this->response($result);
    }
    
    public function seats_get(){
        $this->load->model(array('ref_event_m','rel_participant_m'));
        $result = array('status'=>FALSE);
        
        $event_id = $this->get('event_id');
        $member_id = $this->get('member_id');
        
        //get event
        $event = $this->ref_event_m->get($event_id);
        if ($event){
            $result['status'] = TRUE;
            
            $seats = array();
            if ($event->seat > 0){
                $max_seat = $event->seat;
            }else{
                $max_seat = 150;
            }
            
            $seats_occupation = $this->_seat_occupation($event_id);
            
            for ($i=1; $i<=$max_seat; $i++){
                $seat = new stdClass();
                $seat->seat_number = $i;
                $seat->participant = isset($seats_occupation[$i]) ? $seats_occupation[$i] : FALSE;
                $seats[] = $seat;
            }
            $result['seats'] = $seats;
        }else{
            $result['message'] = 'Data event tidak ditemukan';
        }
        
        $this->response($result);
    }
    
    private function _seat_occupation($event_id){
        $this->load->model(array('rel_participant_m'));
        
        $seats = array();
        
        $result = $this->rel_participant_m->get_by(array('event'=>$event_id));
        if ($result){
            foreach ($result as $r){
                $seats[$r->seat] = $r->anggota;
            }
        }
        
        return $seats;
    }
    
    public function seat_post(){
        $this->load->model(array('rel_participant_m'));
        $result = array('status'=>FALSE);
        
        $event_id = $this->post('event_id');
        $member_id = $this->post('member_id');
        $seat = $this->post('seat');
        
        $seat_participant = $this->rel_participant_m->get_by(array('anggota'=>$member_id, 'event'=>$event_id), TRUE);
        if ($seat_participant){
            $this->rel_participant_m->save(array(
                'present'           => 1,
                'seat'              => $seat
            ), $seat_participant->id);
            
            $result['status'] = TRUE;
        }else{
            $result['message'] = 'Data participant tidak ada';
        }
        $this->response($result);
    }
    
    public function participants_get(){
        $this->load->model(array('rel_participant_m','rel_member_m','ref_event_m'));
        $result = array('status'=>FALSE, 'event'=>NULL, 'items'=>array());
        
        $event_id = $this->get('id');
        $event = $this->ref_event_m->get($event_id);
        if ($event){
            $result['status'] = TRUE;
            $result['event'] = $event;
        
            $participants = $this->rel_participant_m->get_by(array('event'=>$event_id));
            foreach ($participants as $parti){
                $parti->ref = $this->rel_member_m->get($parti->anggota);
                $result['items'][] = $parti;
            }
        }
        
        
        $this->response($result);
    }
    
    public function participant_post(){
        $this->load->model(array('rel_participant_m','rel_member_m'));
        $result = array('status'=>FALSE, 'event'=>NULL, 'items'=>array());
        
        $event_id = $this->post('event_id');
        $anggota = $this->post('anggota');
        
        if ($this->rel_participant_m->get_count(array('anggota'=>$anggota,'event'=>$event_id))==0){
            $parti_id = $this->rel_participant_m->save(array(
                'anggota'       => $anggota,
                'event'         => $event_id
            ));
            $result['status'] = TRUE;
        
            $participant = $this->rel_participant_m->get($parti_id);
            $participant->ref = $this->rel_member_m->get($anggota);
            $result['item'] = $participant;
        }else{
            $result['message'] = 'Data yang sama sudah ada di database';
        }
        
        
        $this->response($result);
    }
    
    public function participant_delete(){
        $this->load->model(array('rel_participant_m'));
        $result = array('status'=>FALSE);
        
        $participant_id = $this->delete('participant_id');
        
        $participant = $this->rel_participant_m->get($participant_id);
        if ($participant && $this->rel_participant_m->delete($participant_id)){
            
            $result['status'] = TRUE;
            $result['item'] = $participant;
        }else{
            $result['message'] = $this->rel_participant_m->get_last_message();
        }
        
        
        $this->response($result);
    }
}

/**
 * Filename : Event.php
 * Location : application/controllers/services/Event.php
 */
