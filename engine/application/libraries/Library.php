<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class of Library
 * Base class for custom class library
 *
 * @author marwansaleh
 */
class Library {
    protected $_log_file;
    protected $_log_path;
    protected $ci;
    protected $_error_message;
    
    private $_ip_address;
    
    function __construct() {
        $this->ci =& get_instance();
        
        $log_path = $this->ci->config->item('log_path');
        if ($log_path){
            $this->_log_path = rtrim($log_path, '/');
        }else{
            $this->_log_path = rtrim(sys_get_temp_dir(), '/');
        }
        $date = getdate();
        $log_file = $this->ci->config->item('log_file');
        if ($log_file){
            $this->_log_file = $this->_log_path . '/' . $log_file;
        }else{
            $this->_log_file = sprintf("%s%04d%02d%02d.log",$log_path .'/',$date['year'],$date['mon'],$date['mday']);
        }
        
        $this->_ip_address = $this->ci->input->ip_address();
    }
    
    public function hash($subject){
        return hash('md5', $this->ci->config->item('encryption_key') . $subject);
    }
    
    /**
     * Get error message
     * @return string
     */
    public function get_message(){
        return $this->_error_message;
    }
    
    /**
     * Write into log file
     * @param string $event_name log description
     * @throws Exception if failed
     */
    protected function write_log($event_name=''){
        $content = array(
            date('Y-m-d H:i:s'), 
            $this->_ip_address,
            $event_name
        );
        
        if ($fp = @fopen($this->_log_file, 'c')){
            fputcsv($fp, $content, "\t");
            fclose($fp);
        }
    }
    
