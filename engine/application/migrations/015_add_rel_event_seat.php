<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of Migration_add_rel_event_seat
 *
 * @author marwansaleh
 */
class Migration_add_rel_event_seat extends MY_Migration {
    protected $_table_name = 'rel_event_seats';
    protected $_primary_key = 'id';
    protected $_fields = array(
        'id'    => array (
            'type'  => 'INT',
            'constraint' => 11,
            'auto_increment' => TRUE
        ),
        'event'  => array(
            'type' => 'INT',
            'constraint' => 11,
            'null' => FALSE
        ),
        'seat'  => array(
            'type' => 'TINYINT',
            'constraint' => 4,
            'default' => 0
        ),
        'anggota'  => array(
            'type' => 'INT',
            'constraint' => 11,
            'default' => 0
        ),
    );
}

/*
 * filename : 015_add_rel_event_seat.php
 * location : /application/migrations/015_add_rel_event_seat.php
 */
