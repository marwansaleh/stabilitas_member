<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of Migration_add_master_kabupaten
 *
 * @author marwansaleh
 */
class Migration_add_master_kabupaten extends MY_Migration {
    protected $_table_name = 'ref_kabupaten';
    protected $_primary_key = 'id';
    protected $_index_keys = array('nama','propinsi');
    protected $_fields = array(
        'id'    => array (
            'type'  => 'VARCHAR',
            'constraint' => 4,
            'null' => FALSE
        ),
        'propinsi' => array(
            'type' => 'VARCHAR',
            'constraint' =>2,
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
    
    public function up() {
        parent::up();
        
        $kabupaten = array(
            array(
                'id' => '1101',
                'propinsi' => '11',
                'nama' => 'KABUPATEN SIMEULUE',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '1102',
                'propinsi' => '11',
                'nama' => 'KABUPATEN ACEH SINGKIL',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '1103',
                'propinsi' => '11',
                'nama' => 'KABUPATEN ACEH SELATAN',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '1104',
                'propinsi' => '11',
                'nama' => 'KABUPATEN ACEH TENGGARA',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '1105',
                'propinsi' => '11',
                'nama' => 'KABUPATEN ACEH TIMUR',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '1106',
                'propinsi' => '11',
                'nama' => 'KABUPATEN ACEH TENGAH',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '1107',
                'propinsi' => '11',
                'nama' => 'KABUPATEN ACEH BARAT',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '1108',
                'propinsi' => '11',
                'nama' => 'KABUPATEN ACEH BESAR',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '1109',
                'propinsi' => '11',
                'nama' => 'KABUPATEN PIDIE',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '1110',
                'propinsi' => '11',
                'nama' => 'KABUPATEN BIREUEN',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '1111',
                'propinsi' => '11',
                'nama' => 'KABUPATEN ACEH UTARA',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '1112',
                'propinsi' => '11',
                'nama' => 'KABUPATEN ACEH BARAT DAYA',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '1113',
                'propinsi' => '11',
                'nama' => 'KABUPATEN GAYO LUES',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '1114',
                'propinsi' => '11',
                'nama' => 'KABUPATEN ACEH TAMIANG',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '1115',
                'propinsi' => '11',
                'nama' => 'KABUPATEN NAGAN RAYA',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '1116',
                'propinsi' => '11',
                'nama' => 'KABUPATEN ACEH JAYA',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '1117',
                'propinsi' => '11',
                'nama' => 'KABUPATEN BENER MERIAH',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '1118',
                'propinsi' => '11',
                'nama' => 'KABUPATEN PIDIE JAYA',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '1171',
                'propinsi' => '11',
                'nama' => 'KOTA BANDA ACEH',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '1172',
                'propinsi' => '11',
                'nama' => 'KOTA SABANG',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '1173',
                'propinsi' => '11',
                'nama' => 'KOTA LANGSA',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '1174',
                'propinsi' => '11',
                'nama' => 'KOTA LHOKSEUMAWE',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '1175',
                'propinsi' => '11',
                'nama' => 'KOTA SUBULUSSALAM',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '1201',
                'propinsi' => '12',
                'nama' => 'KABUPATEN NIAS',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '1202',
                'propinsi' => '12',
                'nama' => 'KABUPATEN MANDAILING NATAL',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '1203',
                'propinsi' => '12',
                'nama' => 'KABUPATEN TAPANULI SELATAN',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '1204',
                'propinsi' => '12',
                'nama' => 'KABUPATEN TAPANULI TENGAH',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '1205',
                'propinsi' => '12',
                'nama' => 'KABUPATEN TAPANULI UTARA',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '1206',
                'propinsi' => '12',
                'nama' => 'KABUPATEN TOBA SAMOSIR',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '1207',
                'propinsi' => '12',
                'nama' => 'KABUPATEN LABUHAN BATU',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '1208',
                'propinsi' => '12',
                'nama' => 'KABUPATEN ASAHAN',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '1209',
                'propinsi' => '12',
                'nama' => 'KABUPATEN SIMALUNGUN',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '1210',
                'propinsi' => '12',
                'nama' => 'KABUPATEN DAIRI',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '1211',
                'propinsi' => '12',
                'nama' => 'KABUPATEN KARO',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '1212',
                'propinsi' => '12',
                'nama' => 'KABUPATEN DELI SERDANG',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '1213',
                'propinsi' => '12',
                'nama' => 'KABUPATEN LANGKAT',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '1214',
                'propinsi' => '12',
                'nama' => 'KABUPATEN NIAS SELATAN',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '1215',
                'propinsi' => '12',
                'nama' => 'KABUPATEN HUMBANG HASUNDUTAN',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '1216',
                'propinsi' => '12',
                'nama' => 'KABUPATEN PAKPAK BHARAT',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '1217',
                'propinsi' => '12',
                'nama' => 'KABUPATEN SAMOSIR',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '1218',
                'propinsi' => '12',
                'nama' => 'KABUPATEN SERDANG BEDAGAI',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '1219',
                'propinsi' => '12',
                'nama' => 'KABUPATEN BATU BARA',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '1220',
                'propinsi' => '12',
                'nama' => 'KABUPATEN PADANG LAWAS UTARA',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '1221',
                'propinsi' => '12',
                'nama' => 'KABUPATEN PADANG LAWAS',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '1222',
                'propinsi' => '12',
                'nama' => 'KABUPATEN LABUHAN BATU SELATAN',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '1223',
                'propinsi' => '12',
                'nama' => 'KABUPATEN LABUHAN BATU UTARA',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '1224',
                'propinsi' => '12',
                'nama' => 'KABUPATEN NIAS UTARA',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '1225',
                'propinsi' => '12',
                'nama' => 'KABUPATEN NIAS BARAT',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '1271',
                'propinsi' => '12',
                'nama' => 'KOTA SIBOLGA',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '1272',
                'propinsi' => '12',
                'nama' => 'KOTA TANJUNG BALAI',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '1273',
                'propinsi' => '12',
                'nama' => 'KOTA PEMATANG SIANTAR',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '1274',
                'propinsi' => '12',
                'nama' => 'KOTA TEBING TINGGI',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '1275',
                'propinsi' => '12',
                'nama' => 'KOTA MEDAN',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '1276',
                'propinsi' => '12',
                'nama' => 'KOTA BINJAI',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '1277',
                'propinsi' => '12',
                'nama' => 'KOTA PADANGSIDIMPUAN',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '1278',
                'propinsi' => '12',
                'nama' => 'KOTA GUNUNGSITOLI',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '1301',
                'propinsi' => '13',
                'nama' => 'KABUPATEN KEPULAUAN MENTAWAI',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '1302',
                'propinsi' => '13',
                'nama' => 'KABUPATEN PESISIR SELATAN',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '1303',
                'propinsi' => '13',
                'nama' => 'KABUPATEN SOLOK',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '1304',
                'propinsi' => '13',
                'nama' => 'KABUPATEN SIJUNJUNG',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '1305',
                'propinsi' => '13',
                'nama' => 'KABUPATEN TANAH DATAR',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '1306',
                'propinsi' => '13',
                'nama' => 'KABUPATEN PADANG PARIAMAN',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '1307',
                'propinsi' => '13',
                'nama' => 'KABUPATEN AGAM',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '1308',
                'propinsi' => '13',
                'nama' => 'KABUPATEN LIMA PULUH KOTA',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '1309',
                'propinsi' => '13',
                'nama' => 'KABUPATEN PASAMAN',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '1310',
                'propinsi' => '13',
                'nama' => 'KABUPATEN SOLOK SELATAN',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '1311',
                'propinsi' => '13',
                'nama' => 'KABUPATEN DHARMASRAYA',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '1312',
                'propinsi' => '13',
                'nama' => 'KABUPATEN PASAMAN BARAT',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '1371',
                'propinsi' => '13',
                'nama' => 'KOTA PADANG',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '1372',
                'propinsi' => '13',
                'nama' => 'KOTA SOLOK',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '1373',
                'propinsi' => '13',
                'nama' => 'KOTA SAWAH LUNTO',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '1374',
                'propinsi' => '13',
                'nama' => 'KOTA PADANG PANJANG',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '1375',
                'propinsi' => '13',
                'nama' => 'KOTA BUKITTINGGI',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '1376',
                'propinsi' => '13',
                'nama' => 'KOTA PAYAKUMBUH',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '1377',
                'propinsi' => '13',
                'nama' => 'KOTA PARIAMAN',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '1401',
                'propinsi' => '14',
                'nama' => 'KABUPATEN KUANTAN SINGINGI',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '1402',
                'propinsi' => '14',
                'nama' => 'KABUPATEN INDRAGIRI HULU',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '1403',
                'propinsi' => '14',
                'nama' => 'KABUPATEN INDRAGIRI HILIR',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '1404',
                'propinsi' => '14',
                'nama' => 'KABUPATEN PELALAWAN',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '1405',
                'propinsi' => '14',
                'nama' => 'KABUPATEN S I A K',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '1406',
                'propinsi' => '14',
                'nama' => 'KABUPATEN KAMPAR',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '1407',
                'propinsi' => '14',
                'nama' => 'KABUPATEN ROKAN HULU',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '1408',
                'propinsi' => '14',
                'nama' => 'KABUPATEN BENGKALIS',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '1409',
                'propinsi' => '14',
                'nama' => 'KABUPATEN ROKAN HILIR',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '1410',
                'propinsi' => '14',
                'nama' => 'KABUPATEN KEPULAUAN MERANTI',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '1471',
                'propinsi' => '14',
                'nama' => 'KOTA PEKANBARU',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '1473',
                'propinsi' => '14',
                'nama' => 'KOTA D U M A I',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '1501',
                'propinsi' => '15',
                'nama' => 'KABUPATEN KERINCI',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '1502',
                'propinsi' => '15',
                'nama' => 'KABUPATEN MERANGIN',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '1503',
                'propinsi' => '15',
                'nama' => 'KABUPATEN SAROLANGUN',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '1504',
                'propinsi' => '15',
                'nama' => 'KABUPATEN BATANG HARI',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '1505',
                'propinsi' => '15',
                'nama' => 'KABUPATEN MUARO JAMBI',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '1506',
                'propinsi' => '15',
                'nama' => 'KABUPATEN TANJUNG JABUNG TIMUR',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '1507',
                'propinsi' => '15',
                'nama' => 'KABUPATEN TANJUNG JABUNG BARAT',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '1508',
                'propinsi' => '15',
                'nama' => 'KABUPATEN TEBO',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '1509',
                'propinsi' => '15',
                'nama' => 'KABUPATEN BUNGO',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '1571',
                'propinsi' => '15',
                'nama' => 'KOTA JAMBI',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '1572',
                'propinsi' => '15',
                'nama' => 'KOTA SUNGAI PENUH',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '1601',
                'propinsi' => '16',
                'nama' => 'KABUPATEN OGAN KOMERING ULU',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '1602',
                'propinsi' => '16',
                'nama' => 'KABUPATEN OGAN KOMERING ILIR',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '1603',
                'propinsi' => '16',
                'nama' => 'KABUPATEN MUARA ENIM',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '1604',
                'propinsi' => '16',
                'nama' => 'KABUPATEN LAHAT',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '1605',
                'propinsi' => '16',
                'nama' => 'KABUPATEN MUSI RAWAS',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '1606',
                'propinsi' => '16',
                'nama' => 'KABUPATEN MUSI BANYUASIN',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '1607',
                'propinsi' => '16',
                'nama' => 'KABUPATEN BANYU ASIN',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '1608',
                'propinsi' => '16',
                'nama' => 'KABUPATEN OGAN KOMERING ULU SELATAN',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '1609',
                'propinsi' => '16',
                'nama' => 'KABUPATEN OGAN KOMERING ULU TIMUR',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '1610',
                'propinsi' => '16',
                'nama' => 'KABUPATEN OGAN ILIR',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '1611',
                'propinsi' => '16',
                'nama' => 'KABUPATEN EMPAT LAWANG',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '1612',
                'propinsi' => '16',
                'nama' => 'KABUPATEN PENUKAL ABAB LEMATANG ILIR',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '1613',
                'propinsi' => '16',
                'nama' => 'KABUPATEN MUSI RAWAS UTARA',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '1671',
                'propinsi' => '16',
                'nama' => 'KOTA PALEMBANG',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '1672',
                'propinsi' => '16',
                'nama' => 'KOTA PRABUMULIH',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '1673',
                'propinsi' => '16',
                'nama' => 'KOTA PAGAR ALAM',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '1674',
                'propinsi' => '16',
                'nama' => 'KOTA LUBUKLINGGAU',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '1701',
                'propinsi' => '17',
                'nama' => 'KABUPATEN BENGKULU SELATAN',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '1702',
                'propinsi' => '17',
                'nama' => 'KABUPATEN REJANG LEBONG',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '1703',
                'propinsi' => '17',
                'nama' => 'KABUPATEN BENGKULU UTARA',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '1704',
                'propinsi' => '17',
                'nama' => 'KABUPATEN KAUR',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '1705',
                'propinsi' => '17',
                'nama' => 'KABUPATEN SELUMA',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '1706',
                'propinsi' => '17',
                'nama' => 'KABUPATEN MUKOMUKO',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '1707',
                'propinsi' => '17',
                'nama' => 'KABUPATEN LEBONG',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '1708',
                'propinsi' => '17',
                'nama' => 'KABUPATEN KEPAHIANG',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '1709',
                'propinsi' => '17',
                'nama' => 'KABUPATEN BENGKULU TENGAH',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '1771',
                'propinsi' => '17',
                'nama' => 'KOTA BENGKULU',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '1801',
                'propinsi' => '18',
                'nama' => 'KABUPATEN LAMPUNG BARAT',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '1802',
                'propinsi' => '18',
                'nama' => 'KABUPATEN TANGGAMUS',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '1803',
                'propinsi' => '18',
                'nama' => 'KABUPATEN LAMPUNG SELATAN',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '1804',
                'propinsi' => '18',
                'nama' => 'KABUPATEN LAMPUNG TIMUR',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '1805',
                'propinsi' => '18',
                'nama' => 'KABUPATEN LAMPUNG TENGAH',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '1806',
                'propinsi' => '18',
                'nama' => 'KABUPATEN LAMPUNG UTARA',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '1807',
                'propinsi' => '18',
                'nama' => 'KABUPATEN WAY KANAN',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '1808',
                'propinsi' => '18',
                'nama' => 'KABUPATEN TULANGBAWANG',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '1809',
                'propinsi' => '18',
                'nama' => 'KABUPATEN PESAWARAN',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '1810',
                'propinsi' => '18',
                'nama' => 'KABUPATEN PRINGSEWU',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '1811',
                'propinsi' => '18',
                'nama' => 'KABUPATEN MESUJI',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '1812',
                'propinsi' => '18',
                'nama' => 'KABUPATEN TULANG BAWANG BARAT',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '1813',
                'propinsi' => '18',
                'nama' => 'KABUPATEN PESISIR BARAT',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '1871',
                'propinsi' => '18',
                'nama' => 'KOTA BANDAR LAMPUNG',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '1872',
                'propinsi' => '18',
                'nama' => 'KOTA METRO',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '1901',
                'propinsi' => '19',
                'nama' => 'KABUPATEN BANGKA',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '1902',
                'propinsi' => '19',
                'nama' => 'KABUPATEN BELITUNG',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '1903',
                'propinsi' => '19',
                'nama' => 'KABUPATEN BANGKA BARAT',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '1904',
                'propinsi' => '19',
                'nama' => 'KABUPATEN BANGKA TENGAH',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '1905',
                'propinsi' => '19',
                'nama' => 'KABUPATEN BANGKA SELATAN',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '1906',
                'propinsi' => '19',
                'nama' => 'KABUPATEN BELITUNG TIMUR',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '1971',
                'propinsi' => '19',
                'nama' => 'KOTA PANGKAL PINANG',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '2101',
                'propinsi' => '21',
                'nama' => 'KABUPATEN KARIMUN',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '2102',
                'propinsi' => '21',
                'nama' => 'KABUPATEN BINTAN',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '2103',
                'propinsi' => '21',
                'nama' => 'KABUPATEN NATUNA',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '2104',
                'propinsi' => '21',
                'nama' => 'KABUPATEN LINGGA',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '2105',
                'propinsi' => '21',
                'nama' => 'KABUPATEN KEPULAUAN ANAMBAS',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '2171',
                'propinsi' => '21',
                'nama' => 'KOTA B A T A M',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '2172',
                'propinsi' => '21',
                'nama' => 'KOTA TANJUNG PINANG',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '3101',
                'propinsi' => '31',
                'nama' => 'KABUPATEN KEPULAUAN SERIBU',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '3171',
                'propinsi' => '31',
                'nama' => 'KOTA JAKARTA SELATAN',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '3172',
                'propinsi' => '31',
                'nama' => 'KOTA JAKARTA TIMUR',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '3173',
                'propinsi' => '31',
                'nama' => 'KOTA JAKARTA PUSAT',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '3174',
                'propinsi' => '31',
                'nama' => 'KOTA JAKARTA BARAT',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '3175',
                'propinsi' => '31',
                'nama' => 'KOTA JAKARTA UTARA',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '3201',
                'propinsi' => '32',
                'nama' => 'KABUPATEN BOGOR',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '3202',
                'propinsi' => '32',
                'nama' => 'KABUPATEN SUKABUMI',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '3203',
                'propinsi' => '32',
                'nama' => 'KABUPATEN CIANJUR',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '3204',
                'propinsi' => '32',
                'nama' => 'KABUPATEN BANDUNG',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '3205',
                'propinsi' => '32',
                'nama' => 'KABUPATEN GARUT',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '3206',
                'propinsi' => '32',
                'nama' => 'KABUPATEN TASIKMALAYA',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '3207',
                'propinsi' => '32',
                'nama' => 'KABUPATEN CIAMIS',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '3208',
                'propinsi' => '32',
                'nama' => 'KABUPATEN KUNINGAN',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '3209',
                'propinsi' => '32',
                'nama' => 'KABUPATEN CIREBON',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '3210',
                'propinsi' => '32',
                'nama' => 'KABUPATEN MAJALENGKA',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '3211',
                'propinsi' => '32',
                'nama' => 'KABUPATEN SUMEDANG',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '3212',
                'propinsi' => '32',
                'nama' => 'KABUPATEN INDRAMAYU',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '3213',
                'propinsi' => '32',
                'nama' => 'KABUPATEN SUBANG',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '3214',
                'propinsi' => '32',
                'nama' => 'KABUPATEN PURWAKARTA',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '3215',
                'propinsi' => '32',
                'nama' => 'KABUPATEN KARAWANG',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '3216',
                'propinsi' => '32',
                'nama' => 'KABUPATEN BEKASI',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '3217',
                'propinsi' => '32',
                'nama' => 'KABUPATEN BANDUNG BARAT',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '3218',
                'propinsi' => '32',
                'nama' => 'KABUPATEN PANGANDARAN',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '3271',
                'propinsi' => '32',
                'nama' => 'KOTA BOGOR',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '3272',
                'propinsi' => '32',
                'nama' => 'KOTA SUKABUMI',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '3273',
                'propinsi' => '32',
                'nama' => 'KOTA BANDUNG',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '3274',
                'propinsi' => '32',
                'nama' => 'KOTA CIREBON',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '3275',
                'propinsi' => '32',
                'nama' => 'KOTA BEKASI',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '3276',
                'propinsi' => '32',
                'nama' => 'KOTA DEPOK',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '3277',
                'propinsi' => '32',
                'nama' => 'KOTA CIMAHI',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '3278',
                'propinsi' => '32',
                'nama' => 'KOTA TASIKMALAYA',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '3279',
                'propinsi' => '32',
                'nama' => 'KOTA BANJAR',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '3301',
                'propinsi' => '33',
                'nama' => 'KABUPATEN CILACAP',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '3302',
                'propinsi' => '33',
                'nama' => 'KABUPATEN BANYUMAS',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '3303',
                'propinsi' => '33',
                'nama' => 'KABUPATEN PURBALINGGA',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '3304',
                'propinsi' => '33',
                'nama' => 'KABUPATEN BANJARNEGARA',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '3305',
                'propinsi' => '33',
                'nama' => 'KABUPATEN KEBUMEN',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '3306',
                'propinsi' => '33',
                'nama' => 'KABUPATEN PURWOREJO',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '3307',
                'propinsi' => '33',
                'nama' => 'KABUPATEN WONOSOBO',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '3308',
                'propinsi' => '33',
                'nama' => 'KABUPATEN MAGELANG',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '3309',
                'propinsi' => '33',
                'nama' => 'KABUPATEN BOYOLALI',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '3310',
                'propinsi' => '33',
                'nama' => 'KABUPATEN KLATEN',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '3311',
                'propinsi' => '33',
                'nama' => 'KABUPATEN SUKOHARJO',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '3312',
                'propinsi' => '33',
                'nama' => 'KABUPATEN WONOGIRI',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '3313',
                'propinsi' => '33',
                'nama' => 'KABUPATEN KARANGANYAR',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '3314',
                'propinsi' => '33',
                'nama' => 'KABUPATEN SRAGEN',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '3315',
                'propinsi' => '33',
                'nama' => 'KABUPATEN GROBOGAN',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '3316',
                'propinsi' => '33',
                'nama' => 'KABUPATEN BLORA',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '3317',
                'propinsi' => '33',
                'nama' => 'KABUPATEN REMBANG',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '3318',
                'propinsi' => '33',
                'nama' => 'KABUPATEN PATI',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '3319',
                'propinsi' => '33',
                'nama' => 'KABUPATEN KUDUS',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '3320',
                'propinsi' => '33',
                'nama' => 'KABUPATEN JEPARA',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '3321',
                'propinsi' => '33',
                'nama' => 'KABUPATEN DEMAK',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '3322',
                'propinsi' => '33',
                'nama' => 'KABUPATEN SEMARANG',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '3323',
                'propinsi' => '33',
                'nama' => 'KABUPATEN TEMANGGUNG',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '3324',
                'propinsi' => '33',
                'nama' => 'KABUPATEN KENDAL',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '3325',
                'propinsi' => '33',
                'nama' => 'KABUPATEN BATANG',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '3326',
                'propinsi' => '33',
                'nama' => 'KABUPATEN PEKALONGAN',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '3327',
                'propinsi' => '33',
                'nama' => 'KABUPATEN PEMALANG',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '3328',
                'propinsi' => '33',
                'nama' => 'KABUPATEN TEGAL',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '3329',
                'propinsi' => '33',
                'nama' => 'KABUPATEN BREBES',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '3371',
                'propinsi' => '33',
                'nama' => 'KOTA MAGELANG',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '3372',
                'propinsi' => '33',
                'nama' => 'KOTA SURAKARTA',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '3373',
                'propinsi' => '33',
                'nama' => 'KOTA SALATIGA',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '3374',
                'propinsi' => '33',
                'nama' => 'KOTA SEMARANG',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '3375',
                'propinsi' => '33',
                'nama' => 'KOTA PEKALONGAN',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '3376',
                'propinsi' => '33',
                'nama' => 'KOTA TEGAL',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '3401',
                'propinsi' => '34',
                'nama' => 'KABUPATEN KULON PROGO',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '3402',
                'propinsi' => '34',
                'nama' => 'KABUPATEN BANTUL',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '3403',
                'propinsi' => '34',
                'nama' => 'KABUPATEN GUNUNG KIDUL',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '3404',
                'propinsi' => '34',
                'nama' => 'KABUPATEN SLEMAN',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '3471',
                'propinsi' => '34',
                'nama' => 'KOTA YOGYAKARTA',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '3501',
                'propinsi' => '35',
                'nama' => 'KABUPATEN PACITAN',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '3502',
                'propinsi' => '35',
                'nama' => 'KABUPATEN PONOROGO',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '3503',
                'propinsi' => '35',
                'nama' => 'KABUPATEN TRENGGALEK',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '3504',
                'propinsi' => '35',
                'nama' => 'KABUPATEN TULUNGAGUNG',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '3505',
                'propinsi' => '35',
                'nama' => 'KABUPATEN BLITAR',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '3506',
                'propinsi' => '35',
                'nama' => 'KABUPATEN KEDIRI',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '3507',
                'propinsi' => '35',
                'nama' => 'KABUPATEN MALANG',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '3508',
                'propinsi' => '35',
                'nama' => 'KABUPATEN LUMAJANG',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '3509',
                'propinsi' => '35',
                'nama' => 'KABUPATEN JEMBER',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '3510',
                'propinsi' => '35',
                'nama' => 'KABUPATEN BANYUWANGI',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '3511',
                'propinsi' => '35',
                'nama' => 'KABUPATEN BONDOWOSO',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '3512',
                'propinsi' => '35',
                'nama' => 'KABUPATEN SITUBONDO',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '3513',
                'propinsi' => '35',
                'nama' => 'KABUPATEN PROBOLINGGO',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '3514',
                'propinsi' => '35',
                'nama' => 'KABUPATEN PASURUAN',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '3515',
                'propinsi' => '35',
                'nama' => 'KABUPATEN SIDOARJO',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '3516',
                'propinsi' => '35',
                'nama' => 'KABUPATEN MOJOKERTO',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '3517',
                'propinsi' => '35',
                'nama' => 'KABUPATEN JOMBANG',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '3518',
                'propinsi' => '35',
                'nama' => 'KABUPATEN NGANJUK',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '3519',
                'propinsi' => '35',
                'nama' => 'KABUPATEN MADIUN',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '3520',
                'propinsi' => '35',
                'nama' => 'KABUPATEN MAGETAN',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '3521',
                'propinsi' => '35',
                'nama' => 'KABUPATEN NGAWI',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '3522',
                'propinsi' => '35',
                'nama' => 'KABUPATEN BOJONEGORO',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '3523',
                'propinsi' => '35',
                'nama' => 'KABUPATEN TUBAN',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '3524',
                'propinsi' => '35',
                'nama' => 'KABUPATEN LAMONGAN',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '3525',
                'propinsi' => '35',
                'nama' => 'KABUPATEN GRESIK',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '3526',
                'propinsi' => '35',
                'nama' => 'KABUPATEN BANGKALAN',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '3527',
                'propinsi' => '35',
                'nama' => 'KABUPATEN SAMPANG',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '3528',
                'propinsi' => '35',
                'nama' => 'KABUPATEN PAMEKASAN',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '3529',
                'propinsi' => '35',
                'nama' => 'KABUPATEN SUMENEP',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '3571',
                'propinsi' => '35',
                'nama' => 'KOTA KEDIRI',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '3572',
                'propinsi' => '35',
                'nama' => 'KOTA BLITAR',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '3573',
                'propinsi' => '35',
                'nama' => 'KOTA MALANG',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '3574',
                'propinsi' => '35',
                'nama' => 'KOTA PROBOLINGGO',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '3575',
                'propinsi' => '35',
                'nama' => 'KOTA PASURUAN',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '3576',
                'propinsi' => '35',
                'nama' => 'KOTA MOJOKERTO',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '3577',
                'propinsi' => '35',
                'nama' => 'KOTA MADIUN',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '3578',
                'propinsi' => '35',
                'nama' => 'KOTA SURABAYA',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '3579',
                'propinsi' => '35',
                'nama' => 'KOTA BATU',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '3601',
                'propinsi' => '36',
                'nama' => 'KABUPATEN PANDEGLANG',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '3602',
                'propinsi' => '36',
                'nama' => 'KABUPATEN LEBAK',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '3603',
                'propinsi' => '36',
                'nama' => 'KABUPATEN TANGERANG',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '3604',
                'propinsi' => '36',
                'nama' => 'KABUPATEN SERANG',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '3671',
                'propinsi' => '36',
                'nama' => 'KOTA TANGERANG',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '3672',
                'propinsi' => '36',
                'nama' => 'KOTA CILEGON',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '3673',
                'propinsi' => '36',
                'nama' => 'KOTA SERANG',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '3674',
                'propinsi' => '36',
                'nama' => 'KOTA TANGERANG SELATAN',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '5101',
                'propinsi' => '51',
                'nama' => 'KABUPATEN JEMBRANA',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '5102',
                'propinsi' => '51',
                'nama' => 'KABUPATEN TABANAN',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '5103',
                'propinsi' => '51',
                'nama' => 'KABUPATEN BADUNG',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '5104',
                'propinsi' => '51',
                'nama' => 'KABUPATEN GIANYAR',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '5105',
                'propinsi' => '51',
                'nama' => 'KABUPATEN KLUNGKUNG',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '5106',
                'propinsi' => '51',
                'nama' => 'KABUPATEN BANGLI',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '5107',
                'propinsi' => '51',
                'nama' => 'KABUPATEN KARANG ASEM',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '5108',
                'propinsi' => '51',
                'nama' => 'KABUPATEN BULELENG',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '5171',
                'propinsi' => '51',
                'nama' => 'KOTA DENPASAR',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '5201',
                'propinsi' => '52',
                'nama' => 'KABUPATEN LOMBOK BARAT',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '5202',
                'propinsi' => '52',
                'nama' => 'KABUPATEN LOMBOK TENGAH',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '5203',
                'propinsi' => '52',
                'nama' => 'KABUPATEN LOMBOK TIMUR',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '5204',
                'propinsi' => '52',
                'nama' => 'KABUPATEN SUMBAWA',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '5205',
                'propinsi' => '52',
                'nama' => 'KABUPATEN DOMPU',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '5206',
                'propinsi' => '52',
                'nama' => 'KABUPATEN BIMA',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '5207',
                'propinsi' => '52',
                'nama' => 'KABUPATEN SUMBAWA BARAT',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '5208',
                'propinsi' => '52',
                'nama' => 'KABUPATEN LOMBOK UTARA',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '5271',
                'propinsi' => '52',
                'nama' => 'KOTA MATARAM',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '5272',
                'propinsi' => '52',
                'nama' => 'KOTA BIMA',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '5301',
                'propinsi' => '53',
                'nama' => 'KABUPATEN SUMBA BARAT',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '5302',
                'propinsi' => '53',
                'nama' => 'KABUPATEN SUMBA TIMUR',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '5303',
                'propinsi' => '53',
                'nama' => 'KABUPATEN KUPANG',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '5304',
                'propinsi' => '53',
                'nama' => 'KABUPATEN TIMOR TENGAH SELATAN',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '5305',
                'propinsi' => '53',
                'nama' => 'KABUPATEN TIMOR TENGAH UTARA',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '5306',
                'propinsi' => '53',
                'nama' => 'KABUPATEN BELU',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '5307',
                'propinsi' => '53',
                'nama' => 'KABUPATEN ALOR',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '5308',
                'propinsi' => '53',
                'nama' => 'KABUPATEN LEMBATA',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '5309',
                'propinsi' => '53',
                'nama' => 'KABUPATEN FLORES TIMUR',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '5310',
                'propinsi' => '53',
                'nama' => 'KABUPATEN SIKKA',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '5311',
                'propinsi' => '53',
                'nama' => 'KABUPATEN ENDE',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '5312',
                'propinsi' => '53',
                'nama' => 'KABUPATEN NGADA',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '5313',
                'propinsi' => '53',
                'nama' => 'KABUPATEN MANGGARAI',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '5314',
                'propinsi' => '53',
                'nama' => 'KABUPATEN ROTE NDAO',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '5315',
                'propinsi' => '53',
                'nama' => 'KABUPATEN MANGGARAI BARAT',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '5316',
                'propinsi' => '53',
                'nama' => 'KABUPATEN SUMBA TENGAH',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '5317',
                'propinsi' => '53',
                'nama' => 'KABUPATEN SUMBA BARAT DAYA',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '5318',
                'propinsi' => '53',
                'nama' => 'KABUPATEN NAGEKEO',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '5319',
                'propinsi' => '53',
                'nama' => 'KABUPATEN MANGGARAI TIMUR',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '5320',
                'propinsi' => '53',
                'nama' => 'KABUPATEN SABU RAIJUA',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '5321',
                'propinsi' => '53',
                'nama' => 'KABUPATEN MALAKA',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '5371',
                'propinsi' => '53',
                'nama' => 'KOTA KUPANG',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '6101',
                'propinsi' => '61',
                'nama' => 'KABUPATEN SAMBAS',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '6102',
                'propinsi' => '61',
                'nama' => 'KABUPATEN BENGKAYANG',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '6103',
                'propinsi' => '61',
                'nama' => 'KABUPATEN LANDAK',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '6104',
                'propinsi' => '61',
                'nama' => 'KABUPATEN MEMPAWAH',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '6105',
                'propinsi' => '61',
                'nama' => 'KABUPATEN SANGGAU',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '6106',
                'propinsi' => '61',
                'nama' => 'KABUPATEN KETAPANG',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '6107',
                'propinsi' => '61',
                'nama' => 'KABUPATEN SINTANG',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '6108',
                'propinsi' => '61',
                'nama' => 'KABUPATEN KAPUAS HULU',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '6109',
                'propinsi' => '61',
                'nama' => 'KABUPATEN SEKADAU',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '6110',
                'propinsi' => '61',
                'nama' => 'KABUPATEN MELAWI',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '6111',
                'propinsi' => '61',
                'nama' => 'KABUPATEN KAYONG UTARA',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '6112',
                'propinsi' => '61',
                'nama' => 'KABUPATEN KUBU RAYA',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '6171',
                'propinsi' => '61',
                'nama' => 'KOTA PONTIANAK',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '6172',
                'propinsi' => '61',
                'nama' => 'KOTA SINGKAWANG',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '6201',
                'propinsi' => '62',
                'nama' => 'KABUPATEN KOTAWARINGIN BARAT',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '6202',
                'propinsi' => '62',
                'nama' => 'KABUPATEN KOTAWARINGIN TIMUR',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '6203',
                'propinsi' => '62',
                'nama' => 'KABUPATEN KAPUAS',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '6204',
                'propinsi' => '62',
                'nama' => 'KABUPATEN BARITO SELATAN',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '6205',
                'propinsi' => '62',
                'nama' => 'KABUPATEN BARITO UTARA',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '6206',
                'propinsi' => '62',
                'nama' => 'KABUPATEN SUKAMARA',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '6207',
                'propinsi' => '62',
                'nama' => 'KABUPATEN LAMANDAU',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '6208',
                'propinsi' => '62',
                'nama' => 'KABUPATEN SERUYAN',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '6209',
                'propinsi' => '62',
                'nama' => 'KABUPATEN KATINGAN',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '6210',
                'propinsi' => '62',
                'nama' => 'KABUPATEN PULANG PISAU',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '6211',
                'propinsi' => '62',
                'nama' => 'KABUPATEN GUNUNG MAS',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '6212',
                'propinsi' => '62',
                'nama' => 'KABUPATEN BARITO TIMUR',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '6213',
                'propinsi' => '62',
                'nama' => 'KABUPATEN MURUNG RAYA',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '6271',
                'propinsi' => '62',
                'nama' => 'KOTA PALANGKA RAYA',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '6301',
                'propinsi' => '63',
                'nama' => 'KABUPATEN TANAH LAUT',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '6302',
                'propinsi' => '63',
                'nama' => 'KABUPATEN KOTA BARU',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '6303',
                'propinsi' => '63',
                'nama' => 'KABUPATEN BANJAR',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '6304',
                'propinsi' => '63',
                'nama' => 'KABUPATEN BARITO KUALA',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '6305',
                'propinsi' => '63',
                'nama' => 'KABUPATEN TAPIN',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '6306',
                'propinsi' => '63',
                'nama' => 'KABUPATEN HULU SUNGAI SELATAN',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '6307',
                'propinsi' => '63',
                'nama' => 'KABUPATEN HULU SUNGAI TENGAH',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '6308',
                'propinsi' => '63',
                'nama' => 'KABUPATEN HULU SUNGAI UTARA',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '6309',
                'propinsi' => '63',
                'nama' => 'KABUPATEN TABALONG',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '6310',
                'propinsi' => '63',
                'nama' => 'KABUPATEN TANAH BUMBU',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '6311',
                'propinsi' => '63',
                'nama' => 'KABUPATEN BALANGAN',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '6371',
                'propinsi' => '63',
                'nama' => 'KOTA BANJARMASIN',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '6372',
                'propinsi' => '63',
                'nama' => 'KOTA BANJAR BARU',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '6401',
                'propinsi' => '64',
                'nama' => 'KABUPATEN PASER',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '6402',
                'propinsi' => '64',
                'nama' => 'KABUPATEN KUTAI BARAT',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '6403',
                'propinsi' => '64',
                'nama' => 'KABUPATEN KUTAI KARTANEGARA',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '6404',
                'propinsi' => '64',
                'nama' => 'KABUPATEN KUTAI TIMUR',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '6405',
                'propinsi' => '64',
                'nama' => 'KABUPATEN BERAU',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '6409',
                'propinsi' => '64',
                'nama' => 'KABUPATEN PENAJAM PASER UTARA',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '6411',
                'propinsi' => '64',
                'nama' => 'KABUPATEN MAHAKAM HULU',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '6471',
                'propinsi' => '64',
                'nama' => 'KOTA BALIKPAPAN',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '6472',
                'propinsi' => '64',
                'nama' => 'KOTA SAMARINDA',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '6474',
                'propinsi' => '64',
                'nama' => 'KOTA BONTANG',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '6501',
                'propinsi' => '65',
                'nama' => 'KABUPATEN MALINAU',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '6502',
                'propinsi' => '65',
                'nama' => 'KABUPATEN BULUNGAN',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '6503',
                'propinsi' => '65',
                'nama' => 'KABUPATEN TANA TIDUNG',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '6504',
                'propinsi' => '65',
                'nama' => 'KABUPATEN NUNUKAN',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '6571',
                'propinsi' => '65',
                'nama' => 'KOTA TARAKAN',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '7101',
                'propinsi' => '71',
                'nama' => 'KABUPATEN BOLAANG MONGONDOW',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '7102',
                'propinsi' => '71',
                'nama' => 'KABUPATEN MINAHASA',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '7103',
                'propinsi' => '71',
                'nama' => 'KABUPATEN KEPULAUAN SANGIHE',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '7104',
                'propinsi' => '71',
                'nama' => 'KABUPATEN KEPULAUAN TALAUD',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '7105',
                'propinsi' => '71',
                'nama' => 'KABUPATEN MINAHASA SELATAN',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '7106',
                'propinsi' => '71',
                'nama' => 'KABUPATEN MINAHASA UTARA',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '7107',
                'propinsi' => '71',
                'nama' => 'KABUPATEN BOLAANG MONGONDOW UTARA',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '7108',
                'propinsi' => '71',
                'nama' => 'KABUPATEN SIAU TAGULANDANG BIARO',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '7109',
                'propinsi' => '71',
                'nama' => 'KABUPATEN MINAHASA TENGGARA',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '7110',
                'propinsi' => '71',
                'nama' => 'KABUPATEN BOLAANG MONGONDOW SELATAN',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '7111',
                'propinsi' => '71',
                'nama' => 'KABUPATEN BOLAANG MONGONDOW TIMUR',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '7171',
                'propinsi' => '71',
                'nama' => 'KOTA MANADO',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '7172',
                'propinsi' => '71',
                'nama' => 'KOTA BITUNG',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '7173',
                'propinsi' => '71',
                'nama' => 'KOTA TOMOHON',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '7174',
                'propinsi' => '71',
                'nama' => 'KOTA KOTAMOBAGU',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '7201',
                'propinsi' => '72',
                'nama' => 'KABUPATEN BANGGAI KEPULAUAN',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '7202',
                'propinsi' => '72',
                'nama' => 'KABUPATEN BANGGAI',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '7203',
                'propinsi' => '72',
                'nama' => 'KABUPATEN MOROWALI',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '7204',
                'propinsi' => '72',
                'nama' => 'KABUPATEN POSO',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '7205',
                'propinsi' => '72',
                'nama' => 'KABUPATEN DONGGALA',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '7206',
                'propinsi' => '72',
                'nama' => 'KABUPATEN TOLI-TOLI',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '7207',
                'propinsi' => '72',
                'nama' => 'KABUPATEN BUOL',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '7208',
                'propinsi' => '72',
                'nama' => 'KABUPATEN PARIGI MOUTONG',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '7209',
                'propinsi' => '72',
                'nama' => 'KABUPATEN TOJO UNA-UNA',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '7210',
                'propinsi' => '72',
                'nama' => 'KABUPATEN SIGI',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '7211',
                'propinsi' => '72',
                'nama' => 'KABUPATEN BANGGAI LAUT',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '7212',
                'propinsi' => '72',
                'nama' => 'KABUPATEN MOROWALI UTARA',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '7271',
                'propinsi' => '72',
                'nama' => 'KOTA PALU',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '7301',
                'propinsi' => '73',
                'nama' => 'KABUPATEN KEPULAUAN SELAYAR',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '7302',
                'propinsi' => '73',
                'nama' => 'KABUPATEN BULUKUMBA',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '7303',
                'propinsi' => '73',
                'nama' => 'KABUPATEN BANTAENG',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '7304',
                'propinsi' => '73',
                'nama' => 'KABUPATEN JENEPONTO',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '7305',
                'propinsi' => '73',
                'nama' => 'KABUPATEN TAKALAR',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '7306',
                'propinsi' => '73',
                'nama' => 'KABUPATEN GOWA',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '7307',
                'propinsi' => '73',
                'nama' => 'KABUPATEN SINJAI',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '7308',
                'propinsi' => '73',
                'nama' => 'KABUPATEN MAROS',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '7309',
                'propinsi' => '73',
                'nama' => 'KABUPATEN PANGKAJENE DAN KEPULAUAN',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '7310',
                'propinsi' => '73',
                'nama' => 'KABUPATEN BARRU',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '7311',
                'propinsi' => '73',
                'nama' => 'KABUPATEN BONE',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '7312',
                'propinsi' => '73',
                'nama' => 'KABUPATEN SOPPENG',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '7313',
                'propinsi' => '73',
                'nama' => 'KABUPATEN WAJO',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '7314',
                'propinsi' => '73',
                'nama' => 'KABUPATEN SIDENRENG RAPPANG',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '7315',
                'propinsi' => '73',
                'nama' => 'KABUPATEN PINRANG',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '7316',
                'propinsi' => '73',
                'nama' => 'KABUPATEN ENREKANG',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '7317',
                'propinsi' => '73',
                'nama' => 'KABUPATEN LUWU',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '7318',
                'propinsi' => '73',
                'nama' => 'KABUPATEN TANA TORAJA',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '7322',
                'propinsi' => '73',
                'nama' => 'KABUPATEN LUWU UTARA',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '7325',
                'propinsi' => '73',
                'nama' => 'KABUPATEN LUWU TIMUR',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '7326',
                'propinsi' => '73',
                'nama' => 'KABUPATEN TORAJA UTARA',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '7371',
                'propinsi' => '73',
                'nama' => 'KOTA MAKASSAR',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '7372',
                'propinsi' => '73',
                'nama' => 'KOTA PAREPARE',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '7373',
                'propinsi' => '73',
                'nama' => 'KOTA PALOPO',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '7401',
                'propinsi' => '74',
                'nama' => 'KABUPATEN BUTON',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '7402',
                'propinsi' => '74',
                'nama' => 'KABUPATEN MUNA',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '7403',
                'propinsi' => '74',
                'nama' => 'KABUPATEN KONAWE',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '7404',
                'propinsi' => '74',
                'nama' => 'KABUPATEN KOLAKA',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '7405',
                'propinsi' => '74',
                'nama' => 'KABUPATEN KONAWE SELATAN',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '7406',
                'propinsi' => '74',
                'nama' => 'KABUPATEN BOMBANA',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '7407',
                'propinsi' => '74',
                'nama' => 'KABUPATEN WAKATOBI',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '7408',
                'propinsi' => '74',
                'nama' => 'KABUPATEN KOLAKA UTARA',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '7409',
                'propinsi' => '74',
                'nama' => 'KABUPATEN BUTON UTARA',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '7410',
                'propinsi' => '74',
                'nama' => 'KABUPATEN KONAWE UTARA',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '7411',
                'propinsi' => '74',
                'nama' => 'KABUPATEN KOLAKA TIMUR',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '7412',
                'propinsi' => '74',
                'nama' => 'KABUPATEN KONAWE KEPULAUAN',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '7413',
                'propinsi' => '74',
                'nama' => 'KABUPATEN MUNA BARAT',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '7414',
                'propinsi' => '74',
                'nama' => 'KABUPATEN BUTON TENGAH',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '7415',
                'propinsi' => '74',
                'nama' => 'KABUPATEN BUTON SELATAN',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '7471',
                'propinsi' => '74',
                'nama' => 'KOTA KENDARI',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '7472',
                'propinsi' => '74',
                'nama' => 'KOTA BAUBAU',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '7501',
                'propinsi' => '75',
                'nama' => 'KABUPATEN BOALEMO',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '7502',
                'propinsi' => '75',
                'nama' => 'KABUPATEN GORONTALO',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '7503',
                'propinsi' => '75',
                'nama' => 'KABUPATEN POHUWATO',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '7504',
                'propinsi' => '75',
                'nama' => 'KABUPATEN BONE BOLANGO',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '7505',
                'propinsi' => '75',
                'nama' => 'KABUPATEN GORONTALO UTARA',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '7571',
                'propinsi' => '75',
                'nama' => 'KOTA GORONTALO',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '7601',
                'propinsi' => '76',
                'nama' => 'KABUPATEN MAJENE',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '7602',
                'propinsi' => '76',
                'nama' => 'KABUPATEN POLEWALI MANDAR',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '7603',
                'propinsi' => '76',
                'nama' => 'KABUPATEN MAMASA',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '7604',
                'propinsi' => '76',
                'nama' => 'KABUPATEN MAMUJU',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '7605',
                'propinsi' => '76',
                'nama' => 'KABUPATEN MAMUJU UTARA',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '7606',
                'propinsi' => '76',
                'nama' => 'KABUPATEN MAMUJU TENGAH',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '8101',
                'propinsi' => '81',
                'nama' => 'KABUPATEN MALUKU TENGGARA BARAT',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '8102',
                'propinsi' => '81',
                'nama' => 'KABUPATEN MALUKU TENGGARA',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '8103',
                'propinsi' => '81',
                'nama' => 'KABUPATEN MALUKU TENGAH',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '8104',
                'propinsi' => '81',
                'nama' => 'KABUPATEN BURU',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '8105',
                'propinsi' => '81',
                'nama' => 'KABUPATEN KEPULAUAN ARU',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '8106',
                'propinsi' => '81',
                'nama' => 'KABUPATEN SERAM BAGIAN BARAT',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '8107',
                'propinsi' => '81',
                'nama' => 'KABUPATEN SERAM BAGIAN TIMUR',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '8108',
                'propinsi' => '81',
                'nama' => 'KABUPATEN MALUKU BARAT DAYA',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '8109',
                'propinsi' => '81',
                'nama' => 'KABUPATEN BURU SELATAN',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '8171',
                'propinsi' => '81',
                'nama' => 'KOTA AMBON',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '8172',
                'propinsi' => '81',
                'nama' => 'KOTA TUAL',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '8201',
                'propinsi' => '82',
                'nama' => 'KABUPATEN HALMAHERA BARAT',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '8202',
                'propinsi' => '82',
                'nama' => 'KABUPATEN HALMAHERA TENGAH',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '8203',
                'propinsi' => '82',
                'nama' => 'KABUPATEN KEPULAUAN SULA',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '8204',
                'propinsi' => '82',
                'nama' => 'KABUPATEN HALMAHERA SELATAN',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '8205',
                'propinsi' => '82',
                'nama' => 'KABUPATEN HALMAHERA UTARA',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '8206',
                'propinsi' => '82',
                'nama' => 'KABUPATEN HALMAHERA TIMUR',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '8207',
                'propinsi' => '82',
                'nama' => 'KABUPATEN PULAU MOROTAI',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '8208',
                'propinsi' => '82',
                'nama' => 'KABUPATEN PULAU TALIABU',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '8271',
                'propinsi' => '82',
                'nama' => 'KOTA TERNATE',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '8272',
                'propinsi' => '82',
                'nama' => 'KOTA TIDORE KEPULAUAN',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '9101',
                'propinsi' => '91',
                'nama' => 'KABUPATEN FAKFAK',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '9102',
                'propinsi' => '91',
                'nama' => 'KABUPATEN KAIMANA',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '9103',
                'propinsi' => '91',
                'nama' => 'KABUPATEN TELUK WONDAMA',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '9104',
                'propinsi' => '91',
                'nama' => 'KABUPATEN TELUK BINTUNI',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '9105',
                'propinsi' => '91',
                'nama' => 'KABUPATEN MANOKWARI',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '9106',
                'propinsi' => '91',
                'nama' => 'KABUPATEN SORONG SELATAN',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '9107',
                'propinsi' => '91',
                'nama' => 'KABUPATEN SORONG',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '9108',
                'propinsi' => '91',
                'nama' => 'KABUPATEN RAJA AMPAT',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '9109',
                'propinsi' => '91',
                'nama' => 'KABUPATEN TAMBRAUW',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '9110',
                'propinsi' => '91',
                'nama' => 'KABUPATEN MAYBRAT',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '9111',
                'propinsi' => '91',
                'nama' => 'KABUPATEN MANOKWARI SELATAN',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '9112',
                'propinsi' => '91',
                'nama' => 'KABUPATEN PEGUNUNGAN ARFAK',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '9171',
                'propinsi' => '91',
                'nama' => 'KOTA SORONG',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '9401',
                'propinsi' => '94',
                'nama' => 'KABUPATEN MERAUKE',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '9402',
                'propinsi' => '94',
                'nama' => 'KABUPATEN JAYAWIJAYA',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '9403',
                'propinsi' => '94',
                'nama' => 'KABUPATEN JAYAPURA',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '9404',
                'propinsi' => '94',
                'nama' => 'KABUPATEN NABIRE',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '9408',
                'propinsi' => '94',
                'nama' => 'KABUPATEN KEPULAUAN YAPEN',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '9409',
                'propinsi' => '94',
                'nama' => 'KABUPATEN BIAK NUMFOR',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '9410',
                'propinsi' => '94',
                'nama' => 'KABUPATEN PANIAI',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '9411',
                'propinsi' => '94',
                'nama' => 'KABUPATEN PUNCAK JAYA',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '9412',
                'propinsi' => '94',
                'nama' => 'KABUPATEN MIMIKA',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '9413',
                'propinsi' => '94',
                'nama' => 'KABUPATEN BOVEN DIGOEL',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '9414',
                'propinsi' => '94',
                'nama' => 'KABUPATEN MAPPI',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '9415',
                'propinsi' => '94',
                'nama' => 'KABUPATEN ASMAT',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '9416',
                'propinsi' => '94',
                'nama' => 'KABUPATEN YAHUKIMO',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '9417',
                'propinsi' => '94',
                'nama' => 'KABUPATEN PEGUNUNGAN BINTANG',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '9418',
                'propinsi' => '94',
                'nama' => 'KABUPATEN TOLIKARA',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '9419',
                'propinsi' => '94',
                'nama' => 'KABUPATEN SARMI',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '9420',
                'propinsi' => '94',
                'nama' => 'KABUPATEN KEEROM',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '9426',
                'propinsi' => '94',
                'nama' => 'KABUPATEN WAROPEN',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '9427',
                'propinsi' => '94',
                'nama' => 'KABUPATEN SUPIORI',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '9428',
                'propinsi' => '94',
                'nama' => 'KABUPATEN MAMBERAMO RAYA',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '9429',
                'propinsi' => '94',
                'nama' => 'KABUPATEN NDUGA',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '9430',
                'propinsi' => '94',
                'nama' => 'KABUPATEN LANNY JAYA',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '9431',
                'propinsi' => '94',
                'nama' => 'KABUPATEN MAMBERAMO TENGAH',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '9432',
                'propinsi' => '94',
                'nama' => 'KABUPATEN YALIMO',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '9433',
                'propinsi' => '94',
                'nama' => 'KABUPATEN PUNCAK',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '9434',
                'propinsi' => '94',
                'nama' => 'KABUPATEN DOGIYAI',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '9435',
                'propinsi' => '94',
                'nama' => 'KABUPATEN INTAN JAYA',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '9436',
                'propinsi' => '94',
                'nama' => 'KABUPATEN DEIYAI',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
            ,
            array(
                'id' => '9471',
                'propinsi' => '94',
                'nama' => 'KOTA JAYAPURA',
                'created' => 1459149924,
                'created_by' => 1,
                'modified' => 1459149924,
                'modified_by' => 1
            )
        );
        
        $this->_seed($kabupaten);
    }
}

/*
 * filename : 003_add_master_kabupaten.php
 * location : /application/migrations/003_add_master_kabupaten.php
 */
