<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Event extends Admin_Controller {

    public function register()
    {
        $this->data['page_title'] = 'Event';
        $this->data['page_subtitle'] = 'Register event';
        
        //set breadcumb
        breadcumb_add($this->data['breadcumb'], '<i class="fa fa-home"></i> Home', get_action_url('dashboard'));
        breadcumb_add($this->data['breadcumb'], 'Event', get_action_url('event/index'), TRUE);
        
        $this->data['subview'] = 'event/index';
        $this->load->view('_layout_main', $this->data);
    }
}

/*
 * Filename: Event.php
 * Location: application/controllers/Event.php
 */