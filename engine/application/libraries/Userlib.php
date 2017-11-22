<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class of Userlib
 * Handle management of user, group and privileges
 *
 * @author marwansaleh 11:13:40 PM
 */
class Userlib extends Library {
    private static $objInstance;
    private $_service_url;
    
    private $_prefix_session_access = '_LIONBRI_';
    private $_role_session = '_ROLE_SESSION_';
    private $_page_session = '_PAGE_SESSION_';
    private $_menu_access_granted = '_MENU_GRANTED_';
    
    function __construct() {
        parent::__construct();
        
        if (!isset($this->ci->session)){
            $this->ci->load->library('session');
        }
        
        $this->_service_url = $this->ci->config->item('service_auth_url');
    }
    
    public static function getInstance(  ) { 
            
        if(!self::$objInstance){ 
            self::$objInstance = new Userlib();
        } 
        
        return self::$objInstance; 
    }
    
    public function get_name(){
        return $this->ci->session->userdata($this->_prefix_session_access.'nama');
    }
    
    public function get_userid(){
        return $this->ci->session->userdata($this->_prefix_session_access.'id');
    }
    /**
     * Check if user is loggedin
     * @return boolean
     */
    public function isLoggedin(){
        if ($this->ci->session->userdata($this->_prefix_session_access . 'isloggedin')){
            return TRUE;
        }else{
            return FALSE;
        }
    }
    /**
     * Try to guess wheather user is online
     * @param string $session_id
     * @return boolean
     */
    public function is_online($session_id){
        $session_table = $this->ci->config->item('sess_table_name') ? $this->ci->config->item('sess_table_name'):'sessions';
        $this->ci->db->select('COUNT(*) AS found')->from($session_table)->where('id',$session_id);
        $row = $this->ci->db->get()->row();
        
        if ($row){
            return $row->found > 0;
        }
        
        return FALSE;
    }
    
    public function login($username, $password){
        $tbl_user = 'ref_auth_users';
        //query ke database apakah ada account dengan username dan password yg sesuai
        $this->ci->db->select('*')->from($tbl_user)->where(array('username'=>$username, 'password'=>  _hash_($password)));
        $account = $this->ci->db->get()->row();
        
        if (!$account){
            $this->_error_message = 'User dan password tidak sesuai';
            return FALSE;
        }else if ($account->active != USER_ACTIVE){
            $this->_error_message = 'User ditandai sebagai TIDAK AKTIF"';
            return FALSE;
        }else{
            //create session variable for user
            $user_session = array();
            //set user loggedin status
            $user_session[$this->_prefix_session_access.'isloggedin'] = TRUE;
            $user_session[$this->_prefix_session_access.'is_root'] = $account->admin == 1;
            //Save user properties to session variable
            //But clean the data first from password word
            //unset($account->password);
            foreach ($account as $prop => $prop_value){
                $user_session[$this->_prefix_session_access . $prop] = $prop_value;
            }
            $user_session[$this->_prefix_session_access.'avatar'] = $account->sex == SEX_MALE ? 'male.png' : 'female.png';
            //Update sesion variables to the session
            $this->ci->session->set_userdata($user_session);
            
            //prepare user menu
            $user_menu = $this->_prepare_user_menu($account);
            $this->ci->session->set_userdata($this->_page_session, $user_menu);
            
            //Prepare user access
            
            return TRUE;
        }
    }
    
