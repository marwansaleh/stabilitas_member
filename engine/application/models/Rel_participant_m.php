<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Description of Rel_participant_m
 *
 * @author Marwan
 * @email amazzura.biz@gmail.com
 */
class Rel_participant_m extends MY_Model {
    protected $_table_name = 'rel_event_peserta';
    protected $_primary_key = 'id';
    protected $_primary_filter = 'intval';
    protected $_order_by = 'id';
    protected $_timestamps = FALSE;
}

/*
 * file location: /application/models/Rel_participant_m.php
 */
