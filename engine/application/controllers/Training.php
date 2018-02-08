<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Training extends Admin_Controller {

    public function index()
    {
        $this->data['page_title'] = 'Training';
        $this->data['page_subtitle'] = 'Register pelatihan';
        
        //set breadcumb
        breadcumb_add($this->data['breadcumb'], '<i class="fa fa-home"></i> Home', get_action_url('dashboard'));
        breadcumb_add($this->data['breadcumb'], 'Training', get_action_url('training/index'), TRUE);
        
        $this->data['subview'] = 'training/index';
        $this->load->view('_layout_main', $this->data);
    }
}

/*
 * Filename: Training.php
 * Location: application/controllers/Training.php
 */