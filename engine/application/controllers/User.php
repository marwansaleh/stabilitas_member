<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends Admin_Controller {

    public function account()
    {
        $this->load->model(array('ref_user_group_m','ref_user_org_m'));
        $this->data['page_title'] = 'Users';
        $this->data['page_subtitle'] = 'Manage Accounts';
        
        $this->data['group_users'] = $this->ref_user_group_m->get();
        $this->data['organisations'] = $this->ref_user_org_m->get();
        $this->data['subview'] = 'user/account';
        $this->load->view('_layout_main', $this->data);
    }
    
}

/*
 * Filename: User.php
 * Location: application/controllers/User.php
 */