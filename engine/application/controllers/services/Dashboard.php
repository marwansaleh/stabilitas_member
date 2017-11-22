<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of Dashboard
 *
 * @author marwansaleh 1:31:58 PM
 */
class Dashboard extends REST_Api {
    
    function __construct($config = 'rest') {
        parent::__construct($config);
    }
    
    public function agendas_get(){
        $this->load->model(array('rel_agenda_m'));
        $result = array('status'=>FALSE, 'items'=>array());
        
        $where = array('agenda_status <='=>AGENDA_ST_APPROVE);
        
        $agendas = $this->rel_agenda_m->get_by($where);
        if ($agendas){
            $result['status'] = TRUE;
            $result['items'] = $agendas;
        }else{
            $result['message'] = 'Tidak ada data agenda';
        }
        $this->response($result);
    }
}

/**
 * Filename : Dashboard.php
 * Location : application/controllers/services/Dashboard.php
 */
