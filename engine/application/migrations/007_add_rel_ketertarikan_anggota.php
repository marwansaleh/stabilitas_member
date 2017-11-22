<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of Migration_add_rel_ketertarikan_anggota
 *
 * @author marwansaleh
 */
class Migration_add_rel_ketertarikan_anggota extends MY_Migration {
    protected $_table_name = 'rel_ketertarikan_anggota';
    protected $_primary_key = 'id';
    protected $_fields = array(
        'id'    => array (
            'type'  => 'INT',
            'constraint' => 11,
            'unsigned' => TRUE,
            'auto_increment' => TRUE
        ),
        'ketertarikan'    => array(
            'type' => 'INT',
            'constraint' => 11,
            'null' => FALSE
        ),
        'anggota'  => array(
            'type' => 'INT',
            'constraint' => 11,
            'null' => FALSE
        )
    );
}

/*
 * filename : 007_add_rel_ketertarikan_anggota.php
 * location : /application/migrations/007_add_rel_ketertarikan_anggota.php
 */
