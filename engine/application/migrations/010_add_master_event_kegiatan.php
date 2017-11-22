<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of Migration_add_master_event_kegiatan
 *
 * @author marwansaleh
 */
class Migration_add_master_event_kegiatan extends MY_Migration {
    protected $_table_name = 'ref_event_kegiatan';
    protected $_primary_key = 'id';
    protected $_fields = array(
        'id'    => array (
            'type'  => 'INT',
            'constraint' => 11,
            'auto_increment' => TRUE
        ),
        'nama_kegiatan'    => array(
            'type' => 'VARCHAR',
            'constraint' => 245,
            'null' => FALSE
        ),
        'tanggal'    => array(
            'type' => 'DATE',
            'null' => FALSE
        ),
        'jumlah_hari'    => array(
            'type' => 'INT',
            'constraint' => 2,
            'default' => 1
        ),
        'lokasi'    => array(
            'type' => 'VARCHAR',
            'constraint' => 245,
            'null' => TRUE
        ),
        'propinsi'    => array (
            'type'  => 'VARCHAR',
            'constraint' => 2,
            'null' => FALSE
        ),
        'kota' => array(
            'type' => 'VARCHAR',
            'constraint' =>4,
            'null' => FALSE
        ),
    );
}

/*
 * filename : 010_add_master_event_kegiatan.php
 * location : /application/migrations/010_add_master_event_kegiatan.php
 */
