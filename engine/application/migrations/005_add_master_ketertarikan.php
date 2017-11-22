<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of Migration_add_master_ketertarikan
 *
 * @author marwansaleh
 */
class Migration_add_master_ketertarikan extends MY_Migration {
    protected $_table_name = 'ref_ketertarikan';
    protected $_primary_key = 'id';
    protected $_fields = array(
        'id'    => array (
            'type'  => 'INT',
            'constraint' => 11,
            'auto_increment' => TRUE
        ),
        'ketertarikan'    => array(
            'type' => 'VARCHAR',
            'constraint' => 45,
            'null' => FALSE
        )
    );
}

/*
 * filename : 005_add_master_ketertarikan.php
 * location : /application/migrations/005_add_master_ketertarikan.php
 */
