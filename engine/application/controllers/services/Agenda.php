<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of Agenda
 *
 * @author marwansaleh 1:31:58 PM
 */
class Agenda extends REST_Api {
    
    function __construct($config = 'rest') {
        parent::__construct($config);
    }
    
    public function datatable_get(){
        $this->load->model(array('rel_agenda_m','auth_user_m'));
        
        $userid = $this->get('userid');
        
        
        $draw = $this->get('draw');
        $length = $this->get('length');
        $start = $this->get('start');
        $order_arr = $this->get('order');
        $columns_arr = $this->get('columns');
        $search = $this->get('search') ? $this->get('search') : NULL;
        
        //get order by and direction from the order & columns array
        $order_by = $columns_arr[$order_arr[0]['column']]['data'];
        $order_dir = $order_arr[0]['dir']; 
        
        $where = array();
        
        $totalRecords = $this->rel_agenda_m->get_count();
        
        //set filtered if any
        if ($search && $search['value']){
            $this->db->like('client_name', $search['value']);
        }
        //get filtered count
        $totalFiltered = $this->rel_agenda_m->get_count();
        
        $result = array('draw' => $draw, 'start'=>$start, 'recordsTotal'=>$totalRecords, 'recordsFiltered'=>$totalFiltered, 'items'=>array());

        if ($totalRecords > 0){
            
            //set filtered if any
            if ($search && $search['value']){
                $this->db->like('client_name', $search['value']);
            }
            //apply offset and limit of data
            $this->db->order_by($order_by,$order_dir);
            $this->db->offset($start)->limit($length);
            
            $query_result = $this->rel_agenda_m->get_by();
            if ($query_result){
                foreach ($query_result as $item){
                    $item->status_label = status_agenda($item->agenda_status);
                    $item->editable = $item->agenda_status==AGENDA_ST_NEW;
                    $item->deletable = $item->agenda_status==AGENDA_ST_NEW;
                    $broker = $this->auth_user_m->get_by(array('userid'=>$item->userid), TRUE);
                    if ($broker){
                        $item->broker = $broker;
                    }else{
                        $item->broker = NULL;
                    }
                    $result['items'][] = $item;
                }
            }
        }
        $this->response($result);
    }
    
    public function datatable_toexec_get(){
        $this->load->model(array('rel_agenda_m'));
        
        $userid = $this->get('userid');
        
        
        $draw = $this->get('draw');
        $length = $this->get('length');
        $start = $this->get('start');
        $order_arr = $this->get('order');
        $columns_arr = $this->get('columns');
        $search = $this->get('search') ? $this->get('search') : NULL;
        
        //get order by and direction from the order & columns array
        $order_by = $columns_arr[$order_arr[0]['column']]['data'];
        $order_dir = $order_arr[0]['dir']; 
        
        $where = array('agenda_status <='=>AGENDA_ST_APPROVE);
        
        $totalRecords = $this->rel_agenda_m->get_count($where);
        
        //set filtered if any
        if ($search && $search['value']){
            $this->db->like('client_name', $search['value']);
        }
        //get filtered count
        $totalFiltered = $this->rel_agenda_m->get_count($where);
        
        $result = array('draw' => $draw, 'start'=>$start, 'recordsTotal'=>$totalRecords, 'recordsFiltered'=>$totalFiltered, 'items'=>array());

        if ($totalRecords > 0){
            
            //set filtered if any
            if ($search && $search['value']){
                $this->db->like('client_name', $search['value']);
            }
            //apply offset and limit of data
            $this->db->order_by($order_by,$order_dir);
            $this->db->offset($start)->limit($length);
            
            $query_result = $this->rel_agenda_m->get_by($where);
            if ($query_result){
                foreach ($query_result as $item){
                    $item->status_label = status_agenda($item->agenda_status);
                    $result['items'][] = $item;
                }
            }
        }
        $this->response($result);
    }
    
