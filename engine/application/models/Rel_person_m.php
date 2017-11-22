<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Description of Rel_person_m
 *
 * @author Marwan
 * @email amazzura.biz@gmail.com
 */
class Rel_person_m extends MY_Model {
    protected $_table_name = 'rel_agenda_person_visited';
    protected $_primary_key = 'id';
    protected $_primary_filter = 'intval';
    protected $_order_by = 'agenda';
    protected $_timestamps = FALSE;
    
}

/*
 * file location: /application/models/Rel_person_m.php
 */
