<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends Admin_Controller {

    public function index($referrer=NULL)
    {
        $this->data['page_title'] = 'Dashboard';
        $this->data['page_subtitle'] = 'Agenda broker';
        
        $this->data['subview'] = 'dashboard/index';
        $this->load->view('_layout_main', $this->data);
    }
    
}

/*
 * Filename: Dashboard.php
 * Location: application/controllers/Dashboard.php
 */