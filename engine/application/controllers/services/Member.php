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
        }
        //get filtered count
        $totalFiltered = $this->rel_member_m->get_count();
        
        $result = array('draw' => $draw, 'start'=>$start, 'recordsTotal'=>$totalRecords, 'recordsFiltered'=>$totalFiltered, 'items'=>array());

        if ($totalRecords > 0){
            
            //set filtered if any
            if ($search && $search['value']){
                $this->db->like('nama', $search['value']);
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
    
    public function events_get(){
        $this->load->model(array('ref_event_m','rel_participant_m'));
        $result = array('event'=>array());
        
        $member_id = $this->get('member_id');
        $events = $this->rel_participant_m->get_by(array('anggota'=>$member_id));
        if ($events){
            foreach($events as $event_peserta){
                $event = $this->ref_event_m->get($event_peserta->event);
                $event->event_participant_id = $event_peserta->id;
                $event->present = $event_peserta->present;

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
        $present = $this->post('event');
        
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
    
    public function confirm_edit_post(){
        $this->load->model(array('rel_batch_penutupan_m','rel_penutupan_m','rel_premi_rate_m','rel_history_m'));
        $result = array('status'=>FALSE);
        
        $batchID = $this->post('batch');
        $id = $this->post('id');
        $nama_peserta = $this->post('nama_peserta');
        $tanggal_lahir = $this->post('tanggal_lahir');
        $nip_peserta = $this->post('nip_peserta');
        $no_ktp = $this->post('no_ktp');
        $alamat = $this->post('alamat');
        $pendapatan_bulanan = $this->post('pendapatan_bulanan');
        $plafon_kredit =  $this->post('plafon_kredit');
        $waktu_mulai = $this->post('waktu_mulai');
        $waktu_akhir = $this->post('waktu_akhir');
        
        $tenor = tenor_calc($waktu_mulai, $waktu_akhir);
        $premi_rate_row = $this->rel_premi_rate_m->get_by(array('tenor'=>$tenor), TRUE);
        if ($premi_rate_row){
            $premi_rate = $premi_rate_row->rate;
        }else{
            $premi_rate = 0;
        }
        
        $data_update = array(
            'nama_peserta'      => $nama_peserta,
            'tanggal_lahir'     => $tanggal_lahir,
            'nip_peserta'       => $nip_peserta,
            'no_ktp'            => $no_ktp,
            'alamat'            => $alamat,
            'pendapatan_bulanan'=> $pendapatan_bulanan,
            'plafon_kredit'     => $plafon_kredit,
            'waktu_mulai'       => $waktu_mulai,
            'waktu_akhir'       => $waktu_akhir,
            'tenor'             => $tenor,
            'rate_premi'        => $premi_rate,
            'nilai_premi'       => $premi_rate * $plafon_kredit,
            'inserted'          => time()
        );
        if ($this->rel_penutupan_m->save($data_update, $id)){

            $calculate = $this->rel_penutupan_m->calculate_sum($batchID);
            //update table batch penutupan
            $this->rel_batch_penutupan_m->save(array(
                'tsi_penutupan'     => $calculate->plafon_kredit,
                'premi_penutupan'   => $calculate->nilai_premi
            ), $batchID);
            
            $result['status'] = TRUE;
            
            //update action history
            $this->rel_history_m->save(array(
                'act_date'              => date('Y-m-d H:i:s'),
                'batch'                 => $batchID,
                'item'                  => $id,
                'action'                => 'Update detail data penutupan asuransi itemId:'.$id
            ));
        }else{
            $result['message'] = $this->rel_penutupan_m->get_last_message();
        }
        $this->response($result);
    }
    
    public function batch_confirm_post(){
        $this->load->model(array('rel_batch_penutupan_m','rel_penutupan_m','rel_history_m'));
        $result = array('status'=>FALSE);
        
        $batch_id = $this->post('id');
        //get the batch
        $batch = $this->rel_batch_penutupan_m->get($batch_id);
        if ($batch && $batch->status != BATCH_CONFIRMED){
            //get data penutupan
            $penutupans = $this->rel_penutupan_m->get_by(array('batch'=>$batch_id));
            $confirmed = 0;
            foreach ($penutupans as $item){
                if ($item->status == BATCH_UPLOADED){
                    $this->rel_penutupan_m->save(array('status'=>BATCH_CONFIRMED), $item->id);
                    $confirmed++;
                }
            }
            
            $this->rel_batch_penutupan_m->save(array('status'=>BATCH_CONFIRMED), $batch_id);
            
            $result['status'] = TRUE;
            $result['confirmed'] = $confirmed;
            
            //update action history
            $this->rel_history_m->save(array(
                'act_date'              => date('Y-m-d H:i:s'),
                'batch'                 => $batch_id,
                'item'                  => 0,
                'action'                => 'Konfirmasi data penutupan asuransi'
            ));
        }
        
        $this->response($result);
    }
    
    public function batch_cancel_delete(){
        $this->load->model(array('rel_batch_penutupan_m','rel_penutupan_m'));
        $result = array('status'=>FALSE);
        
        $batch_id = $this->delete('id');
        //get the batch
        $batch = $this->rel_batch_penutupan_m->get($batch_id);
        if ($batch && $batch->status != BATCH_CONFIRMED){
            //delete data penutupan
            $this->rel_penutupan_m->delete_where(array('batch'=>$batch_id));
            
            //delete data batch
            $this->rel_batch_penutupan_m->delete($batch_id);
            
            $result['status'] = TRUE;
            
            //update action history
            $this->rel_history_m->save(array(
                'act_date'              => date('Y-m-d H:i:s'),
                'batch'                 => $batch_id,
                'item'                  => 0,
                'action'                => 'Pembatalan data penutupan asuransi'
            ));
        }else{
            $result['message'] = 'Data batch penutupan tidak dapat dibatalkan lagi.';
        }
        
        $this->response($result);
    }
    
    public function batch_deletes_delete(){
        $this->load->model(array('rel_batch_penutupan_m','rel_penutupan_m'));
        $result = array('status'=>FALSE);
        
        $ids = $this->delete('itemIds');
        
        $success = 0;
        $failed = 0;
        foreach ($ids as $id){
            //get the batch
            $batch = $this->rel_batch_penutupan_m->get($id);
            if ($batch->status == BATCH_UPLOADED){
                if ($this->rel_batch_penutupan_m->delete($id)){
                    //Hapus data detail penutupan
                    $this->rel_penutupan_m->delete_where(array('batch'=>$id));
                    $success++;
                }else{
                    $failed++;
                }
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
 * Filename : Member.php
 * Location : application/controllers/services/Member.php
 */
