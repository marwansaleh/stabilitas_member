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
            'type'  => 'INT',
            'constraint' => 3,
            'unsigned' => TRUE,
            'auto_increment' => TRUE
        ),
        'pendidikan'    => array(
            'type' => 'VARCHAR',
            'constraint' => 30,
            'null' => FALSE
        )
    );
    
    public function up() {
        parent::up();
        
        $this->_seed(array(
            array(
                'id'            => 1,
                'pendidikan'    => 'SD'
            ),
            array(
                'id'            => 2,
                'pendidikan'    => 'SMP'
            ),
            array(
                'id'            => 3,
                'pendidikan'    => 'SLTA'
            ),
            array(
                'id'            => 4,
                'pendidikan'    => 'DIPLOMA I'
            ),
            array(
                'id'            => 5,
                'pendidikan'    => 'DIPLOMA II'
            ),
            array(
                'id'            => 6,
                'pendidikan'    => 'DIPLOMA III'
            ),
            array(
                'id'            => 7,
                'pendidikan'    => 'SARJANA / S1'
            ),
            array(
                'id'            => 8,
                'pendidikan'    => 'MAGISTER / S2'
            ),
            array(
                'id'            => 9,
                'pendidikan'    => 'DOKTORAL / S3'
            )
        ));
    }
}

/*
 * filename : 004_add_master_pendidikan.php
 * location : /application/migrations/004_add_master_pendidikan.php
 */
