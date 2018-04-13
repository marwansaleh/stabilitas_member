<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Member extends Admin_Controller {

    public function register()
    {
        $this->load->model(array('ref_agama_m','ref_event_m','ref_pendidikan_m','ref_training_m'));
        $this->data['page_title'] = 'Member';
        $this->data['page_subtitle'] = 'Register member';
        
        $this->data['religion'] = $this->ref_agama_m->get();
        $this->data['events'] = $this->ref_event_m->get();
        $this->data['educations'] = $this->ref_pendidikan_m->get();
        $this->data['trainings'] = $this->ref_training_m->get();
        
        //set breadcumb
        breadcumb_add($this->data['breadcumb'], '<i class="fa fa-home"></i> Home', get_action_url('dashboard'));
        breadcumb_add($this->data['breadcumb'], 'Member', get_action_url('member/register'));
        breadcumb_add($this->data['breadcumb'], 'Register', get_action_url('member/register'), TRUE);
        
        $this->data['subview'] = 'member/register/index';
        $this->load->view('_layout_main', $this->data);
    }
    
    public function export() {
        $this->load->model(array('rel_member_m'));
        
        //get all data
        $data = $this->rel_member_m->get();
        
        $headers = array();
        $fields = $this->db->list_fields($this->rel_member_m->get_tablename());
        foreach ($fields as $field)
        {
            $headers[] = $field;
        }
        
        $fp = fopen('php://output', 'w');
        if ($fp && $data) {
            header('Content-Type: text/csv');
            header('Content-Disposition: attachment; filename="export.csv"');
            header('Pragma: no-cache');
            header('Expires: 0');
            fputcsv($fp, $headers);
            foreach ($data as $row){
                $item = array();
                foreach ($fields as $field){
                    $item[]=$row->$field;
                }
                fputcsv($fp, $item);
            }
        }
        fclose($fp);
    }
}

/*
 * Filename: Member.php
 * Location: application/controllers/Member.php
 */