    public function datatable_done_get(){
        $this->load->model(array('rel_agenda_m'));
        
        $userid = $this->get('userid');
        
        
        $draw = $this->get('draw');
        $length = $this->get('length');
        $start = $this->get('start');
        $order_arr = $this->get('order');
        $columns_arr = $this->get('columns');
        $search = $this->get('search') ? $this->get('search') : NULL;
        
        //get order by and direction from the order & columns array
        $order_by = $columns_arr[$order_arr[0]['column']]['data'];
        $order_dir = $order_arr[0]['dir']; 
        
        $where = array('agenda_status >='=>AGENDA_ST_VISITED);
        
        $totalRecords = $this->rel_agenda_m->get_count($where);
        
        //set filtered if any
        if ($search && $search['value']){
            $this->db->like('client_name', $search['value']);
        }
        //get filtered count
        $totalFiltered = $this->rel_agenda_m->get_count($where);
        
        $result = array('draw' => $draw, 'start'=>$start, 'recordsTotal'=>$totalRecords, 'recordsFiltered'=>$totalFiltered, 'items'=>array());

        if ($totalRecords > 0){
            
            //set filtered if any
            if ($search && $search['value']){
                $this->db->like('client_name', $search['value']);
            }
            //apply offset and limit of data
            $this->db->order_by($order_by,$order_dir);
            $this->db->offset($start)->limit($length);
            
            $query_result = $this->rel_agenda_m->get_by($where);
            if ($query_result){
                foreach ($query_result as $item){
                    $item->status_label = status_agenda($item->agenda_status);
                    $result['items'][] = $item;
                }
            }
        }
        $this->response($result);
    }
    
    public function datatable_missed_get(){
        $this->load->model(array('rel_agenda_m'));
        
        $userid = $this->get('userid');
        
        $draw = $this->get('draw');
        $length = $this->get('length');
        $start = $this->get('start');
        $order_arr = $this->get('order');
        $columns_arr = $this->get('columns');
        $search = $this->get('search') ? $this->get('search') : NULL;
        
        //get order by and direction from the order & columns array
        $order_by = $columns_arr[$order_arr[0]['column']]['data'];
        $order_dir = $order_arr[0]['dir']; 
        
        $where = array('agenda_status'=>AGENDA_ST_APPROVE, 'plan_visit <'=>date('Y-m-d'));
        
        $totalRecords = $this->rel_agenda_m->get_count($where);
        
        //set filtered if any
        if ($search && $search['value']){
            $this->db->like('client_name', $search['value']);
        }
        //get filtered count
        $totalFiltered = $this->rel_agenda_m->get_count($where);
        
        $result = array('draw' => $draw, 'start'=>$start, 'recordsTotal'=>$totalRecords, 'recordsFiltered'=>$totalFiltered, 'items'=>array());

        if ($totalRecords > 0){
            
            //set filtered if any
            if ($search && $search['value']){
                $this->db->like('client_name', $search['value']);
            }
            //apply offset and limit of data
            $this->db->order_by($order_by,$order_dir);
            $this->db->offset($start)->limit($length);
            
            $query_result = $this->rel_agenda_m->get_by($where);
            if ($query_result){
                foreach ($query_result as $item){
                    $item->status_label = status_agenda($item->agenda_status);
                    $result['items'][] = $item;
                }
            }
        }
        $this->response($result);
    }
    
    public function get_get($id){
        $this->load->model(array('rel_agenda_m'));
        $result = array('status'=>FALSE);
        
        $item = $this->rel_agenda_m->get($id);
        if ($item){
            $result['status'] = TRUE;
            $result['item'] = $item;
        }else{
            $result['message'] = 'Data agenda dengan ID:'.$id.' tidak ditemukan';
        }
        $this->response($result);
    }
    
    public function execute_post(){
        $this->load->model(array('rel_agenda_m','rel_history_m'));
        $result = array('status'=>FALSE);
        
        $agenda_id = $this->post('id');
        $date_visited = $this->post('date_visited');
        $report = $this->post('report');
        
        $agenda_status = $report ? AGENDA_ST_REPORTED : AGENDA_ST_VISITED;
        
        $executed = array(
            'date_visited'  => $date_visited,
            'report'        => $report,
            'agenda_status' => $agenda_status
        );
        
        if ($this->rel_agenda_m->save($executed, $agenda_id)){
            //update status history
            $this->rel_history_m->save(array('agenda'=>$agenda_id,'status'=>$agenda_status, 'change_date'=>date('Y-m-d H:i:s')));
            $result['status'] = TRUE;
        }else{
            $result['message'] = $this->rel_agenda_m->get_last_message();
        }
        $this->response($result);
    }
    
