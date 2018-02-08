<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of Migration_add_rel_pelatihan_anggota
 *
 * @author marwansaleh
 */
class Migration_add_rel_pelatihan_anggota extends MY_Migration {
    protected $_table_name = 'rel_pelatihan_anggota';
    protected $_primary_key = 'id';
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
        'pelatihan'    => array(
            'type' => 'INT',
            'constraint' => 11,
            'null' => FALSE
        )
    );
}

/*
 * filename : 008_add_rel_pelatihan_anggota.php
 * location : /application/migrations/008_add_rel_pelatihan_anggota.php
 */
