<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Description of Error
 *
 * @author marwansaleh
 */
class Error extends Admin_Controller {
    function __construct() {
        parent::__construct();
    }
    
    function error_404(){
        $this->data['page_title'] = 'ERROR';
        $this->data['page_subtitle'] = 'PAGE NOT FOUND';
        
        $this->data['message'] = 'Maaf. Halaman yang anda cari tidak dapat ditemukan';
        $this->data['subview'] = 'errors/html/error_404';
        $this->load->view('_layout_main', $this->data);
    }
}

/*
 * file location: engine/application/controllers/roles.php
 */
