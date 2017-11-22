<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Description of Rel_doc_m
 *
 * @author Marwan
 * @email amazzura.biz@gmail.com
 */
class Rel_doc_m extends MY_Model {
    protected $_table_name = 'rel_agenda_doc';
    protected $_primary_key = 'id';
    protected $_primary_filter = 'intval';
    protected $_order_by = 'agenda,created';
    protected $_timestamps = FALSE;
    
}

/*
 * file location: /application/models/Rel_doc_m.php
 */
