<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of Member
 *
 * @author marwansaleh 1:31:58 PM
 */
class Member extends REST_Api {
    
    function __construct($config = 'rest') {
        parent::__construct($config);
        
    }
    
    public function index_post(){
        $this->load->model(array('rel_member_m'));
        $result = array('status'=>FALSE, 'message'=>'');
        
        $id = $this->post('id');
        $nama = $this->post('nama');
        $jenis_kelamin = $this->post('jenis_kelamin');
        $tempat_lahir = $this->post('tempat_lahir');
        $tanggal_lahir = $this->post('tanggal_lahir');
        $agama = $this->post('agama');
        $no_hp = $this->post('no_hp');
        $alamat_email = $this->post('alamat_email');
        $soc_facebook = $this->post('soc_facebook');
        $soc_twitter = $this->post('soc_twitter');
        $soc_instagram = $this->post('soc_instagram');
        $soc_youtube = $this->post('soc_youtube');
        $soc_linkedin = $this->post('soc_linkedin');
        $alamat_rumah = $this->post('alamat_rumah');
        $propinsi = $this->post('propinsi');
        $kota = $this->post('kota');
        $kode_pos = $this->post('kode_post');
        $telepon_rumah = $this->post('telepon_rumah');
        $nama_perusahaan = $this->post('nama_perusahaan');
        $jabatan = $this->post('jabatan');
        $alamat_kantor = $this->post('alamat_kantor');
        $telepon_kantor = $this->post('telepon_kantor');
        $fax_kantor = $this->post('fax_kantor');
        $website_kantor = $this->post('website_kantor');
        $pendidikan_terakhir = $this->post('pendidikan_terakhir');
        
        $data_update = array(
            'nama'                  => $nama,
            'jenis_kelamin'         => $jenis_kelamin,
            'tempat_lahir'          => $tempat_lahir,
            'tanggal_lahir'         => $tanggal_lahir,
            'agama'                 => $agama,
            'no_hp'                 => $no_hp,
            'alamat_email'          => $alamat_email,
            'soc_facebook'          => $soc_facebook,
            'soc_twitter'           => $soc_twitter,
            'soc_instagram'         => $soc_instagram,
            'soc_youtube'           => $soc_youtube,
            'soc_linkedin'          => $soc_linkedin,
            'alamat_rumah'          => $alamat_rumah,
            'propinsi'              => $propinsi,
            'kota'                  => $kota,
            'kode_pos'              => $kode_pos,
            'telepon_rumah'         => $telepon_rumah,
            'nama_perusahaan'       => $nama_perusahaan,
            'jabatan'               => $jabatan,
            'alamat_kantor'         => $alamat_kantor,
            'telepon_kantor'        => $telepon_kantor,
            'fax_kantor'            => $fax_kantor,
            'website_kantor'        => $website_kantor,
            'pendidikan_terakhir'   => $pendidikan_terakhir
        );
        
        if (!$id){
            $data_update = array_merge($data_update, array(
                'tanggal_daftar'      => date('Y-m-d H:i:s')
            ));
        }
        
        $success_id=$this->rel_member_m->save($data_update, $id);
        if ($success_id){
            if (!$id){
                //generate nomor registrasi
                $format = "%d%'.02d-%'.05d";
                $noreg = sprintf($format,date('Y'),date('m'),$success_id);
                
                $this->rel_member_m->save(array('nomor_registrasi'=>$noreg), $success_id);
            }
            $result['status'] = TRUE;
            $result['item'] = $this->rel_member_m->get($success_id);
        }else{
            $result['message'] = $this->rel_member_m->get_last_message();
        }
        
        $this->response($result);
    }
    
    public function index_get(){
        $this->load->model(array('rel_member_m'));
        
        $draw = $this->get('draw');
        $length = $this->get('length');
        $start = $this->get('start');
        $order_arr = $this->get('order');
        $columns_arr = $this->get('columns');
        $search = $this->get('search') ? $this->get('search') : NULL;
        
        //get order by and direction from the order & columns array
        $order_by = $columns_arr[$order_arr[0]['column']]['data'];
        $order_dir = $order_arr[0]['dir']; 
        
        $totalRecords = $this->rel_member_m->get_count();
        
        //set filtered if any
        if ($search && $search['value']){
            $this->db->like('nama', $search['value']);
            $this->db->or_like('nomor_registrasi', $search['value']);
            
        }
        //get filtered count
        $totalFiltered = $this->rel_member_m->get_count();
        
        $result = array('draw' => $draw, 'start'=>$start, 'recordsTotal'=>$totalRecords, 'recordsFiltered'=>$totalFiltered, 'items'=>array());

        if ($totalRecords > 0){
            
            //set filtered if any
            if ($search && $search['value']){
                $this->db->like('nama', $search['value']);
                $this->db->or_like('nomor_registrasi', $search['value']);
            }
            //apply offset and limit of data
            $this->db->order_by($order_by,$order_dir);
            $this->db->offset($start)->limit($length);
            
            $query_result = $this->rel_member_m->get_by();
            if ($query_result){
                foreach ($query_result as $item){
                    $result['items'][] = $item;
                }
            }
        }
        $this->response($result);
    }
    