    public function save_post(){
        $this->load->model(array('rel_agenda_m','rel_history_m'));
        $result = array('status'=>FALSE);
        
        $created_by = $this->post('created_by');
        $userid = $this->post('userid');
        $client_name = $this->post('client_name');
        $client_id = $this->post('client_id');
        $plan_visit = $this->post('plan_visit');
        $visit_reason = $this->post('visit_reason');
        
        $update = array(
            'userid'            => $userid,
            'client_name'       => $client_name,
            'client_id'         => $client_id,
            'plan_visit'        => $plan_visit,
            'visit_reason'      => $visit_reason
        );
        
        //update history
        $update_history = FALSE;
        if (!$this->post('id')){
            $update['created'] = time();
            $update['created_by'] = $created_by;
            $update['agenda_status'] = AGENDA_ST_NEW;
            
            $update_history = TRUE;
        }
        $id = $this->rel_agenda_m->save($update, $this->post('id'));
        if ($id){
            $result['status'] = TRUE;
            
            if ($update_history){
                //update history status
                $this->rel_history_m->save(array(
                    'agenda'        => $id,
                    'status'        => AGENDA_ST_NEW,
                    'change_date'   => date('Y-m-d')
                ));
            }
        }else{
            $result['message'] = $this->rel_agenda_m->get_last_message();
        }
        
        $this->response($result);
    }
    
    public function upload_post(){
        $this->load->model(array('rel_agenda_m','rel_doc_m'));
        $result = array('status' => FALSE);
        
        $agenda = $this->post('agenda');
        $created_by = $this->post('created_by');
        $file_title = $this->post('file_title');
        
        $upload_path = config_item('agenda_doc_path');
        
        $config['upload_path'] = $upload_path;
        $config['allowed_types'] = 'jpg|png|doc|docx|xls|xlsx|ppt|pptx|pdf';
        $config['max_size'] = 2000;
        
        if (!file_exists($upload_path)){
            mkdir($upload_path, 0777, TRUE);
        }

        $this->load->library('upload', $config);
        
        if (!$this->upload->do_upload('userfile')) {
            $result['message'] = $this->upload->display_errors();
        } else {
            $upload = $this->upload->data();
            $this->rel_doc_m->save(array(
                'agenda'        => $agenda,
                'file_title'    => $file_title ? $file_title : $upload['orig_name'],
                'file_name'     => $upload['file_name'],
                'file_url'      => $upload['full_path'],
                'file_ext'      => $upload['file_ext'],
                'created'       => date('Y-m-d H:i:s'),
                'created_by'    => $created_by
            ));
            $result['status'] = TRUE;
            $result['data'] = $upload;
            $result['agendaId'] = $agenda;
            
            //update doc count
            $this->rel_agenda_m->inc_doc_count($agenda);
        }
        
        $this->response($result);
    }
    
    public function uploads_get($agendaId){
        $this->load->model(array('rel_doc_m'));
        $result = array();
        
        $uploads = $this->rel_doc_m->get_by(array('agenda'=>$agendaId));
        if ($uploads){
            $result['items'] = $uploads;
            $result['item_count'] = count($uploads);
        }else{
            $result['item_count'] = 0;
        }
        
        $this->response($result);
        
    }
    
    public function upload_get($uploadId){
        $this->load->model(array('rel_doc_m'));
        $result = array('status'=>FALSE);
        
        $upload = $this->rel_doc_m->get($uploadId);
        if ($upload){
            $upload->file_url_encoded = urlencode(base64_encode($upload->file_url));
            $result['status'] = TRUE;
            $result['item'] = $upload;
        }else{
            $result['message'] = 'Data upload dengan ID:'.$uploadId.' tidak ditemukan.';
        }
        
        $this->response($result);
        
    }
    
    public function upload_delete($uploadId){
        $this->load->model(array('rel_doc_m','rel_agenda_m'));
        $result = array();
        
        $upload = $this->rel_doc_m->get($uploadId);
        
        if ($upload && $this->rel_doc_m->delete($uploadId)){
            $result['status'] = TRUE;
            
            if (file_exists($upload->file_url)){
                if (!unlink($upload->file_url)){
                    $result['message'] = 'Gagal menghapus file '. $upload->file_name;
                }
            }else{
                $result['message'] = 'File '. $upload->file_name.' tidak ditemukan.';
            }
            
            $this->rel_agenda_m->dec_doc_count($upload->agenda);
        }else{
            $result['message'] = 'Maaf. Data file tidak dapat ditemukan.';
        }
        $this->response($result);
    }
    
