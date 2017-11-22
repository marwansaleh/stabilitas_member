<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of Pembayaran
 *
 * @author marwansaleh 1:31:58 PM
 */
class Pembayaran extends REST_Api {
    
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
    
    public function batches_get(){
        $this->load->model(array('rel_batch_penutupan_m','auth_user_m'));
        
        $draw = $this->get('draw');
        $length = $this->get('length');
        $start = $this->get('start');
        $order_arr = $this->get('order');
        $columns_arr = $this->get('columns');
        $search = $this->get('search') ? $this->get('search') : NULL;
        
        //get order by and direction from the order & columns array
        $order_by = $columns_arr[$order_arr[0]['column']]['data'];
        $order_dir = $order_arr[0]['dir']; 
        
        $totalRecords = $this->rel_batch_penutupan_m->get_count();
        
        //set filtered if any
        if ($search && $search['value']){
            $this->db->like('tanggal_upload', $search['value']);
        }
        //get filtered count
        $totalFiltered = $this->rel_batch_penutupan_m->get_count();
        
        $result = array('draw' => $draw, 'start'=>$start, 'recordsTotal'=>$totalRecords, 'recordsFiltered'=>$totalFiltered, 'items'=>array());

        if ($totalRecords > 0){
            
            //set filtered if any
            if ($search && $search['value']){
                $this->db->like('rel_batch_penutupan_m', $search['value']);
            }
            //apply offset and limit of data
            $this->db->order_by($order_by,$order_dir);
            $this->db->offset($start)->limit($length);
            
            $query_result = $this->rel_batch_penutupan_m->get_by();
            if ($query_result){
                foreach ($query_result as $item){
                    $item->user_upload = $this->auth_user_m->get($item->user_upload);
                    $result['items'][] = $item;
                }
            }
        }
        $this->response($result);
    }
    
    public function batch_detail_get($batch_id){
        $this->load->model(array('rel_penutupan_m'));
        
        $draw = $this->get('draw');
        $length = $this->get('length');
        $start = $this->get('start');
        $order_arr = $this->get('order');
        $columns_arr = $this->get('columns');
        $search = $this->get('search') ? $this->get('search') : NULL;
        
        //get order by and direction from the order & columns array
        $order_by = $columns_arr[$order_arr[0]['column']]['data'];
        $order_dir = $order_arr[0]['dir']; 
        
        $where = array('batch'=>$batch_id);
        $totalRecords = $this->rel_penutupan_m->get_count($where);
        
        //set filtered if any
        if ($search && $search['value']){
            $this->db->like('nama_peserta', $search['value']);
            $this->db->or_like('nip_peserta', $search['value']);
            $this->db->or_like('no_ktp', $search['value']);
        }
        //get filtered count
        $totalFiltered = $this->rel_penutupan_m->get_count($where);
        
        $result = array('draw' => $draw, 'start'=>$start, 'recordsTotal'=>$totalRecords, 'recordsFiltered'=>$totalFiltered, 'items'=>array());

        if ($totalRecords > 0){
            
            //set filtered if any
            if ($search && $search['value']){
                $this->db->like('nama_peserta', $search['value']);
                $this->db->or_like('nip_peserta', $search['value']);
                $this->db->or_like('no_ktp', $search['value']);
            }
            //apply offset and limit of data
            $this->db->order_by($order_by,$order_dir);
            $this->db->offset($start)->limit($length);
            
            $query_result = $this->rel_penutupan_m->get_by($where);
            if ($query_result){
                foreach ($query_result as $item){
                    $result['items'][] = $item;
                }
            }
        }
        $this->response($result);
    }
    
