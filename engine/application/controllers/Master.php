<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Master extends Admin_Controller {

    public function client(){
        $this->data['page_title'] = 'Master Client';
        $this->data['page_subtitle'] = 'Daftar client';
        
        $this->data['subview'] = 'master/client';
        $this->load->view('_layout_main', $this->data);
    }
}

/*
 * Filename: Master.php
 * Location: application/controllers/Master.php
 */