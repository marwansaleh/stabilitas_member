<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of Migration_add_master_agama
 *
 * @author marwansaleh
 */
class Migration_add_master_agama extends MY_Migration {
    protected $_table_name = 'ref_agama';
    protected $_primary_key = 'id';
    protected $_fields = array(
        'id'    => array (
            'type'  => 'VARCHAR',
            'constraint' => 2,
            'null' => FALSE
        ),
        'agama'    => array(
            'type' => 'VARCHAR',
            'constraint' => 30,
            'null' => FALSE
        )
    );
    
    public function up() {
        parent::up();
        
        $agama = array(
            array(
                'id'            => '01',
                'agama'         => 'ISLAM'
            ),
            array(
                'id'            => '02',
                'agama'         => 'KATOLIK'
            ),
            array(
                'id'            => '03',
                'agama'         => 'PROTESTAN'
            ),
            array(
                'id'            => '04',
                'agama'         => 'BUDHA'
            ),
            array(
                'id'            => '05',
                'agama'         => 'HINDU'
            ),
        );
        $this->_seed($agama);
    }
}

/*
 * filename : 012_add_master_agama.php
 * location : /application/migrations/012_add_master_agama.php
 */
