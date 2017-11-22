<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of Person
 *
 * @author marwansaleh 1:31:58 PM
 */
class Person extends REST_Api {
    
    function __construct($config = 'rest') {
        parent::__construct($config);
    }
    
    public function get_get($id){
        $this->load->model(array('rel_person_m'));
        $result = array('status'=>FALSE);
        
        $item = $this->rel_person_m->get($id);
        if ($item){
            $result['status'] = TRUE;
            $result['item'] = $item;
        }else{
            $result['message'] = 'Tidak ada data visited PIC dengan ID:'.$id;
        }
        $this->response($result);
    }
    
    public function agenda_get($agenda_id){
        $this->load->model(array('rel_person_m','rel_pic_m'));
        $result = array('status'=>FALSE);
        
        $items = $this->rel_person_m->get_by(array('agenda'=>$agenda_id));
        if ($items){
            $result['status'] = TRUE;
            $result['items'] = array();
            foreach ($items as $item){
                $item->person = $this->rel_pic_m->get($item->person);
                $result['items'][] = $item;
            }
            
        }else{
            $result['message'] = 'Tidak ada data visited PIC dengan ID:'.$agenda_id;
        }
        $this->response($result);
    }
    
    public function save_post(){
        $this->load->model(array('rel_person_m','rel_pic_m'));
        $result = array('status'=>FALSE);
        
        $agenda = $this->post('agenda_id');
        $client = $this->post('client_id');
        $fullname = $this->post('fullname');
        $position = $this->post('position');
        $phone = $this->post('phone');
        
        $pic_id = NULL;
        
        $pic_visited = $this->rel_pic_m->get_by(array('client'=>$client, 'fullname'=>$fullname), TRUE);
        if ($pic_visited){
            $pic_id = $pic_visited->id;
            
            //update data pic
            $this->rel_pic_m->save(array(
                'position'      => $position,
                'phone'         => $phone
            ), $pic_id);
        }else{
            $pic_id = $this->rel_pic_m->save(array(
                'client'        => $client,
                'fullname'      => $fullname,
                'position'      => $position,
                'phone'         => $phone
            ));
        }
        
        //update visited pic
        if (!$this->rel_person_m->get_count(array('agenda'=>$agenda,'person'=>$pic_id))){
            $pic_visited_id = $this->rel_person_m->save(array(
                'agenda'        => $agenda,
                'client'        => $client,
                'person'        => $pic_id
            ));
            
            $result['status'] = TRUE;
            $result['item'] = $this->rel_person_m->get($pic_visited_id);
        }else{
            $result['message'] = 'PIC yang sama sudah ada di daftar orang yang ditemui';
        }
        
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
            $result['message'] = 'Gagal menghapus data visited PIC dengan ID:'.$id;
        }
        $this->response($result);
    }
}

/**
 * Filename : Person.php
 * Location : application/controllers/services/Person.php
 */
