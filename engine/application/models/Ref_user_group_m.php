<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Description of ref_user_group_m
 *
 * @author Marwan
 * @email amazzura.biz@gmail.com
 */
class Ref_user_group_m extends MY_Model {
    protected $_table_name = 'ref_auth_user_group';
    protected $_primary_key = 'id';
    protected $_primary_filter = 'intval';
    protected $_order_by = 'id';
    protected $_timestamps = FALSE;
}

/*
 * file location: /application/models/ref_user_group_m.php
 */
