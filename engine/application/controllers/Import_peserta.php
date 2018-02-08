<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of Import_peserta
 *
 * @author marwansaleh 1:47:44 PM
 */
class Import_peserta extends CI_Controller {
    function index($filename){
        $this->load->model(array('rel_member_m','rel_training_m'));
        $map = [
            'nama'=>1,'jenis_kelamin'=>2, 'tempat_lahir'=>4, 'tanggal_lahir'=>5,
            'agama'=>3, 'no_hp'=>6, 'alamat_email'=>7, 'nama_perusahaan'=>8
        ];

        $filename = 'static/userdata/import/'.$filename;

        echo 'Running parsing file:"'.$filename.'"'. PHP_EOL;

        $importer = new CsvImporter($filename, false, ','); 
        $count = 0;
        $failed = 0;
        while ($rows = $importer->get(2000)) 
        { 
            foreach ($rows as $row) {
                if (!$row[$map['nama']]) {
                    $failed++;

                    echo 'Not valid name'. PHP_EOL;
                    continue;
                }

                //cek apakah nama peserta dan tanggal lahir sama ada di database
                $exists_params = array('nama'=>trim($row[$map['nama']]), 'tanggal_lahir'=>$map['tanggal_lahir']);
                if ($this->rel_member_m->get_count($exists_params)>0){
                    $failed++;
                    continue;
                }

                $item = array();
                foreach ($map as $field_name => $col_index) {
                    if ($field_name=='agama') {
                        switch ($row[$col_index]) {
                            case 'ISLAM' : $item[$field_name] = '01'; break;
                            case 'KATOLIK' : $item[$field_name] = '02'; break;
                            case 'PROTESTAN' : $item[$field_name] = '03'; break;
                            case 'BUDHA' : $item[$field_name] = '04'; break;
                            case 'HINDU' : $item[$field_name] = '05'; break;
                            case 'OTHER' : $item[$field_name] = '06'; break;
                            default:
                            $item[$field_name] = '01'; break;
                        }
                    } else if ($field_name == 'jenis_kelamin') {
                        if ($row[$col_index] == 'PRIA') {
                            $item[$field_name] = 'L';
                        } else {
                            $item[$field_name] = 'P';
                        }
                    } else {
                        $item[$field_name] = trim($row[$col_index]);
                    }
                }
                $item['tanggal_daftar'] = date('Y-m-d H:i:s');

                $peserta_id = $this->rel_member_m->save($item);

                
                if ($peserta_id) {
                    //Update nomor pendaftaran
                    $this->rel_member_m->save(array('nomor_registrasi'=>format_noreg(date('Y'),date('m'), $peserta_id)), $peserta_id);
                    //Ambil nama pelatihan
                    $training_title = $row[9];
                    if ($training_title) {
                        $this->rel_training_m->save(array(
                            'anggota'   => $peserta_id,
                            'nama_pelatihan' => $training_title,
                            'nama_penyelenggara' => 'LPPI',
                            'tahun' => 0
                        ));
                    }
                }

                $count++;
            }
            
        }

        echo 'Success row:' . $count. PHP_EOL;
        echo 'Failed row:'. $failed. PHP_EOL;

        echo 'Finished.'. PHP_EOL;
    }

    function convert_training_2_event(){
        $this->load->model(array('rel_member_m','rel_training_m'));
    }
}

class CsvImporter 
{ 
    private $fp; 
    private $parse_header; 
    private $header; 
    private $delimiter; 
    private $length; 
    //-------------------------------------------------------------------- 
    function __construct($file_name, $parse_header=false, $delimiter="\t", $length=8000) 
    { 
        $this->fp = fopen($file_name, "r") or die('Failed open file '. $file_name); 
        $this->parse_header = $parse_header; 
        $this->delimiter = $delimiter; 
        $this->length = $length; 

        if ($this->parse_header) 
        { 
           $this->header = fgetcsv($this->fp, $this->length, $this->delimiter); 
        } 

    } 
    //-------------------------------------------------------------------- 
    function __destruct() 
    { 
        if ($this->fp) 
        { 
            fclose($this->fp); 
        } 
    } 
    //-------------------------------------------------------------------- 
    function get($max_lines=0) 
    { 
        //if $max_lines is set to 0, then get all the data 

        $data = array(); 

        if ($max_lines > 0) 
            $line_count = 0; 
        else 
            $line_count = -1; // so loop limit is ignored 

        while ($line_count < $max_lines && ($row = fgetcsv($this->fp, $this->length, $this->delimiter)) !== FALSE) 
        { 
            if ($this->parse_header) 
            { 
                foreach ($this->header as $i => $heading_i) 
                { 
                    $row_new[$heading_i] = $row[$i]; 
                } 
                $data[] = $row_new; 
            } 
            else 
            { 
                $data[] = $row; 
            } 

            if ($max_lines > 0) 
                $line_count++; 
        } 
        return $data; 
    } 
    //-------------------------------------------------------------------- 

} 

/**
 * Filename : Import_peserta.php
 * Location : /Import_peserta.php
 */
