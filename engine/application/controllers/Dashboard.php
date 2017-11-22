<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends Admin_Controller {

    public function index($referrer=NULL)
    {
        //determined which view should be shown according to group user
        $page_title = 'Dashboard';
        $the_view = 'dashboard/root/index';
        $user = $this->userlib->me();
        switch ($user->group_user){
            case GROUP_USER_TERTANGGUNG:
                $the_view = 'dashboard/tertanggung/index'; 
                $page_title .= ' - TERTANGGUNG'; 
                break;
            case GROUP_USER_BROKER:
                $the_view = 'dashboard/broker/index'; 
                $page_title .= ' - BROKER';
                break;
            case GROUP_USER_ASURADUR:
                $the_view = 'dashboard/asuradur/index'; 
                $page_title .= ' - ASURADUR';
                break;
            case GROUP_USER_ROOT:
                $the_view = 'dashboard/root/index'; break;
        }
        $this->data['subview'] = $the_view;
        
        $this->data['page_title'] = 'Dashboard';
        $this->data['page_subtitle'] = 'Penutupan Asuransi Online LION';
        
        $this->load->view('_layout_main', $this->data);
    }
    
}

/*
 * Filename: Dashboard.php
 * Location: application/controllers/Dashboard.php
 */