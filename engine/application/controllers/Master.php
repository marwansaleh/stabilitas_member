<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Master extends Admin_Controller {

    public function client(){
        $this->data['page_title'] = 'Master Client';
        $this->data['page_subtitle'] = 'Daftar client';
        
        $this->data['subview'] = 'master/client';
        $this->load->view('_layout_main', $this->data);
    }
    public function target(){
        $this->data['page_title'] = 'Master Target';
        $this->data['page_subtitle'] = 'Daftar target';
        
        $this->data['subview'] = 'master/target';
        $this->load->view('_layout_main', $this->data);
    }
    public function broker_movement(){
        $this->data['page_title'] = 'Data Broker Movement';
        $this->data['page_subtitle'] = 'Daftar perpindahan broker';
        
        $this->data['subview'] = 'master/broker_movement';
        $this->load->view('_layout_main', $this->data);
    }
}

/*
 * Filename: Master.php
 * Location: application/controllers/Master.php
 */