<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of rptentry
 *
 * @author domas
 */
class Rptentry extends CI_Controller{
    //put your code here
    function  Rptentry(){
        parent::__construct();
        $this->load->model('Aset_model','',TRUE);
        $this->load->model('User_model','',TRUE);
    }
    
    var $title = 'Rekapitulasi Entry Aset Per User';
    
    function index(){
        if($this->session->userdata('login') == TRUE and ($this->session->userdata('level')!='User' or $this->session->userdata('level')!='Entry')){
            
        $data['title'] = $this->title;
        //$data['h2_title'] = 'Input Aset';
        $data['main_view'] = 'entry';
        $data['form_action'] = site_url('rptentry/search');
        
        $this->load->view('theme',$data);
        }else{
            redirect('home');
        }
        
    }
    
    function search(){
        $data['title'] = $this->title;
        $data['h2_title'] = 'Rekapitulasi Entry Data Aset';
        $data['main_view'] = 'view_report';
        $bulan = $this->input->post('bulan');
        $tahun = $this->input->post('tahun');
        $tmpl = array('table_open' => '<table border="0" cellpadding="0" cellspacing="0" bgcolor="#ffffff">',
                'row_alt_start' => '<tr class="zebra">','row_alt_end' => '</tr>');
        
        $this->table->set_template($tmpl);
        $this->table->set_empty("&nbsp;");
        $this->table->set_heading('No.','Tgl. Entry','User','Jumlah');
        $i = 0;
        
        $entries = $this->Aset_model->rekapEntry($bulan,$tahun);
        foreach($entries as $entry){
            $this->table->add_row(++$i,$entry->created,$entry->createdBy,$entry->jumlah);
        }
        $data['table'] = $this->table->generate();
        $this->load->view('theme',$data);
    }
}

?>
