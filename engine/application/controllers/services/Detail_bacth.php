<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of Detail_bacth
 *
 * @author ekiindra 1:31:58 PM
 */
class Detail_bacth extends REST_Api {
    
    function __construct($config = 'rest') {
        parent::__construct($config);
        
    }
    
    public function get_get($id){
        $this->load->model(array('rel_penutupan_m'));
        $result = array('status'=>FALSE);
        
        $item = $this->rel_penutupan_m->get($id);
        if ($item){
            $result['status'] = TRUE;
            $result['item'] = $item;
        }else{
            $result['message'] = 'Data user dengan ID:'.$id.' tidak ditemukan';
        }
        $this->response($result);
    }
    
	
	public function polis_post(){
        $this->load->model(array('rel_penutupan_m'));
        $result = array('status'=>FALSE, 'message'=>'');
        
        $id = $this->post('id');
        $no_polis = $this->post('no_polis');
        $file = $this->post('file');
        
        $continue = TRUE;
		
		$upload_path = sys_get_temp_dir();
        
        $config['upload_path'] = $upload_path;
        $config['allowed_types'] = 'doc|docx|xls|xlsx';
        $config['max_size'] = 10000;

        $this->load->library('upload', $config);
		if (!$this->upload->do_upload('file')) {
            $result['error'] = $this->upload->display_errors();
        } else {
            $upload = $this->upload->data();
        
			$data_update = array(
				'no_polis'      => $no_polis,
				'file_polis'    => $upload['full_path']
			);
			
			if (!$id){
				$result['message'] = 'Same data already exists';
				$continue = FALSE;
			}else{
				
					$data_update = array_merge($data_update);

			}
			
			//if everything is ok, try to update
			if ($continue){
				if ($this->rel_penutupan_m->save($data_update, $id)){
					$result['status'] = TRUE;
				}else{
					$result['message'] = $this->rel_penutupan_m->get_last_message();
				}
			}
			
			$this->response($result);
		}
    }
	
	public function pembayaran_get($id){
        $this->load->model(array('rel_batch_penutupan_m'));
        $result = array('status'=>FALSE);
        
        $item = $this->rel_batch_penutupan_m->get($id);
        if ($item){
            $result['status'] = TRUE;
            $result['item'] = $item;
        }else{
            $result['message'] = 'Data Batch dengan ID:'.$id.' tidak ditemukan';
        }
        $this->response($result);
    }
	
	public function pembayaran_premi_post(){
        $this->load->model(array('rel_batch_penutupan_m'));
        $result = array('status'=>FALSE, 'message'=>'');
        
        $id = $this->post('id');
        $file = $this->post('file');
        
        $continue = TRUE;
		
		$upload_path = sys_get_temp_dir();
        
        $config['upload_path'] = $upload_path;
        $config['allowed_types'] = 'doc|docx|xls|xlsx';
        $config['max_size'] = 10000;

        $this->load->library('upload', $config);
		if (!$this->upload->do_upload('file')) {
            $result['error'] = $this->upload->display_errors();
        } else {
            $upload = $this->upload->data();
        
			$data_update = array(
				'pembayaran_premi'  => 'Dibayar',
				'bukti_pembayaran'    => $upload['full_path']
			);
			
			if (!$id){
				$result['message'] = 'Same data already exists';
				$continue = FALSE;
			}else{
				
					$data_update = array_merge($data_update);

			}
			
			//if everything is ok, try to update
			if ($continue){
				if ($this->rel_batch_penutupan_m->save($data_update, $id)){
					$result['status'] = TRUE;
				}else{
					$result['message'] = $this->rel_batch_penutupan_m->get_last_message();
				}
			}
			
			$this->response($result);
		}
    }
}

/**
 * Filename : User.php
 * Location : application/controllers/services/User.php
 */
