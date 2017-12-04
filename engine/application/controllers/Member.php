<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Member extends Admin_Controller {

    public function register()
    {
        $this->load->model(array('ref_agama_m','ref_event_m','ref_pendidikan_m'));
        $this->data['page_title'] = 'Member';
        $this->data['page_subtitle'] = 'Register member';
        
        $this->data['religion'] = $this->ref_agama_m->get();
        $this->data['events'] = $this->ref_event_m->get();
        $this->data['educations'] = $this->ref_pendidikan_m->get();
        
        //set breadcumb
        breadcumb_add($this->data['breadcumb'], '<i class="fa fa-home"></i> Home', get_action_url('dashboard'));
        breadcumb_add($this->data['breadcumb'], 'Member', get_action_url('member/register'));
        breadcumb_add($this->data['breadcumb'], 'Register', get_action_url('member/register'), TRUE);
        
        $this->data['subview'] = 'member/register/index';
        $this->load->view('_layout_main', $this->data);
    }
}

/*
 * Filename: Member.php
 * Location: application/controllers/Member.php
 */