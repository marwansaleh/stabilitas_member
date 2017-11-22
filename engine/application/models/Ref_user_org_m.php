<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Description of Ref_user_org_m
 *
 * @author Marwan
 * @email amazzura.biz@gmail.com
 */
class Ref_user_org_m extends MY_Model {
    protected $_table_name = 'ref_auth_user_organisation';
    protected $_primary_key = 'id';
    protected $_primary_filter = 'intval';
    protected $_order_by = 'id';
    protected $_timestamps = FALSE;
}

/*
 * file location: /application/models/Ref_user_org_m.php
 */
