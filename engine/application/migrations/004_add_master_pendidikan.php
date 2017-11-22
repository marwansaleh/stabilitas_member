<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of Migration_add_master_pendidikan
 *
 * @author marwansaleh
 */
class Migration_add_master_pendidikan extends MY_Migration {
    protected $_table_name = 'ref_pendidikan';
    protected $_primary_key = 'id';
    protected $_fields = array(
        'id'    => array (
            'type'  => 'VARCHAR',
            'constraint' => 3,
            'null' => FALSE
        ),
        'pendidikan'    => array(
            'type' => 'VARCHAR',
            'constraint' => 10,
            'null' => FALSE
        )
    );
}

/*
 * filename : 004_add_master_pendidikan.php
 * location : /application/migrations/004_add_master_pendidikan.php
 */
