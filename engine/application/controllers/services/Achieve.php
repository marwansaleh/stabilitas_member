<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*
 * File Name : Achieve
 * Created On : Aug 21, 2017 8:10:42 AM
 * @author garaulo (fauziansyah26@gmail.com)
 * Description : 
 */

class Achieve extends REST_Api{
    
    function __construct($config = 'rest') {
        parent::__construct($config);
        
        $this->load->model(array('rel_achieved_m','ref_target_m','ref_rekap_m'));
    }
    
    public function index_get($rekap = NULL){
        $this->load->model(array('ref_client_m'));
        
        $this->db->where('rekap',$rekap);
        $items = $this->rel_achieved_m->get();
        
        if($items){
            
            // modify field
            foreach($items as $item){
                $item->nominal = number_format($item->nominal,2);
                
                // get client name
                $item->client_name = $this->ref_client_m->get($item->client)->fullname;
                
                // get tipe of ach
                if($item->tipe===TYPE_RENEW_ID){
                    $item->tipe_name = TYPE_RENEW_NAME;
                }else{
                    $item->tipe_name = TYPE_NEW_NAME;
                }
            }
            
            $return['status'] = TRUE;
            $return['items'] = $items;
        }else{
            $return['message'] = 'Error when grab data';
        }
        
        $this->response($return);
    }
    
    public function index_post(){
        
        $rekap = $this->post('rekap');
        $no_polis = $this->post('no_polis');
        $tipe = $this->post('tipe');
        $nominal = $this->post('nominal');
        $client = $this->post('client');
        
        $save = $this->rel_achieved_m->save(array(
            'rekap' => $rekap,
            'no_polis' => $no_polis,
            'tipe' => $tipe,
            'client' => $this->post('client'),
            'nominal' => $nominal,
            'created_by' => $this->me
        ));
        
        $rekap = $this->ref_rekap_m->get($rekap);
        
        if($save){
            $ach = 'achievement_renew';
            
            if($tipe === 'new') $ach = 'achievement_new';
            
            if($this->ref_rekap_m->save(array(
                $ach => $nominal + $rekap->$ach
            ),$rekap->id)){
                $return['status'] = TRUE;
            }else{
                $return['message'] = 'Error when updating target data!';
            }
        }else{
            $return['message'] = $this->rel_achieved_m->last_message();
        }
        
        $this->response($return);
    }
    
    public function index_delete($id){
        $achievement_detail = $this->rel_achieved_m->get($id);
        
        $rekap = $this->ref_rekap_m->get($achievement_detail->rekap);
        
        $delete = $this->rel_achieved_m->delete($id);
        
        
        
        if($delete){
            if($this->ref_rekap_m->save(array(
                'achievement' => $rekap->achievement - $achievement_detail->nominal
            ), $achievement_detail->rekap)){
                $return['status'] = TRUE;
            }else{
                $return['message'] = 'Error when updating target data';
            }
        }else{
            $return['message'] = $this->rel_achieved_m->last_message();
        }
        
        $this->response($return);
    }
}

/*
 * file name: Achieve.php
 */