    public function batch_upload_post(){
        $this->load->model(array('rel_batch_penutupan_m','rel_history_m'));
        
        $result = array('error'=>NULL, 'initialPreview'=>NULL, 'initialPreviewConfig'=>NULL, 'initialPreviewThumbTags'=>TRUE);
        
        $upload_path = sys_get_temp_dir();
        
        $config['upload_path'] = $upload_path;
        $config['allowed_types'] = 'doc|docx|xls|xlsx';
        $config['max_size'] = 10000;

        $this->load->library('upload', $config);
        
        if (!$this->upload->do_upload('userfile')) {
            $result['error'] = $this->upload->display_errors();
        } else {
            $upload = $this->upload->data();
            
            //create new batch data rows
            $batchID = $this->rel_batch_penutupan_m->save(array(
                'tanggal_upload'        => date('Y-m-d H:i:s'),
                'user_upload'           => $this->post('user_upload'),
                'status'                => 0
            ));
            //read downloaded file
            $read_result = $this->_read_batch_penutupan_file($batchID, $upload['full_path'], 2);
            if ($read_result->status){
                $result['status'] = TRUE;
                $result['batch_id'] = $batchID;
                $result['upload'] = $read_result;
            }
            
            //update action history
            $this->rel_history_m->save(array(
                'act_date'              => date('Y-m-d H:i:s'),
                'batch'                 => $batchID,
                'item'                  => 0,
                'action'                => 'Upload data penutupan asuransi'
            ));
        }
        
        $this->response($result);
    }
    
    private function _read_batch_penutupan_file($batchID, $excel_file, $start_row=1){
        $this->load->model(array('rel_batch_penutupan_m','rel_penutupan_m','rel_premi_rate_m'));
        
        
        
        /** PHPExcel root directory */
        if (!defined('PHPEXCEL_ROOT')) {
            define('PHPEXCEL_ROOT', APPPATH . 'libraries/');
            require(PHPEXCEL_ROOT . 'PHPExcel/Autoloader.php');
        }
        
        $return = new stdClass();
        $return->status = FALSE;
        $return->error = '';
        $return->filepath = $excel_file;
        
        try {
            $inputFileType = PHPExcel_IOFactory::identify($excel_file);
            $objReader = PHPExcel_IOFactory::createReader($inputFileType);
            $objPHPExcel = $objReader->load($excel_file);
        } catch(Exception $e) {
            $return->error = $e->getMessage();
            return $return;
        }
        
        //  Get worksheet dimensions
        $sheet = $objPHPExcel->getSheet(0); 
        $startCol = 'A';
        $highestColumn = 'AV'; //change this 
        $startRow = $start_row;
        $highestRow = $sheet->getHighestRow(); //4016; //
        
        $colRef = array(
            'no'=>0,'nama'=>1,'tgl_lahir'=>2,'nip'=>3, 'ktp'=>4, 'alamat'=>5, 'pendapatan'=>6,
            'kredit'=>7, 'mulai'=>8, 'akhir'=>9
        );
        $return->batch_id = $batchID;
        $return->start_row = $startRow;
        $return->row_num = $highestRow;
        
        $total_data = 0;
        $total_plafond = 0;
        $total_premi = 0;
        $total_komisi = 0;
        
        //  Loop through each row of the worksheet in turn
        for ($rowNum = $startRow; $rowNum <= $highestRow; $rowNum++){ 
            //  Read a row of data into an array
            $rowData = $sheet->rangeToArray($startCol . $rowNum . ':' . $highestColumn . $rowNum, NULL, TRUE, TRUE);
            
            //calculate premi rate
            $start_date = $this->_convert_date_2_mysql($rowData[0][$colRef['mulai']]);
            $end_date = $this->_convert_date_2_mysql($rowData[0][$colRef['akhir']]);
            $tenor = tenor_calc($start_date, $end_date);
            $premi_rate_row = $this->rel_premi_rate_m->get_by(array('tenor'=>$tenor), TRUE);
            if ($premi_rate_row){
                $premi_rate = $premi_rate_row->rate;
            }else{
                $premi_rate = 0;
            }
            
            //start manipulate data row
            $data_update = array(
                'batch'             => $batchID,
                'nama_peserta'      => $rowData[0][$colRef['nama']],
                'tanggal_lahir'     => $this->_convert_date_2_mysql($rowData[0][$colRef['tgl_lahir']]),
                'nip_peserta'       => $rowData[0][$colRef['nip']],
                'no_ktp'            => $rowData[0][$colRef['ktp']],
                'alamat'            => $rowData[0][$colRef['alamat']],
                'pendapatan_bulanan'=> $rowData[0][$colRef['pendapatan']],
                'plafon_kredit'     => $rowData[0][$colRef['kredit']],
                'waktu_mulai'       => $start_date,
                'waktu_akhir'       => $end_date,
                'tenor'             => $tenor,
                'rate_premi'        => $premi_rate,
                'nilai_premi'       => $premi_rate * $rowData[0][$colRef['kredit']],
                'inserted'          => time()
            );
			
            
            //Insert data into database
            $this->rel_penutupan_m->save($data_update);
            
            $total_plafond+=$rowData[0][$colRef['kredit']];
            $total_premi+=$premi_rate * $rowData[0][$colRef['kredit']];
            $total_data++;
        }
        
        $return->total_data = $total_data;
        
        //update table batch penutupan
        $this->rel_batch_penutupan_m->save(array(
            'jumlah_data'       => $total_data,
            'tsi_penutupan'     => $total_plafond,
            'premi_penutupan'   => $total_premi,
            'komisi_penutupan'  => 1
        ), $batchID);
        
        $return->status = TRUE;
        return $return;
    }
    
