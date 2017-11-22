<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Agenda extends Admin_Controller {

    public function register()
    {
        $this->data['page_title'] = 'Agenda';
        $this->data['page_subtitle'] = 'Agenda broker';
        
        $this->data['subview'] = 'agenda/register';
        $this->load->view('_layout_main', $this->data);
    }
    
    public function implementasi(){
        $this->data['page_title'] = 'Implementasi Agenda';
        $this->data['page_subtitle'] = 'Ekeskusi';
        
        $this->data['subview'] = 'agenda/implementasi';
        $this->load->view('_layout_main', $this->data);
    }
    
    public function client(){
        $this->data['page_title'] = 'Agenda - Client';
        $this->data['page_subtitle'] = 'Daftar agenda';
        
        $this->data['subview'] = 'agenda/client';
        $this->load->view('_layout_main', $this->data);
    }
    
    public function calender(){
        $this->data['page_title'] = 'Calendar';
        $this->data['page_subtitle'] = 'Kalendar agenda';
        
        $this->data['subview'] = 'agenda/calender';
        $this->load->view('_layout_main', $this->data);
    }
}

/*
 * Filename: Agenda.php
 * Location: application/controllers/Agenda.php
 */