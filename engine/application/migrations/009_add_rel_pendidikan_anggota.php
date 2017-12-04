<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of Migration_add_rel_pelatihan_anggota
 *
 * @author marwansaleh
 */
class Migration_add_rel_pendidikan_anggota extends MY_Migration {
    protected $_table_name = 'rel_pendidikan_anggota';
    protected $_primary_key = 'id';
    protected $_index_keys = array('nama_institusi');
    protected $_fields = array(
        'id'    => array (
            'type'  => 'INT',
            'constraint' => 11,
            'unsigned' => TRUE,
            'auto_increment' => TRUE
        ),
        'anggota'  => array(
            'type' => 'INT',
            'constraint' => 11,
            'null' => FALSE
        ),
        'pendidikan'    => array(
            'type' => 'INT',
            'constraint' => 3,
            'null' => FALSE
        ),
        'nama_institusi'    => array(
            'type' => 'VARCHAR',
            'constraint' => 30,
            'null' => TRUE
        ),
        'tahun_mulai'    => array(
            'type' => 'INT',
            'constraint' => 4,
            'null' => TRUE
        ),
        'tahun_selesai'    => array(
            'type' => 'INT',
            'constraint' => 4,
            'null' => TRUE
        )
    );
}

/*
 * filename : 009_add_rel_pendidikan_anggota.php
 * location : /application/migrations/009_add_rel_pendidikan_anggota.php
 */
