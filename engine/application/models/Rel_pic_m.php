<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Description of Rel_pic_m
 *
 * @author Marwan
 * @email amazzura.biz@gmail.com
 */
class Rel_pic_m extends MY_Model {
    protected $_table_name = 'rel_person';
    protected $_primary_key = 'id';
    protected $_primary_filter = 'intval';
    protected $_order_by = 'fullname';
    protected $_timestamps = FALSE;
    
}

/*
 * file location: /application/models/Rel_pic_m.php
 */