    public function index_delete(){
        $this->load->model(array('rel_member_m','rel_participant_m','rel_interest_m','rel_training_m','rel_pendidikan_m'));
        $result = array('status'=>FALSE);
        
        $id = $this->get('id');
        $item = $this->rel_member_m->get($id);
        
        if ($item){
            $result['deleted'] = array();
            //delete peserta
            $this->rel_member_m->delete($item->id);
            $result['deleted'][] = 'anggota';
            
            //delete peserta terdaftar di event
            $this->rel_participant_m->delete_where(array('anggota'=>$item->id));
            $result['deleted'][] = 'peserta';
            
            //delete interest peserta
            $this->rel_interest_m->delete_where(array('anggota'=>$item->id));
            $result['deleted'][] = 'interest';
            
            //delete pendidikan peserta
            $this->rel_pendidikan_m->delete_where(array('anggota'=>$item->id));
            $result['deleted'][] = 'pendidikan';
            
            //delete pelatihan peserta
            $this->rel_training_m->delete_where(array('anggota'=>$item->id));
            $result['deleted'][] = 'pelatihan';
            
            $result['status'] = TRUE;
            $result['item'] = $item;
        }else{
            $result['message'] = 'Tidak ada data peserta dengan ID:'.$id;
        }
        $this->response($result);
    }
    
    public function get_get(){
        $this->load->model(array('rel_member_m'));
        $result = array('status'=>FALSE);
        
        $id = $this->get('id');
        $item = $this->rel_member_m->get($id);
        
        if ($item){
            $result['status'] = TRUE;
            $result['item'] = $item;
        }else{
            $result['message'] = 'Data peserta dengan ID:'.$id.' tidak ditemukan';
        }
        $this->response($result);
    }
    
    public function detail_get(){
        $this->load->model(array('rel_member_m','ref_agama_m','ref_event_m','rel_participant_m'));
        $result = array('status'=>FALSE);
        
        $id = $this->get('id');
        $item = $this->rel_member_m->get($id);
        
        if ($item){
            $item->agama = $this->ref_agama_m->get($item->agama);
            $item->events = array();
            $events = $this->rel_participant_m->get_by(array('anggota'=>$item->id));
            if ($events){
                foreach($events as $event_peserta){
                    $event = $this->ref_event_m->get($event_peserta->event);
                    $event->event_participant_id = $event_peserta->id;
                    $event->present = $event_peserta->present;
                    $event->seat = $event_peserta->seat;
                    
                    $item->events[] = $event;
                }
            }
            $result['status'] = TRUE;
            $result['item'] = $item;
        }else{
            $result['message'] = 'Data peserta dengan ID:'.$id.' tidak ditemukan';
        }
        $this->response($result);
    }
    
    public function noreg_post(){
        $this->load->model(array('rel_member_m','ref_agama_m','ref_event_m','rel_participant_m'));
        $result = array('status'=>FALSE);
        
        $nomor_registrasi = $this->post('nomor_registrasi');
        $item = $this->rel_member_m->get_by(array('nomor_registrasi'=>$nomor_registrasi), TRUE);
        
        if ($item){
            $item->agama = $this->ref_agama_m->get($item->agama);
            $item->events = array();
            $events = $this->rel_participant_m->get_by(array('anggota'=>$item->id));
            if ($events){
                foreach($events as $event_peserta){
                    $event = $this->ref_event_m->get($event_peserta->event);
                    $event->event_participant_id = $event_peserta->id;
                    $event->present = $event_peserta->present;
                    $event->seat = $event_peserta->seat;
                    
                    $item->events[] = $event;
                }
            }
            $result['status'] = TRUE;
            $result['item'] = $item;
        }else{
            $result['message'] = 'Data peserta dengan nomor registrasi:'.$nomor_registrasi.' tidak ditemukan';
        }
        $this->response($result);
    }
    
    public function events_get(){
        $this->load->model(array('ref_event_m','rel_participant_m'));
        $result = array('events'=>array());
        
        $member_id = $this->get('member_id');
        $events = $this->rel_participant_m->get_by(array('anggota'=>$member_id));
        if ($events){
            foreach($events as $event_peserta){
                $event = $this->ref_event_m->get($event_peserta->event);
                $event->event_participant_id = $event_peserta->id;
                $event->present = $event_peserta->present;
                $event->seat = $event_peserta->seat;

                $result['events'][] = $event;
            }
        }
        $this->response($result);
    }
    
    public function event_post(){
        $this->load->model(array('rel_participant_m'));
        $result = array('status'=>FALSE);
        
        $anggota = $this->post('anggota');
        $event = $this->post('event');
        $present = $this->post('present');
        $seat = $this->post('seat');
        
        if ($this->rel_participant_m->get_count(array('anggota'=>$anggota,'event'=>$event))){
            $result['message'] = 'Peserta telah mengikuti event ini';
        }else{

            $success_id = $this->rel_participant_m->save(array('anggota'=>$anggota,'event'=>$event,'present'=>$present));
            if ($success_id){
                $result['status'] = TRUE;
                $result['item'] = $this->rel_participant_m->get($success_id);
            }else{
                $result['message'] = $this->rel_participant_m->get_last_message();
            }
        }
        $this->response($result);
    }
    
    public function event_delete(){
        $this->load->model(array('rel_participant_m'));
        $result = array('status'=>FALSE);
        
        $event_participant_id = $this->delete('event');
        $item = $this->rel_participant_m->get($event_participant_id);
        
        if ($item){
            if ($this->rel_participant_m->delete($event_participant_id)){
                $result['status'] = TRUE;
                $result['item'] = $item;
            }else{
                $result['message'] = $this->rel_participant_m->get_last_message();
            }
        }else{
            $result['message'] = 'Data kepesertaan dengan ID:'.$event_participant_id.' tidak ditemukan';
        }
        
        $this->response($result);
    }
    
}

/**
 * Filename : Member.php
 * Location : application/controllers/services/Member.php
 */
