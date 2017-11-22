<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of Migration_add_rel_accounts
 *
 * @author marwansaleh
 */
class Migration_add_rel_accounts extends MY_Migration {
    protected $_table_name = 'ref_auth_users';
    protected $_primary_key = 'id';
    protected $_index_keys = array('username');
    protected $_fields = array(
        'id'    => array (
            'type'  => 'INT',
            'constraint' => 11,
            'unsigned' => TRUE,
            'auto_increment' => TRUE
        ),
        'admin'  => array(
            'type' => 'TINYINT',
            'constraint' => 1,
            'default' => 0
        ),
        'username'  => array(
            'type' => 'VARCHAR',
            'constraint' => 30,
            'null' => TRUE
        ),
        'password'  => array(
            'type' => 'VARCHAR',
            'constraint' => 48,
            'null' => TRUE
        ),
        'active'  => array(
            'type' => 'TINYINT',
            'constraint' => 1,
            'default' => 0
        ),
        'last_loggedin'  => array(
            'type' => 'DATETIME',
            'null' => TRUE
        )
    );
    
    public function up() {
        parent::up();
        
        $users = array(
            array(
                'admin'         => 1,
                'username'      => 'root',
                'password'      => _hash_('root'),
                'active'        => 1,
                'last_loggedin' => date('Y-m-d H:i:s')
            ),
            array(
                'admin'         => 0,
                'username'      => 'user1',
                'password'      => _hash_('123456'),
                'active'        => 1,
                'last_loggedin' => date('Y-m-d H:i:s')
            )
        );
        $this->_seed($users);
    }
}

/*
 * filename : 013_add_rel_accounts.php
 * location : /application/migrations/013_add_rel_accounts.php
 */
