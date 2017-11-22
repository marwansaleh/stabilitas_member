<?php

/* 
 * File Name : Comment
 * Created On : Aug 3, 2017 11:00:02 PM
 * Author @garaulo (fauziansyah26@gmail.com)
 * Description : 
 */

class Comment extends REST_Api{
    
    function __construct($config = 'rest') {
        parent::__construct($config);
        
        $this->load->model('rel_comments_m');
    }
    
    public function index_post(){
        $save = array(
            'agenda_id' => $this->post('agenda_id'),
            'comment'   => $this->post('comment'),
            'created_by'=> $this->me
        );
        
        $id = $this->rel_comments_m->save($save);
        if($id){
            $this->return['status'] = TRUE;
        }
        
        $this->response($this->return);
    }
    
    public function agenda_get($id){
        $this->db->where('agenda_id', $id);
        $this->return['items'] = $this->rel_comments_m->get();
        
        if($this->return['items']){
            $this->return['items'] = $this->_modify_fields($this->return['items']);
            $this->return['status'] = TRUE;
        }
        
        $this->response($this->return);
    }
    
    private function _modify_fields($items){
        foreach($items as $item):
            $item->imgurl = $this->userService->get_user($item->created_by)->avatar;
            $item->name = $this->userService->get_user($item->created_by)->nama;
            $item->timestamp = date('d/m/Y H:i:s', $item->date_receive);
        endforeach;
        
        return $items;
    }
}