    /************************************************************************************/
    /** HELPER PART **/
    /************************************************************************************/
    /**
     * Register proses dokumen KNV closing
     * @param STRING $doc_code kode document
     * @param DATETIME $datetime tanggal dan jam
     * @param int $doc_status Status document to_pos or posted => 0 / 1
     * @param int $userid user id default NULL
     * @param string $description Description default KOnversi otomatis
     * @return int ID proses dokumen
     */
    protected function _register_document_proccess($laporan,$source,$doc_code,$date,$doc_status,$userid=NULL,$description='Konversi otomatis'){
        if (!isset($this->ci->fin_jurnal_proccess_m)){
            $this->ci->load->model('fin_jurnal_proccess_m');
        }
        
        if ($userid){
            $userSvc = new UserService();
            $user = $userSvc->get_user($userid);
            
            if ($user && !$user->wilayah->id){
                $userid = USER_MACHINE;
                $kode_cabang = CABANG_MACHINE;
            }else{
                $kode_cabang = $user->wilayah->id;
            }
        }else{
            $userid = USER_MACHINE;
            $kode_cabang = CABANG_MACHINE;
        }
        
        return $this->ci->fin_jurnal_proccess_m->save(array(
            'laporan'               => $laporan,
            'source'                => $source,
            'kode_dokumen'          => $doc_code,
            'tanggal_laporan'       => $date,
            'initiated'             => time(),
            'initiated_by'          => $userid,
            'kode_cabang'           => $kode_cabang,
            'status'                => $doc_status,
            'deskripsi'             => $description
        ));
    }
    /**
     * Update status dokumen proses
     * @param int $doc_proccess_id
     * @param int $status
     */
    protected function _status_document_proccess($doc_proccess_id, $status=JOURNAL_POSTED){
        if (!isset($this->ci->fin_jurnal_proccess_m)){
            $this->ci->load->model('fin_jurnal_proccess_m');
        }
        $this->ci->fin_jurnal_proccess_m->save(array('status' => $status), $doc_proccess_id);
    }
    /**
     * Mengambil nomor rekening piutang, komis dan ppn berdasarkan jenis asuransi dan captive
     * @param int $jenis_asuransi
     * @param bit $captive wheather is captive
     * @return boolean FALSE if data not exists, or assoc array if exists
     */
    protected function _get_account_knv($jenis_asuransi=0,$captive=0){
        if (!isset($this->ci->fin_asuradur2_rekening_m)){
            $this->ci->load->model('fin_asuradur2_rekening_m');
        }
        
        $result = array();
        //get ppn
        $ppn_row = $this->ci->fin_asuradur2_rekening_m->get_by(array('tipe_rekening'=>'ppn'), TRUE);
        if (!$ppn_row){ return FALSE; }
        $result['ppn'] = $ppn_row;
        
        $piutang_row = $this->ci->fin_asuradur2_rekening_m->get_by(array('jenis_asuransi'=>$jenis_asuransi,'tipe_rekening'=>'piutang'), TRUE);
        if (!$piutang_row){ return FALSE; }
        $result['piutang'] = $piutang_row;
        
        $komisi_row = $this->ci->fin_asuradur2_rekening_m->get_by(array('jenis_asuransi'=>$jenis_asuransi,'captive'=>$captive,'tipe_rekening'=>'komisi'), TRUE);
        if (!$komisi_row){ return FALSE; }
        $result['komisi'] = $komisi_row;
        
        return $result;
    }
    /**
     * Membuat jurnal / neraca detail dari jurnal KNV
     * @param BIGINT $polis_id id polis
     * @param STRING $source Tipe dokumen
     * @param STRING $kode kode dokumen
     * @param STRING $ledger nomor rekening
     * @param DATETIME $datetime tanggal dan waktu
     * @param STRING $ccy mata uang
     * @param DECIMAL $rate nilai rate mata uang ke rupiah
     * @param DECIMAL $amount nilai
     * @param DECIMAL $amount_idr nilai dalam rupiah
     * @param STRING $mutasi kode mutasi
     * @return INT journal ID if success or FALSE if failed
     */
    protected function _post_to_journal($process, $polis_id,$source,$kode,$ledger,$ccy,$rate,$amount,$amount_idr,$mutasi, $tanggal_laporan, $status=JOURNAL_TO_POST){
        //$this->write_log('Mulai membuat jurnal KNV di neraca detail dari KNV detail');
        if (!isset($this->ci->fin_neraca_detail_m)){
            $this->ci->load->model('fin_neraca_detail_m');
        }
        if (!isset($this->ci->mkt_polis_m)){
            $this->ci->load->model('mkt_polis_m');
        }
        $polis = $this->ci->mkt_polis_m->get($polis_id);
        
        $this->write_log('Buat jurnal untuk ledger '. $ledger.' senilai '. number_format($amount_idr).' rupiah');
        if (!$polis){
            $this->write_log('Gagal membuat jurnal karena data polis tidak ditemukan');
            
            return FALSE;
        }
        $result = $this->ci->fin_neraca_detail_m->save(array(
            'laporan'               => $polis->laporan,
            'kantor_bsm'            => $polis->kantor_bsm,
            'proccess'              => $process,
            'source'                => $source,
            'kode_dokumen'          => $kode,
            'tanggal_laporan'       => $tanggal_laporan,
            'nota_transaksi'        => '',
            'keterangan_transaksi'  => 'KNV Polis: '.$polis->nomor_polis,
            'nomor_rekening'        => $ledger,
            'mata_uang'             => $ccy,
            'rate'                  => $rate,
            'nilai'                 => $amount,
            'nilai_idr'             => $amount_idr,
            'kode_mutasi'           => $mutasi,
            'status'                => $status
        ));
        
        return $result;
    }
    /**
     * Generate nomor debit nota
     * @param INT $tahun 2 digit
     * @param INT $bulan
     * @param INT $grup_sales
     * @return STRING nomor nota
     */
    protected function _get_debitnote_code($tahun,$bulan,$grup_sales){
        if (!isset($this->ci->mtr_sales_group_m)){
            $this->ci->load->model('mtr_sales_group_m');
        }
        $group_marketing_label = $this->ci->mtr_sales_group_m->get_value('label_no', array('id'=>$grup_sales));
        
        if (!isset($this->ci->debitnote_rekap_m)){
            $this->ci->load->model('debitnote_rekap_m');
        }
        $posisi = 1;
        
        $record = $this->ci->debitnote_rekap_m->get_by(array('tahun'=>$tahun, 'bulan'=>$bulan), TRUE);
        if ($record){
            $posisi = $record->jumlah + 1;
            $this->ci->debitnote_rekap_m->save(array('jumlah'=>$posisi, 'lastupdate'=>date('Y-m-d H:i:s')), $record->id);
        }else{
            $this->ci->debitnote_rekap_m->save(array('tahun'=>$tahun, 'bulan'=>$bulan, 'jumlah'=>$posisi, 'lastupdate'=> date('Y-m-d H:i:s')));
        }
        
        $nomor_nota = sprintf('DN/MKT.%s/%d.%02d/B.%05d',$group_marketing_label,$tahun,$bulan,$posisi);
        
        return $nomor_nota;
    }
    /**
     * Membuat kode dokumen baru jurnal
     * @param string $source tipe dokumen jurnal
     * @param int $year tahun
     * @param int $month bulan
     * @return string kode dokumen
     */
    protected function create_new_document($source,$year=NULL,$month=NULL){
        $this->ci->load->model('fin_doc_rekap_m');
        
        if (!$year){ $year = date('Y'); }
        if (!$month) { $month = date('m'); }
        
        $kode_dokumen = $this->ci->fin_doc_rekap_m->get_doc_number($source, $year, $month);
        return $kode_dokumen->kode;
    }
    public function get_exchange_rate($ccy,$year=NULL,$month=NULL,$trial=1){
        $max_trial = 3; //try to get rate max back months
        if ($ccy === 'IDR'){
            return 1;
        }
        if (!isset($this->ci->rel_kurs_m)){
            $this->ci->load->model('rel_kurs_m');
        }
        
        if (!$year){ date('Y'); }
        if (!$month){ date('m'); }
        
        $exchange = $this->ci->rel_kurs_m->get_by(array('bulan'=>$month,'tahun'=>$year,'matauang_id'=>$ccy), TRUE);
        if ($exchange){
            return $exchange->kurs;
        }else{
            if ($trial >= $max_trial){
                return 0;
            }else{
                $date = getdate(strtotime());
                return $this->get_exchange_rate($ccy, $date['year'], $date['month'], $trial+1);
            }
        }
    }
    
    protected function _get_current_exchange_rate($ccy){
        if (!isset($this->exchanges[$ccy])){
            $rate = $this->get_exchange_rate($ccy);
            $this->exchanges[$ccy] = $rate;
        }else{
            $rate = $this->exchanges[$ccy];
        }
        
        return $rate;
    }
}