    public function client_post(){
        $this->load->model(array('rel_agenda_m','auth_user_m'));
        $result = array('status'=>FALSE);
        
        $client_id = $this->post('client_id');
        
        $agendas = $this->rel_agenda_m->get_by(array('client_id'=>$client_id));
        if ($agendas){
            $result['status'] = TRUE;
            $result['items'] = array();
            foreach ($agendas as $agenda){
                $agenda->agenda_status_label = status_agenda($agenda->agenda_status);
                $agenda->broker = $this->auth_user_m->get($agenda->userid);
                $result['items'][] = $agenda;
            }
        }else{
            $result['message'] = 'Tidak ada agenda untuk Client ini';
        }
        
        $this->response($result);
    }
    
    public function calendar_get(){
        $this->load->model(array('rel_agenda_m'));
        $result = array('status'=>FALSE);
        
        //$userid = $this->get('userid');
        $start_date = date('Y-m-d', $this->get('start_date'));
        $end_date = date('Y-m-d', $this->get('end_date'));
        
        $agendas = $this->rel_agenda_m->get_select_where('id,client_name,plan_visit,visit_reason,agenda_status', array('plan_visit >='=>$start_date, 'plan_visit <='=>$end_date));
        if ($agendas){
            $result['status'] = TRUE;
            $result['events'] = array();
            $today = time();
            foreach ($agendas as $agenda){
                
                if ($agenda->agenda_status <= AGENDA_ST_APPROVE){
                    if (strtotime($agenda->plan_visit) < time()){
                        $agenda->category = 'missed';
                    }else{
                        $agenda->category = 'toexecute';
                    }
                }else if ($agenda->agenda_status >= AGENDA_ST_VISITED){
                    $agenda->category = 'done';
                }else{
                    $agenda->category = 'missed';
                }
                $result['events'][] = $agenda;
            }
        }else{
            $result['message'] = 'Tidak ada data event di rentang waktu kalendar '.$start_date. ' s/d '. $end_date;
        }
        
        $this->response($result);
    }
    
    public function delete_delete($agendId){
        $this->load->model(array('rel_agenda_m','rel_doc_m','auth_user_m','rel_history_m','rel_person_m','rel_pic_m','rel_client_m'));
        $result = array('status'=>FALSE);
        
        if ($this->_delete_agenda_complete($agendaId, $result['message'])){
            $result['status'] = TRUE;
        }
        
        $this->response($result);
    }
    
    public function deletes_delete(){
        $this->load->model(array('rel_agenda_m','rel_doc_m','auth_user_m','rel_history_m','rel_person_m','rel_pic_m','rel_client_m'));
        $result = array('status'=>FALSE);
        
        //$ids = 
        
        if ($this->_delete_agenda_complete($agendaId, $result['message'])){
            $result['status'] = TRUE;
        }
        
        $this->response($result);
    }
    
    private function _delete_agenda_complete($agendaId, &$message=NULL){
        $this->load->model(array('rel_agenda_m','rel_doc_m','auth_user_m','rel_history_m','rel_person_m','rel_pic_m','rel_client_m'));
        
        $agenda = $this->rel_agenda_m->get($agendId);
        if (!$agenda){
            $message = 'Data agenda dengan ID:'.$agendId.' tidak dapat ditemukan';
            
            return FALSE;
        }else{
            if ($this->rel_agenda_m->delete($agendId)){
                $result['status'] = TRUE;
                $result['item'] = $agenda;
                
                //delete documen
                $docs = $this->rel_doc_m->get_by(array('agenda'=>$agendId));
                if ($docs){
                    foreach ($docs as $doc){
                        if (file_exists($doc->file_url)){
                            unlink($doc->file_url);
                        }
                        $this->rel_doc_m->delete($doc->id);
                    }
                }
                
                //delete history
                $this->rel_history_m->delete_where(array('agenda'=>$agendId));
                
                //delete person visited
                $this->rel_person_m->delete_where(array('agenda'=>$agendId));
            }else{
                $message = $this->rel_agenda_m->get_last_message();
                
                return FALSE;
            }
        }
        
        return TRUE;
    }
    
