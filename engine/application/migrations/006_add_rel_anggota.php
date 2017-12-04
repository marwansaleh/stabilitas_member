<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of Migration_add_rel_anggota
 *
 * @author marwansaleh
 */
class Migration_add_rel_anggota extends MY_Migration {
    protected $_table_name = 'rel_anggota';
    protected $_primary_key = 'id';
    protected $_index_keys = array('nama','alamat_email','username','nomor_registrasi');
    protected $_fields = array(
        'id'    => array (
            'type'  => 'INT',
            'constraint' => 11,
            'unsigned' => TRUE,
            'auto_increment' => TRUE
        ),
        'nama'    => array(
            'type' => 'VARCHAR',
            'constraint' => 50,
            'null' => FALSE
        ),
        'jenis_kelamin'  => array(
            'type' => 'ENUM("L","P")',
            'default' => 'L',
            'null' => FALSE
        ),
        'tempat_lahir'  => array(
            'type' => 'VARCHAR',
            'constraint' => 50,
            'null' => FALSE
        ),
        'tanggal_lahir'  => array(
            'type' => 'DATE',
            'null' => TRUE
        ),
        'agama'  => array(
            'type' => 'VARCHAR',
            'constraint' => 2,
            'null' => TRUE
        ),
        'no_hp'  => array(
            'type' => 'VARCHAR',
            'constraint' => 20,
            'null' => TRUE
        ),
        'alamat_email'  => array(
            'type' => 'VARCHAR',
            'constraint' => 30,
            'null' => TRUE
        ),
        'soc_facebook'  => array(
            'type' => 'VARCHAR',
            'constraint' => 200,
            'null' => TRUE
        ),
        'soc_twitter'  => array(
            'type' => 'VARCHAR',
            'constraint' => 200,
            'null' => TRUE
        ),
        'soc_instagram'  => array(
            'type' => 'VARCHAR',
            'constraint' => 200,
            'null' => TRUE
        ),
        'soc_youtube'  => array(
            'type' => 'VARCHAR',
            'constraint' => 200,
            'null' => TRUE
        ),
        'soc_linkedin'  => array(
            'type' => 'VARCHAR',
            'constraint' => 200,
            'null' => TRUE
        ),
        'alamat_rumah'  => array(
            'type' => 'VARCHAR',
            'constraint' => 254,
            'null' => TRUE
        ),
        'propinsi'    => array (
            'type'  => 'VARCHAR',
            'constraint' => 2,
            'null' => TRUE
        ),
        'kota' => array(
            'type' => 'VARCHAR',
            'constraint' =>4,
            'null' => TRUE
        ),
        'kode_pos'  => array(
            'type' => 'VARCHAR',
            'constraint' => 7,
            'null' => TRUE
        ),
        'telepon_rumah'  => array(
            'type' => 'VARCHAR',
            'constraint' => 15,
            'null' => TRUE
        ),
        'nama_perusahaan'  => array(
            'type' => 'VARCHAR',
            'constraint' => 50,
            'null' => TRUE
        ),
        'jabatan'  => array(
            'type' => 'VARCHAR',
            'constraint' => 50,
            'null' => TRUE
        ),
        'alamat_kantor'  => array(
            'type' => 'VARCHAR',
            'constraint' => 254,
            'null' => TRUE
        ),
        'telepon_kantor'  => array(
            'type' => 'VARCHAR',
            'constraint' => 15,
            'null' => TRUE
        ),
        'fax_kantor'  => array(
            'type' => 'VARCHAR',
            'constraint' => 15,
            'null' => TRUE
        ),
        'website_kantor'  => array(
            'type' => 'VARCHAR',
            'constraint' => 50,
            'null' => TRUE
        ),
        'pendidikan_terakhir'  => array(
            'type' => 'VARCHAR',
            'constraint' => 3,
            'null' => FALSE
        ),
        'prioritas'  => array(
            'type' => 'INT',
            'constraint' => 3,
            'null' => TRUE
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
        'aktif'  => array(
            'type' => 'TINYINT',
            'constraint' => 1,
            'default' => 0
        ),
        'login_terakhir'  => array(
            'type' => 'DATETIME',
            'null' => TRUE
        ),
        'tanggal_daftar'  => array(
            'type' => 'DATETIME',
            'null' => TRUE
        ),
        'nomor_registrasi'  => array(
            'type' => 'VARCHAR',
            'constraint' => 12,
            'null' => FALSE
        )
    );
}

/*
 * filename : 006_add_rel_anggota.php
 * location : /application/migrations/006_add_rel_anggota.php
 */