    /**
     * Get menu for currelntly loggedin user
     * @return stdclass menu
     */
    private function _prepare_user_menu($user){
        $this->ci->load->model(array('mainmenu_m'));
        
        $menu_user = array();
        
        $where = "(hidden=0)";
        switch ($user->group_user){
            case GROUP_USER_TERTANGGUNG: $where .= "AND(group_user=".GROUP_USER_TERTANGGUNG." OR group_user=".GROUP_USER_ALL.")"; break;
            case GROUP_USER_BROKER: $where .= "AND(group_user=".GROUP_USER_BROKER." OR group_user=".GROUP_USER_ALL.")"; break;
            case GROUP_USER_ASURADUR: $where .= "AND(group_user=".GROUP_USER_ASURADUR." OR group_user=".GROUP_USER_ALL.")"; break;
        }
        $menu_access_granted = array();
        $main_menu = $this->ci->mainmenu_m->get_by($where);
        foreach ($main_menu as $menuitem){
            $menuitem->granted = TRUE;
            if ($menuitem->granted){
                $menu_access_granted[] = $menuitem->id;
            }
            $menu_user[] = $menuitem;
        }
        
        
        //save to session menu granted id
        $this->ci->session->set_userdata($this->_menu_access_granted, $menu_access_granted);
        
        return $menu_user;
    }
    public function get_menu_granted(){
        return $this->ci->session->userdata($this->_menu_access_granted);
    }
    /**
     * Set user online status and last active
     * @param int $userid
     * @param int $status 1:online, 0:offline
     * @param int $bidang integer bidang to privilege
     * @return stdclass user local
     */
    public function user_set_online_status($userid,$status=1,$bidang=NULL){
        if (!isset($this->ci->auth_user_m)){
            $this->ci->load->model('auth_user_m');
        }
        
        if (!$this->ci->auth_user_m->get_by(array('userid'=>$userid),TRUE)){
            $this->ci->auth_user_m->save(array(
                'userid'        => $userid,
                'last_active'   => $status ? time() : 0,
                'online'        => $status,
                'privilege'     => bidang_2_privilege($bidang),
                'inserted'      => time()
            ));
        }else{
            $data_update = array('online' => $status);
            if ($status){
                $data_update['last_active'] = time();
            }
            $this->ci->auth_user_m->save_where($data_update, array('userid'=>$userid));
        }
        return $this->ci->auth_user_m->get_by(array('userid'=>$userid), TRUE);
    }
    /**
     * Get user access by group and user access specifi
     * @return array of user access fitur
     */
    private function _prepare_user_access(){
        //load user model
        $this->ci->load->model(array('auth_role_m','auth_group_privilege_m','auth_user_privilege_m'));
        
        $me = $this->me();
        
        //get all role
        $user_access = array();
        foreach ($this->ci->auth_role_m->get() as $role){
            if ($me->is_administrator){
                $role->granted = TRUE;
            }else{
                $role->granted = $role->granted==1 ? TRUE : FALSE;
            }
            $user_access[$role->id] = $role;
        }
        
        if (!$me->is_administrator){
            //get group access
            $group_access = $this->ci->auth_group_privilege_m->get_by(array('group_id'=>$me->grup->id));
            if ($group_access){
                foreach ($group_access as $ga){
                    if (isset($user_access[$ga->role_id])){
                        $access = $user_access[$ga->role_id];
                        $access->granted = $ga->granted==1 ? TRUE : FALSE;
                        $user_access[$ga->role_id] = $access;
                    }
                }
            }
            
            //get user access
            $user_access_specific = $this->ci->auth_user_privilege_m->get_by(array('user_id'=>$me->id));
            if ($user_access_specific){
                foreach ($user_access_specific as $ua){
                    if (isset($user_access[$ua->role_id])){
                        $access = $user_access[$ua->role_id];
                        $access->granted = $ua->granted==1 ? TRUE : FALSE;
                        $user_access[$ga->role_id] = $access;
                    }
                }
            }
        }
        
        //change user_access array into associative array by role name instead of role id
        $user_associative_array = array();
        foreach ($user_access as $access){
            $user_associative_array[$access->name] = $access->granted;
        }
        
        return $user_associative_array;
    }
    /**
     * Login using web service
     * @param string $username
     * @param string $password
     * @return boolean FALSE if FAILED or object login if success
     */
    private function _login_service($username,$password){
        $service_url = $this->_service_url . 'user/login';
        
        $login_data = array('username'=>$username, 'password'=>$password);
        
        $ch = curl_init(); 
        // set url 
        curl_setopt($ch, CURLOPT_URL, $service_url); 

        curl_setopt($ch,CURLOPT_POST,true); 
        curl_setopt($ch,CURLOPT_POSTFIELDS,  http_build_query($login_data));
        //return the transfer as a string 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5); //number of seconds to connect
        curl_setopt($ch, CURLOPT_TIMEOUT, 5); //number of seconds to connect
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
        
        return $output;
    }
    /**
     * User logout / end session
     * @param type $user_id USER ID(optional) if omitted, userID will be taken from session
     */
    public function logout(){
        $this->ci->session->sess_destroy();
    }
    /**
     * Check for access privileges for a specific page
     * @param int $page_id
     * @return boolean
     */
    public function has_page_access($page_id){
        $page_access = $this->ci->session->userdata($this->_page_session);
        if (isset($page_access[$page_id])){
            $page = $page_access[$page_id];
            
            return $page->granted;
        }
        
        return FALSE;
        
        //return isset($page_access[$page_id]) ? $page_access[$page_id] : FALSE;
    }
    /**
     * Check if user has access to certain fitur / role name
     * @param string $role_name
     * @return Boolean TRUE if has access or FALSE if not
     */
    public function has_access($role_name){
        $role_session = $this->ci->session->userdata($this->_role_session);
        return isset($role_session[$role_name]) ? $role_session[$role_name] : FALSE;
    }
    /**
     * Chek if loggedin user is ROOT user account
     * @return boolean TRUE if user logged in is root
     */
    public function is_root(){
        return $this->ci->session->userdata($this->_prefix_session_access.'is_root');
    }
    public function get_user_prop($prop_name){
        $prop_value = $this->ci->session->userdata($this->_prefix_session_access.$prop_name);
        return $prop_value;
    }
    /**
     * Check group is admin group
     * @param int $group_id
     * @return boolean
     */
    public function is_admin(){
        return $this->ci->session->userdata($this->_prefix_session_access.'is_admin');
    }
    
    /**
     * Generate password
     * @return string
     */
    public function generate_password($length=6){
        $alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
        $pass = array(); //remember to declare $pass as an array
        $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
        for ($i = 0; $i < $length; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        return implode($pass); //turn the array into a string
    }
    /**
     * Get current loggedin user as object
     * @return \stdClass of user objek
     */
    public function me(){
        $user = new stdClass();
        foreach ($this->ci->session->userdata() as $key => $value){
            if (strpos($key, $this->_prefix_session_access)!== FALSE){
                $key_length = strlen($this->_prefix_session_access) - strlen($key);
                $session_key = substr($key,$key_length);
                $user->$session_key = $value;
            }
        }
        
        return $user;
    }
    
    /**
     * Get user menu
     * @return array of user menu
     */
    public function get_user_menu(){
        return $this->ci->session->userdata($this->_page_session);
    }
}

/**
 * Filename : Userlib.php
 * Location : application/libraries/Userlib.php
 */
