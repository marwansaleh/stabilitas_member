<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Description of Rel_history_m
 *
 * @author Marwan
 * @email amazzura.biz@gmail.com
 */
class Rel_history_m extends MY_Model {
    protected $_table_name = 'rel_action_history';
    protected $_primary_key = 'id';
    protected $_primary_filter = 'intval';
    protected $_order_by = 'id';
    protected $_timestamps = FALSE;
}

/*
 * file location: /application/models/Rel_history_m.php
 */
