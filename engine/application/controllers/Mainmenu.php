<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mainmenu extends Admin_Controller {

    public function setup()
    {
        $this->data['page_title'] = 'Mainmenu';
        $this->data['page_subtitle'] = 'Setup mainmenu';
        
        $this->data['subview'] = 'system/mainmenu/index';
        $this->load->view('_layout_main', $this->data);
    }
}

/*
 * Filename: Mainmenu.php
 * Location: application/controllers/Mainmenu.php
 */