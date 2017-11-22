<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class MY_Controller inherit from CI_Controller 
 * which will be the base controller for all controllers used
 * in this application
 *
 * @author marwansaleh 5:42:25 PM
 */
class MY_Controller extends CI_Controller {
    public $data = array();
    protected $userlib = NULL;
    
    function __construct() {
        parent::__construct();
        
        if (!isset($this->session)){
            $this->load->library('session') or die('Ca not load library Session');
        }
        
        $this->userlib = Userlib::getInstance();
        
    }
    
    protected function log_file($event){
        $log_path = config_item('log_path');
        if (!$log_path){
            $log_path = sys_get_temp_dir();
        }
        $log_file = config_item('log_file');
        if (!$log_file){
            $log_file = rtrim($log_path, '/') .'/log_file.log';
        }else{
            $log_file = rtrim($log_path, '/') .'/' . $log_file;
        }
        
        $content = array(
            date('Y-m-d H:i:s'), 
            $this->input->ip_address(),
            $event
        );
        
        if ($fp = @fopen($log_file, 'a')){
            fputcsv($fp, $content, "\t");
            fclose($fp);
        }
    }
    
    protected function log_file_read($log_file, $lines=5, $adaptive=TRUE){
        // Open file
        $filepath = $log_file;
        
        $f = @fopen($filepath, "rb");
        if ($f === false) return false;
        
        // Sets buffer size
        if (!$adaptive) $buffer = 4096;
        else $buffer = ($lines < 2 ? 64 : ($lines < 10 ? 512 : 4096));

        // Jump to last character
        fseek($f, -1, SEEK_END);

        // Read it and adjust line number if necessary
        // (Otherwise the result would be wrong if file doesn't end with a blank line)
        if (fread($f, 1) != "\n") $lines -= 1;
        // Start reading
        $output = '';
        $chunk = '';

        // While we would like more
        while (ftell($f) > 0 && $lines >= 0) {

            // Figure out how far back we should jump
            $seek = min(ftell($f), $buffer);

            // Do the jump (backwards, relative to where we are)
            fseek($f, -$seek, SEEK_CUR);

            // Read a chunk and prepend it to our output
            $output = ($chunk = fread($f, $seek)) . $output;

            // Jump back to where we started reading
            fseek($f, -mb_strlen($chunk, '8bit'), SEEK_CUR);

            // Decrease our line counter
            $lines -= substr_count($chunk, "\n");

        }

        // While we have too many lines
        // (Because of buffer size we might have read too many)
        while ($lines++ < 0) {
            
            // Find first newline and remove all text before that
            $output = substr($output, strpos($output, "\n") + 1);

        }

        // Close file and return
        fclose($f);
        return trim($output);
    }
    
    private function _get_mime($ext){
        $mime = array(
            'jpg'       => 'image/jpeg',
            'gif'	=>  'image/gif',
            'png'       => 'image/png',
            'pdf'       => 'application/pdf',
            'xls'       => 'application/vnd.ms-excel',
            'xlsx'      => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            'doc'       => 'application/msword',
            'docx'      => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'
        );
        
        if (is_array($ext)){
            $result = array();
            foreach ($ext as $x){
                if (isset($mime[$x])){
                    $result[$x] = $mime[$x];
                }
            }
            
            return $result;
        }else if (isset($mime[$ext])){
            return $mime[$ext];
        }
        
        return FALSE;
    }
    
}

class Admin_Controller extends MY_Controller {
    private static $_menu_level_deep = 0;
    private static $_menu_level_base_parent = 0;
    
    function __construct() {
        parent::__construct();
        
        if (!$this->userlib->isLoggedin()){
            $referrer = set_url_back(uri_string());
            redirect(get_action_url('auth/index/' . $referrer));
            exit;
        }
        
        $class_name = $this->router->fetch_class();
        $role_id_by_url = NULL;
        if ($class_name != 'error'){
            $role_id_by_url = $this->get_roleid_by_url();
            if ($role_id_by_url && !$this->has_menu_access($role_id_by_url->id)){
                redirect('error/unauthorize');
            }
        }
        
        //load neccessary models
        $this->load->model(array('auth_user_m','mainmenu_m'));
        //store user loggedin detail
        $this->data['me'] = $this->userlib->me();
        //load helper
        $this->load->library('form_validation');
        //set default active module
        //$this->data['module_active'] = $this->get_active_module_by_url();
        $this->data['class_active'] = $this->get_active_class_by_url();
        $this->data['active_menu'] = $role_id_by_url;
        //init breadcumb
        $this->data['breadcumb'] = array();
        //set mainmenu
        $this->data['mainmenus'] = $this->get_user_menu();
        //echo json_encode($this->data['mainmenus']);exit;
        //$bulan_laporan_active = $this->get_bulan_laporan();
        //$this->data['laporan'] = $bulan_laporan_active;
        //$this->data['currency_rates'] = $this->get_currency_rate_js($bulan_laporan_active->id);
    }
    
