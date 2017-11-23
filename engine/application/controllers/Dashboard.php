<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends Admin_Controller {

    public function index($referrer=NULL)
    {
        //determined which view should be shown according to group user
        $page_title = 'Dashboard';
        $the_view = 'dashboard/root/index';
        $user = $this->userlib->me();
        switch ($user->admin){
            case GROUP_ADMIN:
                $the_view = 'dashboard/admin/index'; 
                $page_title .= ' - ADMIN'; 
                break;
            case GROUP_USER_BROKER:
                $the_view = 'dashboard/user/index'; 
                $page_title .= ' - USER';
                break;
        }
        $this->data['subview'] = $the_view;
        
        $this->data['page_title'] = 'Dashboard';
        $this->data['page_subtitle'] = 'Register data peserta';
        
        $this->load->view('_layout_main', $this->data);
    }
    
}

/*
 * Filename: Dashboard.php
 * Location: application/controllers/Dashboard.php
 */