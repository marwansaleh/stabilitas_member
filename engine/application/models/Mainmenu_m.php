<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Description of Mainmenu_m
 *
 * @author Marwan
 * @email amazzura.biz@gmail.com
 */
class Mainmenu_m extends MY_Model {
    protected $_table_name = 'rel_mainmenu';
    protected $_primary_key = 'id';
    protected $_primary_filter = 'intval';
    protected $_order_by = 'parent,sort,caption';
    protected $_timestamps = FALSE;
}

/*
 * file location: /application/models/mainmenu_m.php
 */
