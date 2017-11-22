<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Description of Rel_penutupan_m
 *
 * @author Marwan
 * @email amazzura.biz@gmail.com
 */
class Rel_penutupan_m extends MY_Model {
    protected $_table_name = 'rel_penutupan';
    protected $_primary_key = 'id';
    protected $_primary_filter = 'intval';
    protected $_order_by = 'id';
    protected $_timestamps = FALSE;
    
    public function calculate_sum($batch_id){
        $this->db->select_sum('plafon_kredit','plafon_kredit');
        $this->db->select_sum('nilai_premi','nilai_premi');
        $this->db->where(array('batch'=>$batch_id));
        $result = $this->db->get($this->_table_name)->row();
        if ($result){
            return $result;
        }else{
            return NULL;
        }
    }
}

/*
 * file location: /application/models/Rel_penutupan_m.php
 */
