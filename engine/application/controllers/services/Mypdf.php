<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of Mypdf
 *
 * @author marwansaleh 1:31:58 PM
 */
class Mypdf extends REST_Api {
    
    
    function __construct($config = 'rest') {
        parent::__construct($config);
        
        //$this->load->model(array('auth_user_m','auth_group_m'));
    }
    
    public function nametag_post(){
        $this->load->model(array('rel_member_m','ref_event_m','rel_participant_m'));
        $result = array('status'=>FALSE);
        $event_id = $this->post('event_id');
        $member_id = $this->post('member_id');
        
        $seat = $this->rel_participant_m->get_by(array('event'=>$event_id,'anggota'=>$member_id), TRUE);
        
        $event = $this->ref_event_m->get($event_id);
        $member = $this->rel_member_m->get($member_id);
        
        $html = array();
        $html[] = '<div id="name-tag-container">';
        $html[] = '<h3>MAJALAH STABILITAS<hr></h3>';
        $html[] = '<h2>'.$event->nama_kegiatan.'</h2><br><br><br>';
        $html[] = '<h4>NAMA PESERTA</h4>';
        $html[] = '<h2><strong>'.$member->nama . '</strong></h2><br>';
        $html[] = '<h4>NOMOR KURSI</h4>';
        $html[] = '<h2><strong>'. ($seat ? str_pad($seat->seat, 3, '0', STR_PAD_LEFT) :'').'</strong></h2><br><br>';
        
        $html[] = '<h6>'.$event->lokasi.'</h6>';
        $html[] = '<h6>'.  indonesia_date_format('%d %M %Y', strtotime($event->tanggal)).'</h6>';
        $html[] = '</div>'; //end of nametag container
        
        $pdf_file = $this->_set_pdf(implode("", $html),"A4","NAME_TAG SEMINAR");
        if ($pdf_file){
            $result['status'] = TRUE;
            
            $result['file_name'] = $pdf_file;
            $encoded_url = urlencode(base64_encode($pdf_file));
            $result['download_url'] = site_url('download/index/'. $encoded_url);
        }
        
        $this->response($result);
    }
    
    /**
     * Convert html string into pdf document
     * @param string $html_content
     * @param string $pageSize default A4
     * @param string $title Judul PDF
     * @param string $filename Filename to be saved
     * @return string pdf filename
     */
    private function _set_pdf($html_content, $pageSize='A4', $title='', $filename=NULL){
        // include autoloader
        require_once APPPATH .'libraries/mpdf60/mpdf.php';
        
        $mpdf = new mPDF('',$pageSize); 
        //set metadata
        $mpdf->SetTitle($title ? $title : 'PDF Exported By Stabilitas System');
        $mpdf->SetAuthor('MAJALAH STABILITAS');
        $mpdf->SetCreator('MAJALAH STABILITAS');
        
        if (!$filename){
            $filename = rtrim(sys_get_temp_dir(), '/') .'/' . md5(time()) .'.pdf';
        }
        
        // LOAD a stylesheet
        $style_print = file_get_contents(get_asset_url('css/print-pdf.css'));
        
        $mpdf->WriteHTML($style_print,1); // The parameter 1 tells that this is css/style only and no body/html/text
        $mpdf->WriteHTML($html_content);
        
        //save to local file
        $mpdf->Output($filename, 'F');
        if (file_exists($filename)){
            return $filename;
        }else{
            return FALSE;
        }
    }
}

/**
 * Filename : Mypdf.php
 * Location : application/controllers/service/Mypdf.php
 */
