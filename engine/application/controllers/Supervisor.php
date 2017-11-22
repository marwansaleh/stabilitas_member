<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Supervisor extends Admin_Controller {

    public function agenda()
    {
        $this->data['page_title'] = 'Agenda';
        $this->data['page_subtitle'] = 'Agenda broker';
        
        $this->data['subview'] = 'supervisor/agenda';
        $this->load->view('_layout_main', $this->data);
    }
    
    
}

/*
 * Filename: Supervisor.php
 * Location: application/controllers/Supervisor.php
 */