<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Class of UserService
 *
 * @author marwansaleh 11:13:40 PM
 */
class UserService extends Library {
    private $_service_url;
    private $_temp_path = 'tmp/';
    
    function __construct() {
        parent::__construct();
        
        
        $this->_service_url = $this->ci->config->item('service_auth_url');
        
        //ensure temporary path exists to save temp files
        if (!file_exists($this->_temp_path)){
            mkdir($this->_temp_path);
        }
    }
    
    public function user_refresh(){
        $temp_name = $this->_temp_path . 'user_services.json';
        
        if (file_exists($temp_name)){
            unlink($temp_name);
        }
        
        $user_service = $this->_get_users_service();
        if ($user_service){
            file_put_contents($temp_name, json_encode($user_service));
            
            return TRUE;
        }else{
            return FALSE;
        }
    }
    
    public function get_user($userid){
        $users = $this->get_users(TRUE);
        
        if (isset($users[$userid])){
            return $users[$userid];
        }else{
            return NULL;
        }
    }
    
    public function get_users($array=FALSE){
        $temp_name = $this->_temp_path . 'user_services.json';
        
        $users = NULL;
        if (file_exists($temp_name)){
            $users = json_decode(file_get_contents($temp_name));
        }else{
            $user_service = $this->_get_users_service();
            if ($user_service){
                file_put_contents($temp_name, json_encode($user_service));
                
                $users = $user_service;
            }
        }
        
        
        if ($users){
            if ($array){
                $result = array();
                foreach ($users as $item){
                    $result[$item->id] = $item;
                }

                return $result;
            }
        }
        
        return $users;
    }
    
    protected function _get_users_service($simple=0){
        $service_url = $this->_service_url . 'user/all/'.$simple;
        
        $ch = curl_init(); 
        // set url 
        curl_setopt($ch, CURLOPT_URL, $service_url); 

        curl_setopt($ch,CURLOPT_POST,FALSE); 
        //return the transfer as a string 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 

        // $output contains the output string 
        $output = curl_exec($ch); 
        if (curl_errno($ch)){
            return FALSE;
        }else{
            //echo $output; exit;
            $output = json_decode($output);
        }
        // close curl resource to free up system resources 
        curl_close($ch);  
        
        return $output->items;
    }
    
    public function bidang_refresh(){
        $temp_name = $this->_temp_path . 'bidang_services.json';
        
        if (file_exists($temp_name)){
            unlink($temp_name);
        }
        
        $service = $this->_get_bidang_service();
        if ($service){
            file_put_contents($temp_name, json_encode($service));
            
            return TRUE;
        }else{
            return FALSE;
        }
    }
    
    public function get_bidang($array=FALSE){
        $temp_name = $this->_temp_path . 'bidang_services.json';
        
        $items = NULL;
        if (file_exists($temp_name)){
            $items = json_decode(file_get_contents($temp_name));
        }else{
            $service = $this->_get_bidang_service();
            if ($service){
                file_put_contents($temp_name, json_encode($service));
                
                $items = $service;
            }
        }
        
        
        if ($items){
            if ($array){
                $result = array();
                foreach ($items as $item){
                    $result[$item->id] = $item;
                }
                
                return $result;
            }
            
            
        }
        
        return $items;
    }
    
    protected function _get_bidang_service(){
        $service_url = $this->_service_url . 'bidang/all';
        
        $ch = curl_init(); 
        // set url 
        curl_setopt($ch, CURLOPT_URL, $service_url); 

        curl_setopt($ch,CURLOPT_POST,FALSE); 
        //return the transfer as a string 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 

        // $output contains the output string 
        $output = curl_exec($ch); 
        if (curl_errno($ch)){
            return FALSE;
        }else{
            //echo $output; exit;
            $output = json_decode($output);
        }
        // close curl resource to free up system resources 
        curl_close($ch);  
        
        return $output->items;
    }
    
    public function group_refresh(){
        $temp_name = $this->_temp_path . 'groups_services.json';
        
        if (file_exists($temp_name)){
            unlink($temp_name);
        }
        
        $service = $this->_get_group_service();
        if ($service){
            file_put_contents($temp_name, json_encode($service));
            
            return TRUE;
        }else{
            return FALSE;
        }
    }
    
    public function get_groups($array=FALSE){
        $temp_name = $this->_temp_path . 'groups_services.json';
        
        $items = NULL;
        if (file_exists($temp_name)){
            $items = json_decode(file_get_contents($temp_name));
        }else{
            $service = $this->_get_group_service();
            if ($service){
                file_put_contents($temp_name, json_encode($service));
                
                $items = $service;
            }
        }
        
        
        if ($items){
            if ($array){
                $result = array();
                foreach ($items as $item){
                    $result[$item->id] = $item;
                }
                
                return $result;
            }
        }
        
        return $items;
    }
    
    protected function _get_group_service(){
        $service_url = $this->_service_url . 'grup/all';
        
        $ch = curl_init(); 
        // set url 
        curl_setopt($ch, CURLOPT_URL, $service_url); 

        curl_setopt($ch,CURLOPT_POST,FALSE); 
        //return the transfer as a string 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 

        // $output contains the output string 
        $output = curl_exec($ch); 
        if (curl_errno($ch)){
            return FALSE;
        }else{
            //echo $output; exit;
            $output = json_decode($output);
        }
        // close curl resource to free up system resources 
        curl_close($ch);  
        
        return $output->items;
    }
    
    public function wilayah_refresh(){
        $temp_name = $this->_temp_path . 'wilayah_services.json';
        
        if (file_exists($temp_name)){
            unlink($temp_name);
        }
        
        $service = $this->_get_wilayah_service();
        if ($service){
            file_put_contents($temp_name, json_encode($service));
            
            return TRUE;
        }else{
            return FALSE;
        }
    }
    
    public function get_wilayah($array=FALSE){
        $temp_name = $this->_temp_path . 'wilayah_services.json';
        
        $items = NULL;
        if (file_exists($temp_name)){
            $items = json_decode(file_get_contents($temp_name));
        }else{
            $service = $this->_get_wilayah_service();
            if ($service){
                file_put_contents($temp_name, json_encode($service));
                
                $items = $service;
            }
        }
        
        
        if ($items && $array){
            $result = array();
            foreach ($items as $item){
                $result[$item->id] = $item;
            }
            return $result;
        }
        
        return $items;
    }
    
    protected function _get_wilayah_service(){
        $service_url = $this->_service_url . 'wilayah/all';
        
        $ch = curl_init(); 
        // set url 
        curl_setopt($ch, CURLOPT_URL, $service_url); 

        curl_setopt($ch,CURLOPT_POST,FALSE); 
        //return the transfer as a string 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 

        // $output contains the output string 
        $output = curl_exec($ch); 
        if (curl_errno($ch)){
            return FALSE;
        }else{
            //echo $output; exit;
            $output = json_decode($output);
        }
        // close curl resource to free up system resources 
        curl_close($ch);  
        
        return $output->items;
    }
    
    
}

/**
 * Filename : UserService.php
 * Location : application/libraries/UserService.php
 */
