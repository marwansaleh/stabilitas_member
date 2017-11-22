<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Description of Rel_agenda_m
 *
 * @author Marwan
 * @email amazzura.biz@gmail.com
 */
class Rel_agenda_m extends MY_Model {
    protected $_table_name = 'rel_broker_plan';
    protected $_primary_key = 'id';
    protected $_primary_filter = 'intval';
    protected $_order_by = 'plan_visit';
    protected $_timestamps = FALSE;
    
    public function inc_doc_count($agendaId){
        $sql = "UPDATE ".  $this->_table_name." SET doc_count=doc_count+1 WHERE id=$agendaId";
        $this->db->simple_query($sql);
    }
    
    public function dec_doc_count($agendaId){
        $sql = "UPDATE ".  $this->_table_name." SET doc_count=doc_count-1 WHERE id=$agendaId";
        $this->db->simple_query($sql);
    }
}

/*
 * file location: /application/models/Rel_agenda_m.php
 */
