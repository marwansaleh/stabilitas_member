<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of Migration_add_rel_event_peserta
 *
 * @author marwansaleh
 */
class Migration_add_rel_event_peserta extends MY_Migration {
    protected $_table_name = 'rel_event_peserta';
    protected $_primary_key = 'id';
    protected $_fields = array(
        'id'    => array (
            'type'  => 'INT',
            'constraint' => 11,
            'auto_increment' => TRUE
        ),
        'anggota'  => array(
            'type' => 'INT',
            'constraint' => 11,
            'null' => FALSE
        ),
        'event'  => array(
            'type' => 'INT',
            'constraint' => 11,
            'null' => FALSE
        ),
        'present'  => array(
            'type' => 'TINYINT',
            'constraint' => 1,
            'default' => 0
        ),
    );
}

/*
 * filename : 011_add_rel_event_peserta.php
 * location : /application/migrations/011_add_rel_event_peserta.php
 */