    private function _convert_date_2_mysql($date){
        $arr = explode('/', $date);
        
        return $arr[2].'-'.$arr[0].'-'.$arr[1];
    }
    
    public function detail_get($id){
        $this->load->model(array('rel_penutupan_m'));
        $result = array('status'=>FALSE);
        
        $item = $this->rel_penutupan_m->get($id);
        if ($item){
            $result['status'] = TRUE;
            $result['item'] = $item;
        }else{
            $result['message'] = 'Data penutupan dengan ID:'.$id.' tidak ditemukan';
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
    
    public function details_delete(){
        $this->load->model(array('rel_penutupan_m','rel_batch_penutupan_m','rel_history_m'));
        $result = array('status'=>FALSE);
        
        $ids = $this->delete('itemIds');
        
        $success = 0;
        $failed = 0;
        
        $batchID = 0;
        
        foreach ($ids as $id){
            //get the batch
            $item = $this->rel_penutupan_m->get($id);
            if ($item->status == BATCH_ITEM_UPLOADED && $this->rel_penutupan_m->delete($id)){
                $success++;

                //update action history
                $this->rel_history_m->save(array(
                    'act_date'              => date('Y-m-d H:i:s'),
                    'batch'                 => $item->batch,
                    'item'                  => $id,
                    'action'                => 'Hapus detail data penutupan asuransi itemId:'.$id
                ));
                
                $batchID = $item->batch;
            }else{
                $failed++;
            }
            
        }
        
        if ($success>0){
            $calculate = $this->rel_penutupan_m->calculate_sum($batchID);

            //update table batch penutupan
            $this->rel_batch_penutupan_m->save(array(
                'tsi_penutupan'     => $calculate->plafon_kredit,
                'premi_penutupan'   => $calculate->nilai_premi
            ), $batchID);
        }
        
        $result['status'] = TRUE;
        $result['deleted'] = $success;
        $result['failed'] = $failed;
        
        $this->response($result);
    }
    
    public function all_get(){
        $this->load->model(array('rel_penutupan_m'));
        
        $draw = $this->get('draw');
        $length = $this->get('length');
        $start = $this->get('start');
        $order_arr = $this->get('order');
        $columns_arr = $this->get('columns');
        $search = $this->get('search') ? $this->get('search') : NULL;
        $batch_id = $this->get('batch_id') ? $this->get('batch_id') : 0;
        
        //get order by and direction from the order & columns array
        $order_by = $columns_arr[$order_arr[0]['column']]['data'];
        $order_dir = $order_arr[0]['dir']; 
        
        $where = NULL;
        
        if ($batch_id){
            $where = array('batch'=>$batch_id);
        }
        $totalRecords = $this->rel_penutupan_m->get_count($where);
        
        //set filtered if any
        if ($search && $search['value']){
            $this->db->like('nama_peserta', $search['value']);
            $this->db->or_like('nip_peserta', $search['value']);
            $this->db->or_like('no_ktp', $search['value']);
        }
        //get filtered count
        $totalFiltered = $this->rel_penutupan_m->get_count($where);
        
        $result = array('draw' => $draw, 'start'=>$start, 'recordsTotal'=>$totalRecords, 'recordsFiltered'=>$totalFiltered, 'items'=>array());

        if ($totalRecords > 0){
            
            //set filtered if any
            if ($search && $search['value']){
                $this->db->like('nama_peserta', $search['value']);
                $this->db->or_like('nip_peserta', $search['value']);
                $this->db->or_like('no_ktp', $search['value']);
            }
            //apply offset and limit of data
            $this->db->order_by($order_by,$order_dir);
            $this->db->offset($start)->limit($length);
            
            $query_result = $this->rel_penutupan_m->get_by($where);
            if ($query_result){
                foreach ($query_result as $item){
                    $result['items'][] = $item;
                }
            }
        }
        $this->response($result);
    }
	
	public function batch_forward_post(){
        $this->load->model(array('rel_batch_penutupan_m','rel_penutupan_m','rel_history_m'));
        $result = array('status'=>FALSE);
        
        $batch_id = $this->post('id');
        //get the batch
        $batch = $this->rel_batch_penutupan_m->get($batch_id);
        if ($batch && $batch->status == BATCH_CONFIRMED){
            //get data penutupan
            $penutupans = $this->rel_penutupan_m->get_by(array('batch'=>$batch_id));
            $confirmed = 0;
            foreach ($penutupans as $item){
                if ($item->status == BATCH_UPLOADED){
                    $this->rel_penutupan_m->save(array('status'=>BATCH_ITEM_FORWARD), $item->id);
                    $confirmed++;
                }
            }
            
            $this->rel_batch_penutupan_m->save(array('status'=>BATCH_ITEM_FORWARD), $batch_id);
            
            $result['status'] = TRUE;
            $result['confirmed'] = $confirmed;
            
            //update action history
            $this->rel_history_m->save(array(
                'act_date'              => date('Y-m-d H:i:s'),
                'batch'                 => $batch_id,
                'item'                  => 0,
                'action'                => 'forward data penutupan asuransi'
            ));
        }
        
        $this->response($result);
    }
	
	public function batch_status_post($status, $des = 'update'){
        $this->load->model(array('rel_batch_penutupan_m','rel_penutupan_m','rel_history_m'));
        $result = array('status'=>FALSE);
        
        $batch_id = $this->post('id');
        //get the batch
        $batch = $this->rel_batch_penutupan_m->get($batch_id);
        if ($batch && $batch->status != $status){
            //get data penutupan
            $penutupans = $this->rel_penutupan_m->get_by(array('batch'=>$batch_id));
            $confirmed = 0;
            foreach ($penutupans as $item){
                if ($item->status == BATCH_UPLOADED){
                    $this->rel_penutupan_m->save(array('status'=>$status), $item->id);
                    $confirmed++;
                }
            }
            
            $this->rel_batch_penutupan_m->save(array('status'=>$status), $batch_id);
            
            $result['status'] = TRUE;
            $result['confirmed'] = $confirmed;
            
            //update action history
            $this->rel_history_m->save(array(
                'act_date'              => date('Y-m-d H:i:s'),
                'batch'                 => $batch_id,
                'item'                  => 0,
                'action'                => $des.' data penutupan asuransi'
            ));
        }
        
        $this->response($result);
    }
	
	public function batches_asuradur_get(){
        $this->load->model(array('rel_batch_penutupan_m','auth_user_m'));
        
        $draw = $this->get('draw');
        $length = $this->get('length');
        $start = $this->get('start');
        $order_arr = $this->get('order');
        $columns_arr = $this->get('columns');
        $search = $this->get('search') ? $this->get('search') : NULL;
		$where = "status in (2,3,4)";
        
        //get order by and direction from the order & columns array
        $order_by = $columns_arr[$order_arr[0]['column']]['data'];
        $order_dir = $order_arr[0]['dir']; 
        
        $totalRecords = $this->rel_batch_penutupan_m->get_count($where);
        
        //set filtered if any
        if ($search && $search['value']){
            $this->db->like('tanggal_upload', $search['value']);
        }
        //get filtered count
        $totalFiltered = $this->rel_batch_penutupan_m->get_count($where);
        
        $result = array('draw' => $draw, 'start'=>$start, 'recordsTotal'=>$totalRecords, 'recordsFiltered'=>$totalFiltered, 'items'=>array());

        if ($totalRecords > 0){
            
            //set filtered if any
            if ($search && $search['value']){
                $this->db->like('rel_batch_penutupan_m', $search['value']);
            }
            //apply offset and limit of data
            $this->db->order_by($order_by,$order_dir);
            $this->db->offset($start)->limit($length);
            
            $query_result = $this->rel_batch_penutupan_m->get_by($where);
            if ($query_result){
                foreach ($query_result as $item){
                    $item->user_upload = $this->auth_user_m->get($item->user_upload);
                    $result['items'][] = $item;
                }
            }
        }
        $this->response($result);
    }
}

/**
 * Filename : Penutupan.php
 * Location : application/controllers/services/Penutupan.php
 */