    protected function get_active_module_by_url(){
        $url_array = explode('/', uri_string());
        
        //find modul id from url array
        if (isset($url_array[0])){
            return $url_array[0];
        }
        return module_name(CT_MODULE_OTHER);
    }
    
    protected function get_active_class_by_url(){
        
        $url_array = explode('/', uri_string());
        
        //find class from url array
        if (count($url_array)>1){
            return $url_array[1];
        }else{
            return $url_array[0];
        }
        return '';
    }
    
    protected function get_roleid_by_url(){
        if (!isset($this->mainmenu_m)){
            $this->load->model('mainmenu_m');
        }
        
        $string_link = '';
        if ($this->router->directory){
            $string_link = $this->router->directory;
        }
        $string_link .= $this->router->class;
        if ($this->router->method!='index'){
            $string_link.='/'.$this->router->method;
        }
        //echo 'direktori:'.$this->router->directory .' class:'.$this->router->class.' method:'.$this->router->method.'<br>';
        $this->db->where('link',$string_link);
        $menuitem = $this->mainmenu_m->get_select_where('id,parent,link',NULL,TRUE);
        if ($menuitem){
            return $menuitem;
        }else{
            $menuitem = new stdClass();
            $menuitem->id = 1;
            $menuitem->parent = 0;
            $menuitem->link = '#';
            return $menuitem;
        }
    }
    
    protected function has_menu_access($role_menu_id=NULL){
        $all_granted = $this->userlib->get_menu_granted();
        if ($role_menu_id === NULL){
            return $all_granted;
        }
        return in_array($role_menu_id,$all_granted);
    }
    
    protected function get_user_menu(){
        
        $result = $this->userlib->get_user_menu();
        //echo json_encode($result);exit;
        if ($result){
            $menu_array = array('parents' => array(),'items' => array());
            foreach ($result as $menu_item){
                if (!$menu_item->granted){
                    continue;
                }
                $menu_array['parents'][$menu_item->parent][] = $menu_item->id;
                $menu_array['items'][$menu_item->id] = $menu_item;
            }
            
            return $this->_hierarchy_menus($menu_array); //start level deep from 0
        }else{
            return NULL;
        }
    }
    
    protected function get_menu($parent=0,$deep=TRUE, $level_deep=0){
        
        $result = $this->mainmenu_m->get_all($parent, $deep);
        if ($result){
            $menu_array = array('parents' => array(),'items' => array());
            foreach ($result as $menu_item){
                //remove un-accesible menu based on user privilege
                if (!$this->userlib->has_access($menu_item->id)){
                    continue;
                }
                $menu_array['parents'][$menu_item->parent][] = $menu_item->id;
                $menu_array['items'][$menu_item->id] = $menu_item;
            }
            
            //set maximum level deep if set more than 0
            if ($level_deep>0){
                self::$_menu_level_deep = $level_deep;
                self::$_menu_level_base_parent = $parent;
            }
            return $this->_hierarchy_menus($menu_array, $parent, 1); //start level deep from 0
        }else{
            return NULL;
        }
    }
    
    private function _hierarchy_menus($menus, $parent=0, $level_deep=0){
        $menulist = array();
        if (isset($menus['parents'][$parent])){
            
            //get menu item for each id where parent = $parent
            foreach ($menus['parents'][$parent] as $menu_id){
                $menuitem = $menus['items'][$menu_id];
                //jika parent sama dengan base, kembalikan level ke 0
                if (self::$_menu_level_deep > 0 && $menuitem->parent == self::$_menu_level_base_parent){
                    $level_deep = 1;
                }
                //apakah sudah sampai pada level yang diinginkan
                if (self::$_menu_level_deep > 0 && $level_deep >= self::$_menu_level_deep){
                    //echo 'level:'.$level_deep.' counter:'.self::$menu_level_deep;exit;
                    $menuitem->children = NULL;
                }else{
                    //does menu has submenu ?
                    if (isset($menus['parents'][$menuitem->id])){
                        $menuitem->children = $this->_hierarchy_menus($menus, $menuitem->id, ($level_deep+1));
                    }
                }
                $menuitem->text = $menuitem->caption;
                
                
                $menulist[] = $menuitem;
            }
        }
        
        return $menulist;
    }
}

/**
 * Filename : MY_Controller.php
 * Location : applications/core/MY_Controller.php
 */
