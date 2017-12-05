<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Event extends Admin_Controller {

    public function register()
    {
        $this->load->model(array('rel_member_m'));
        
        $this->data['page_title'] = 'Event';
        $this->data['page_subtitle'] = 'Register event';
        
        $this->data['members'] = $this->rel_member_m->get();
        
        //set breadcumb
        breadcumb_add($this->data['breadcumb'], '<i class="fa fa-home"></i> Home', get_action_url('dashboard'));
        breadcumb_add($this->data['breadcumb'], 'Event', get_action_url('event/register'), TRUE);
        
        $this->data['subview'] = 'event/index';
        $this->load->view('_layout_main', $this->data);
    }
    
    public function participant(){
        $this->data['page_title'] = 'Event';
        $this->data['page_subtitle'] = 'Participants';
        
        //set breadcumb
        breadcumb_add($this->data['breadcumb'], '<i class="fa fa-home"></i> Home', get_action_url('dashboard'));
        breadcumb_add($this->data['breadcumb'], 'Event', get_action_url('event/register'));
        breadcumb_add($this->data['breadcumb'], 'Participant', get_action_url('event/participant'), TRUE);
        
        $this->data['subview'] = 'event/participant';
        $this->load->view('_layout_main', $this->data);
    }
}

/*
 * Filename: Event.php
 * Location: application/controllers/Event.php
 */