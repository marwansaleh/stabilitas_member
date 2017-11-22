<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of Mainmenu
 *
 * @author marwansaleh 1:31:58 PM
 */
class Mainmenu extends REST_Api {
    
    function __construct($config = 'rest') {
        parent::__construct($config);
    }
    
    public function captions_get(){
        $this->load->model(array('mainmenu_m'));
        
        $search = $this->get('search');
        
        $this->db->select('id,caption')->like('caption',$search);
        $captions = $this->mainmenu_m->get();
        $this->response($captions);
    }
    
    public function select2_get(){
        $this->load->model(array('mainmenu_m'));
        
        $q = $this->get('q') ? $this->get('q') : '';
        $page = $this->get('page') ? $this->get('page') : 1;
        $length = 15;

        $start = ($page-1) * $length;

        //apply offset and limit of data
        $this->db->like('caption',$q);
        $query_result = $this->mainmenu_m->get_offset('id,caption',NULL,$start,$length);

        $items = array();
        if ($query_result){
            $count = count($query_result);

            foreach ($query_result as $item){
                $item->text = $item->caption;
                $items[] = $item;
            }
        }else{
            $count = 0;
        }

        $endCount = $start + $length;
        $morePages = $endCount > $count;

        $result = array(
            'results' => $items,
            'pagination' => array(
                'more' => $morePages
            )
        );

        $this->response($result);
    }
    
    public function get_get($id){
        $this->load->model(array('mainmenu_m'));
        $result = array('status'=>FALSE, 'message'=>'No data');
        
        $menu_item = $this->mainmenu_m->get($id);
        if ($menu_item){
            $menu_item->text = $menu_item->caption;
            $menu_item->has_children = $this->mainmenu_m->get_count(array('parent'=>$id)) > 0;
            
            $result['item'] = $menu_item;
            $result['status'] = TRUE;
        }
        $this->response($result);
    }
    
    public function lazy_get(){
        $this->load->model('mainmenu_m');
        $result = array();
        
        $parent_id = $this->get('parent') ? (int)$this->get('parent') : 0;
        $menus = $this->mainmenu_m->get_select_where('id,caption AS text,icon',array('parent'=>$parent_id));
        foreach ($menus as $menu){
            if ($this->mainmenu_m->get_count(array('parent'=>$menu->id))){
                $menu->children = TRUE;
                $menu->state = array('opened'=>TRUE);
            }else{
                $menu->children = FALSE;
            }
            if ($menu->icon){
                $menu->icon = 'fa '. $menu->icon;
            }else if (!$menu->children){
                $menu->icon = 'fa fa-file-text-o';
            }else{
                unset($menu->icon);
            }
            $result [] = $menu;
        }
        if (!$parent_id){
            $this->response(array('id'=>0,'text'=>'ROOT MAINMENU','state'=>array('opened'=>TRUE), 'children'=>$result));
        }else{
            $this->response($result);
        }
    }
    
    public function move_post(){
        $this->load->model('mainmenu_m');
        $result = array('status'=>FALSE);
        
        $item_id = $this->post('id');
        $parent_id = $this->post('parent');
        $position = $this->post('position');
        
        if ($item_id && !is_null($parent_id)){
            if ($this->mainmenu_m->save(array('parent'=>$parent_id, 'sort'=>$position), $item_id)){
                $result['status'] = TRUE;
            }else{
                $result['message'] = 'Failed while moving menu item to new position';
            }
        }else{
            $result['message'] = 'Parent is not defined';
        }
        
        $this->response($result);
    }
    
    public function save_post(){
        $this->load->model(array('mainmenu_m'));
        $result = array('status'=>FALSE);
        
        $id = $this->post('id');
        $caption = $this->post('caption');
        $parent = $this->post('parent');
        $title = $this->post('title');
        $link = $this->post('link');
        $icon = $this->post('icon');
        $sort = $this->post('sort');
        $hidden = $this->post('hidden');
        
        $id = $this->mainmenu_m->save(array(
            'caption'           => $caption,
            'parent'            => $parent,
            'title'             => $title,
            'link'              => $link,
            'icon'              => $icon,
            'sort'              => $sort,
            'hidden'            => $hidden
        ), $id);
        if ($id){
            $result['status'] = TRUE;
            $result['item'] = $this->mainmenu_m->get($id);
        }else{
            $result['message'] = $this->mainmenu_m->get_last_message();
        }
        
        $this->response($result);
    }
    
    public function delete_delete($itemId){
        $this->load->model(array('mainmenu_m'));
        $result = array('status'=>FALSE);
        
        $item = $this->mainmenu_m->get($itemId);
        if ($item && $this->mainmenu_m->delete($itemId)){
            $result['status'] = TRUE;
            $result['item'] = $item;
        }else{
            $result['message'] = $this->mainmenu_m->get_last_message();
        }
        
        $this->response($result);
    }
}

/**
 * Filename : Mainmenu.php
 * Location : application/controllers/services/Mainmenu.php
 */
