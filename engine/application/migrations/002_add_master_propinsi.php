<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of Migration_add_master_propinsi
 *
 * @author marwansaleh
 */
class Migration_add_master_propinsi extends MY_Migration {
    protected $_table_name = 'ref_propinsi';
    protected $_primary_key = 'id';
    protected $_index_keys = array('nama');
    protected $_fields = array(
        'id'    => array (
            'type'  => 'VARCHAR',
            'constraint' => 2,
            'null' => FALSE
        ),
        'nama' => array(
            'type' => 'VARCHAR',
            'constraint' => 50,
            'null' => FALSE
        ),
        'created'   => array(
            'type'  => 'INT',
            'constraint' => 11,
            'unsigned' => TRUE,
            'default' => 0
        ),
        'created_by'   => array(
            'type'  => 'INT',
            'constraint' => 11,
            'unsigned' => TRUE,
            'default' => 0
        ),
        'modified'   => array(
            'type'  => 'INT',
            'constraint' => 11,
            'unsigned' => TRUE,
            'default' => 0
        ),
        'modified_by'   => array(
            'type'  => 'INT',
            'constraint' => 11,
            'unsigned' => TRUE,
            'default' => 0
        )
    );
    
    
    function up() {
        parent::up();
        
        $propinsi = array(
            array(
                'id' => '11',
                'nama' => 'ACEH',
                'created' => 1459149730,
                'created_by' => 1,
                'modified' => 1459149730,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '12',
                'nama' => 'SUMATERA UTARA',
                'created' => 1459149730,
                'created_by' => 1,
                'modified' => 1459149730,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '13',
                'nama' => 'SUMATERA BARAT',
                'created' => 1459149730,
                'created_by' => 1,
                'modified' => 1459149730,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '14',
                'nama' => 'RIAU',
                'created' => 1459149730,
                'created_by' => 1,
                'modified' => 1459149730,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '15',
                'nama' => 'JAMBI',
                'created' => 1459149730,
                'created_by' => 1,
                'modified' => 1459149730,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '16',
                'nama' => 'SUMATERA SELATAN',
                'created' => 1459149730,
                'created_by' => 1,
                'modified' => 1459149730,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '17',
                'nama' => 'BENGKULU',
                'created' => 1459149730,
                'created_by' => 1,
                'modified' => 1459149730,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '18',
                'nama' => 'LAMPUNG',
                'created' => 1459149730,
                'created_by' => 1,
                'modified' => 1459149730,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '19',
                'nama' => 'KEPULAUAN BANGKA BELITUNG',
                'created' => 1459149730,
                'created_by' => 1,
                'modified' => 1459149730,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '21',
                'nama' => 'KEPULAUAN RIAU',
                'created' => 1459149730,
                'created_by' => 1,
                'modified' => 1459149730,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '31',
                'nama' => 'DKI JAKARTA',
                'created' => 1459149730,
                'created_by' => 1,
                'modified' => 1459149730,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '32',
                'nama' => 'JAWA BARAT',
                'created' => 1459149730,
                'created_by' => 1,
                'modified' => 1459149730,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '33',
                'nama' => 'JAWA TENGAH',
                'created' => 1459149730,
                'created_by' => 1,
                'modified' => 1459149730,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '34',
                'nama' => 'DI YOGYAKARTA',
                'created' => 1459149730,
                'created_by' => 1,
                'modified' => 1459149730,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '35',
                'nama' => 'JAWA TIMUR',
                'created' => 1459149730,
                'created_by' => 1,
                'modified' => 1459149730,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '36',
                'nama' => 'BANTEN',
                'created' => 1459149730,
                'created_by' => 1,
                'modified' => 1459149730,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '51',
                'nama' => 'BALI',
                'created' => 1459149730,
                'created_by' => 1,
                'modified' => 1459149730,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '52',
                'nama' => 'NUSA TENGGARA BARAT',
                'created' => 1459149730,
                'created_by' => 1,
                'modified' => 1459149730,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '53',
                'nama' => 'NUSA TENGGARA TIMUR',
                'created' => 1459149730,
                'created_by' => 1,
                'modified' => 1459149730,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '61',
                'nama' => 'KALIMANTAN BARAT',
                'created' => 1459149730,
                'created_by' => 1,
                'modified' => 1459149730,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '62',
                'nama' => 'KALIMANTAN TENGAH',
                'created' => 1459149730,
                'created_by' => 1,
                'modified' => 1459149730,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '63',
                'nama' => 'KALIMANTAN SELATAN',
                'created' => 1459149730,
                'created_by' => 1,
                'modified' => 1459149730,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '64',
                'nama' => 'KALIMANTAN TIMUR',
                'created' => 1459149730,
                'created_by' => 1,
                'modified' => 1459149730,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '65',
                'nama' => 'KALIMANTAN UTARA',
                'created' => 1459149730,
                'created_by' => 1,
                'modified' => 1459149730,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '71',
                'nama' => 'SULAWESI UTARA',
                'created' => 1459149730,
                'created_by' => 1,
                'modified' => 1459149730,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '72',
                'nama' => 'SULAWESI TENGAH',
                'created' => 1459149730,
                'created_by' => 1,
                'modified' => 1459149730,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '73',
                'nama' => 'SULAWESI SELATAN',
                'created' => 1459149730,
                'created_by' => 1,
                'modified' => 1459149730,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '74',
                'nama' => 'SULAWESI TENGGARA',
                'created' => 1459149730,
                'created_by' => 1,
                'modified' => 1459149730,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '75',
                'nama' => 'GORONTALO',
                'created' => 1459149730,
                'created_by' => 1,
                'modified' => 1459149730,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '76',
                'nama' => 'SULAWESI BARAT',
                'created' => 1459149730,
                'created_by' => 1,
                'modified' => 1459149730,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '81',
                'nama' => 'MALUKU',
                'created' => 1459149730,
                'created_by' => 1,
                'modified' => 1459149730,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '82',
                'nama' => 'MALUKU UTARA',
                'created' => 1459149730,
                'created_by' => 1,
                'modified' => 1459149730,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '91',
                'nama' => 'PAPUA BARAT',
                'created' => 1459149730,
                'created_by' => 1,
                'modified' => 1459149730,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '94',
                'nama' => 'PAPUA',
                'created' => 1459149730,
                'created_by' => 1,
                'modified' => 1459149730,
                'modified_by' => 1
            )
        );
        $this->_seed($propinsi);
    }
}

/*
 * filename : 002_add_master_propinsi.php
 * location : /application/migrations/002_add_master_propinsi.php
 */
