<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Description of Auth_user_m
 *
 * @author Marwan
 * @email amazzura.biz@gmail.com
 */
class Auth_user_m extends MY_Model {
    protected $_table_name = 'ref_auth_users';
    protected $_primary_key = 'id';
    protected $_primary_filter = 'intval';
    protected $_order_by = 'id';
    protected $_timestamps = FALSE;
    
}

/*
 * file location: /application/models/auth_user_m.php
 */