    public function info_get($id){
        $this->load->model(array('rel_agenda_m','rel_doc_m','auth_user_m','rel_history_m','rel_person_m','rel_pic_m','rel_client_m'));
        $result = array('status'=>FALSE);
        
        $agenda = $this->rel_agenda_m->get($id);
        if (!$agenda){
            $result['message'] = 'Data agenda dengan ID:'.$id.' tidak ditemukan.';
        }else{
            $result['status'] = TRUE;
            //Load client detail
            $agenda->client = $this->rel_client_m->get($agenda->client_id);
            //load status history
            $agenda->history = $this->rel_history_m->get_by(array('agenda'=>$agenda->id));
            //load dokumen pendukung
            if ($agenda->doc_count > 0){
                $agenda->docs = $this->rel_doc_m->get_by(array('agenda'=>$agenda->id));
            }else{
                $agenda->docs = array();
            }
            //load broker detail
            $agenda->broker = $this->auth_user_m->get($agenda->userid);
            
            //Load person met on visit
            $agenda->persons = $this->rel_person_m->get_by(array('agenda'=>$agenda->id));
            if ($agenda->persons){
                for ($i=0; $i<count($agenda->persons); $i++){
                    $person = $agenda->persons[$i];
                    $person->person = $this->rel_pic_m->get($person->person);
                    $agenda->persons[$i] = $person;
                }
            }
            
            //draw agenda information
            $result['info'] = $this->_draw_info($agenda);
        }
        $this->response($result);
    }
    
    private function _draw_info($agenda){
        $result = array();
        $result[]= '<table class="table table-bordered"><thead>';
        $result[]= '<tbody>';
        $result[]= '<tr><td class="active" style="width:150px;">Agenda ID</td><td>'.  str_pad($agenda->id, 11, '0', STR_PAD_LEFT).'</td></tr>';
        $result[]= '<tr><td class="active">Tanggal</td><td>'.date('D, d-M-Y', strtotime($agenda->plan_visit)).'</td></tr>';
        $result[]= '<tr><td class="active">Nama Klien</td><td>'.$agenda->client_name.'</td></tr>';
        $result[]= '<tr><td class="active">Captive BRI</td><td>'.($agenda->client && $agenda->client->captive==1?'YA':'TIDAK').'</td></tr>';
        $result[]= '<tr><td class="active">Nama Broker</td><td>'.($agenda->broker ? $agenda->broker->nama:'').'</td></tr>';
        $result[]= '<tr><td class="active">Alasan Kunjungan</td><td>'.$agenda->visit_reason.'</td></tr>';
        $result[]= '<tr><td class="active">Status Agenda</td><td>'.  status_agenda($agenda->agenda_status).'</td></tr>';
        $result[]= '</tbody>';
        $result[]= '</table>';
        
        $result[]= '<table class="table table-bordered"><thead>';
        $result[]= '<tbody>';
        //Report kunjungan
        $result[]= '<tr><th class="active">Laporan Kunjungan</th></tr>';
        $result[]= '<tr><td><article style="min-height:100px;">'.$agenda->report.'</article></td></tr>';
        //Catatan laporan kunjungan
        $result[]= '<tr><th class="active">Catatan Supervisor</th></tr>';
        $result[]= '<tr><td><article style="min-height:50px;">'.$agenda->report_note.'</article></td></tr>';
        
        //Dokumentasi yang sudah diupload
        $result[]= '<table class="table table-bordered table-hover"><thead>';
        $result[]= '<tbody>';
        $result[]= '<tr><th class="active" colspan="2">Dokumentasi</th></tr>';
        if ($agenda->docs && count($agenda->docs)){
            foreach ($agenda->docs as $doc){
                $result[]='<tr>';
                $result[]='<td>'.$doc->file_title.'</td>';
                $result[]='<td class="text-center" style="width:120px;">';
                $result[]='<button type="button" class="btn btn-xs btn-file-open" data-file-id="'.$doc->id.'" title="Open file"><span class="fa fa-eye"></span></button>';
                $result[]='<button type="button" class="btn btn-xs btn-file-download" data-file-id="'.$doc->id.'" title="Download file"><span class="fa fa-download"></span></button>';
                $result[]='</td>';
                $result[]='</tr>';
            }
        }
        $result[]= '</tbody>';
        $result[]= '</table>';
        
        //Agenda history status
        $result[]= '<table class="table table-bordered"><thead>';
        $result[]= '<tbody>';
        //Report kunjungan
        $result[]= '<tr><th class="active">Histori Status Agenda</th></tr>';
        $result[]= '<tr><td><article style="min-height:50px;">';
        if ($agenda->history && count($agenda->history)){
            $result[] = '<ul>';
            foreach($agenda->history as $history){
                $result[]='<li>'.  date('D, d-M-Y H:i', strtotime($history->change_date)).' '.  status_agenda($history->status).'</li>';
            }
            $result[] = '</ul>';
        }
        $result[]= '</article></td></tr>';
        
        return implode('', $result);
    }
}

/**
 * Filename : Agenda.php
 * Location : application/controllers/services/Agenda.php
 */
