<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of Migration_add_master_training
 *
 * @author marwansaleh
 */
class Migration_add_master_training extends MY_Migration {
    protected $_table_name = 'ref_training';
    protected $_primary_key = 'id';
    protected $_fields = array(
        'id'    => array (
            'type'  => 'INT',
            'constraint' => 11,
            'unsigned' => TRUE,
            'auto_increment' => TRUE
        ),
        'training'    => array(
            'type' => 'VARCHAR',
            'constraint' => 200,
            'null' => FALSE
        ),
        'penyelenggara'    => array(
            'type' => 'VARCHAR',
            'constraint' => 50,
            'null' => true
        ),
        'tahun'    => array(
            'type' => 'int',
            'constraint' => 4,
            'default' => 0
        ),
    );
}

/*
 * filename : 014_add_master_traing.php
 * location : /application/migrations/014_add_master_traing.php
 */
