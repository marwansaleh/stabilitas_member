<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of Migration_add_rel_menu
 *
 * @author marwansaleh
 */
class Migration_add_rel_menu extends MY_Migration {
    protected $_table_name = 'rel_mainmenu';
    protected $_primary_key = 'id';
    protected $_index_keys = array('caption','link');
    protected $_fields = array(
        'id'    => array (
            'type'  => 'INT',
            'constraint' => 11,
            'unsigned' => TRUE,
            'auto_increment' => TRUE
        ),
        'parent'    => array (
            'type'  => 'INT',
            'constraint' => 11,
            'null' => TRUE,
            'default' => 0
        ),
        'caption'   => array(
            'type'  => 'VARCHAR',
            'constraint' => 50,
            'null' => TRUE
        ),
        'title' => array(
            'type'  => 'VARCHAR',
            'constraint' => 254,
            'null' => TRUE
        ),
        'icon'   => array(
            'type'  => 'VARCHAR',
            'constraint' => 50,
            'null' => TRUE
        ),
        'link'   => array(
            'type'  => 'VARCHAR',
            'constraint' => 254,
            'null' => TRUE
        ),
        'sort'   => array(
            'type'  => 'INT',
            'constraint' => 3,
            'default' => 0
        ),
        'admin'   => array(
            'type'  => 'TINYINT',
            'constraint' => 1,
            'default' => 0
        ),
        'hidden'   => array(
            'type'  => 'TINYINT',
            'constraint' => 1,
            'default' => 0,
            'null' =>TRUE
        )
    );
    
    public function up(){
        parent::up();
        //Need seeding ?
        $dashboard = array(
            array(
                'caption'       => 'DASHBOARD',
                'title'         => 'Display important parameters',
                'icon'          => 'fa-dashboard',
                'link'          => 'dashboard',
                'sort'          => 0,
                'admin'         => 0, //ALL User group
                'hidden'        => 0
            )
        );
        $root = array(
            array(
                'caption'       => 'CONFIGURATION',
                'title'         => 'Super admin menu',
                'icon'          => 'fa-cogs',
                'link'          => NULL,
                'sort'          => 1,
                'admin'         => 1,
                'hidden'        => 0,
                'children'      => array(
                    array(
                        'caption'       => 'Master Interest',
                        'title'         => NULL,
                        'icon'          => NULL,
                        'link'          => 'master/interest',
                        'sort'          => 0,
                        'admin'         => 1,
                        'hidden'        => 0
                    ),
                    array(
                        'caption'       => 'Master Pendidikan',
                        'title'         => NULL,
                        'icon'          => NULL,
                        'link'          => 'master/education',
                        'sort'          => 1,
                        'admin'         => 1,
                        'hidden'        => 0
                    ),
                    array(
                        'caption'       => 'Menu Management',
                        'title'         => NULL,
                        'icon'          => NULL,
                        'link'          => 'config/menu',
                        'sort'          => 2,
                        'admin'         => 1,
                        'hidden'        => 0
                    ),
                    array(
                        'caption'       => 'Backup Database',
                        'title'         => NULL,
                        'icon'          => NULL,
                        'link'          => 'config/backup',
                        'sort'          => 3,
                        'admin'         => 1,
                        'hidden'        => 0
                    )
                )
            ),
            array(
                'caption'       => 'USER MANAGEMENT',
                'title'         => 'Manage user accounts',
                'icon'          => 'fa-lock',
                'link'          => NULL,
                'sort'          => 2,
                'admin'         => 1,
                'hidden'        => 0,
                'children'      => array(
                    array(
                        'caption'       => 'User Accounts',
                        'title'         => NULL,
                        'icon'          => NULL,
                        'link'          => 'user/account',
                        'sort'          => 0,
                        'admin'         => 1,
                        'hidden'        => 0
                    ),
                    array(
                        'caption'       => 'User Groups',
                        'title'         => NULL,
                        'icon'          => NULL,
                        'link'          => 'user/group',
                        'sort'          => 1,
                        'admin'         => 1,
                        'hidden'        => 0
                    )
                )
            )
        );
        
        
        $peserta = array(
            array(
                'caption'       => 'PESERTA',
                'title'         => 'Menu peserta',
                'icon'          => 'fa-users',
                'link'          => NULL,
                'sort'          => 3,
                'admin'         => 0,
                'hidden'        => 0,
                'children'      => array(
                    array(
                        'caption'       => 'Daftar Peserta',
                        'title'         => NULL,
                        'icon'          => NULL,
                        'link'          => 'member/register',
                        'sort'          => 0,
                        'admin'         => 0,
                        'hidden'        => 0
                    )
                )
            )
        );
        $event = array(
            array(
                'caption'       => 'EVENT',
                'title'         => 'Menu event',
                'icon'          => 'fa-book',
                'link'          => NULL,
                'sort'          => 4,
                'admin'         => 0,
                'hidden'        => 0,
                'children'      => array(
                    array(
                        'caption'       => 'Daftar Event',
                        'title'         => NULL,
                        'icon'          => NULL,
                        'link'          => 'event/register',
                        'sort'          => 0,
                        'admin'         => 0,
                        'hidden'        => 0
                    ),
                    array(
                        'caption'       => 'Daftar Kehadiran',
                        'title'         => NULL,
                        'icon'          => NULL,
                        'link'          => 'event/participant',
                        'sort'          => 1,
                        'admin'         => 0,
                        'hidden'        => 0
                    )
                )
            )
        );
        if (!function_exists('menu_filter_url')){
            function menu_filter_url($data){
                if (isset($data['link']) && $data['link']){
                    $data['link'] = rtrim($data['link'], '/');
                }
                
                return $data;
            }
        }
        $this->_seed_extend(array_merge_recursive($dashboard, $root, $peserta, $event),0,'parent','menu_filter_url');
    }
    
}

/*
 * filename : 014_add_rel_menu.php
 * location : /application/migrations/014_add_rel_menu.php
 */
