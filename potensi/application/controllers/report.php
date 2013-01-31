<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of report
 *
 * @author domas
 */
class Report extends CI_Controller{
    //put your code here
    
    function Report(){
        parent::__construct();
        $this->load->model('Aset_model','',TRUE);
        $this->load->model('Propinsi_model','',TRUE);
        $this->load->model('Kota_model','',TRUE);
        $this->load->model('Kecamatan_model','',TRUE);
        $this->load->model('Kelurahan_model','',TRUE);
        $this->load->model('Report_model','',TRUE);
        $this->load->model('Golongan_model','',TRUE);
        $this->load->model('Jenis_model','',TRUE);
    }
    
    var $title = 'Rekapitulasi Entry Aset';
    var $limit = 20;
    var $hasil;
    
    function index(){
        if($this->session->userdata('login') == TRUE and ($this->session->userdata('level')!='User' or $this->session->userdata('level')!='Entry')){
            
        $data['title'] = $this->title;
        //$data['h2_title'] = 'Input Aset';
        $data['main_view'] = 'report';
        $data['form_action'] = site_url('report/search');
        
        //$data['pilihkota'] = $this->Kota_model->getKota();
        $this->load->view('theme',$data);
        }else{
            redirect('home');
        }
        
    }
    
    function search(){
        
        $propID = $this->input->post('propinsi');
        $kotaID = $this->input->post('kota');
        $kecID = $this->input->post('kecamatan');
        $kelID = $this->input->post('kelurahan');
        $ranting = $this->input->post('ranting');
        
        $search = array('propinsi'=>$propID,'kota'=>$kotaID,'kecamatan'=>$kecID,
            'kelurahan'=>$kelID,'ranting'=>$ranting);
        $this->Report_model->update(1,$search);
        $this->show();
    }
    
    function show(){
        $data['title'] = $this->title;
        $data['h2_title'] = 'Rekapitulasi Entry Data Aset';
        $data['main_view'] = 'view_report';
        $tmpl = array('table_open' => '<table border="0" cellpadding="0" cellspacing="0" bgcolor="#ffffff">',
                'row_alt_start' => '<tr class="zebra">','row_alt_end' => '</tr>');
        
        $this->table->set_template($tmpl);
        $this->table->set_empty("&nbsp;");
        $this->table->set_heading('No.','Golongan','Jenis Obyek','Kode','Jumlah');
        $i = 0;
        
        $golongan = $this->Golongan_model->getGolongan();
        foreach($golongan as $gol){
            $kodeGol = $gol->id;
            $namaGol = $gol->golongan;
            
            $klasifikasi = $this->Jenis_model->getJenisByCat($kodeGol)->result();
            foreach ($klasifikasi as $jenis){
                $kodeJenis = $jenis->kode_klasifikasi;
                $namaJenis = $jenis->jenis;
                
                $row = $this->Report_model->getLastByID(1)->row();
        
                $propinsiID = $row->propinsi;
                $kotaID = $row->kota;
                $kecamatanID = $row->kecamatan;
                $kelurahanID = $row->kelurahan;
                $ranting = $row->ranting;

                if(!empty($propinsiID)){
                    if(!empty($kotaID)){
                        if(!empty($kecamatanID)){
                            if(!empty($kelurahanID)){
                                $rec = $this->Report_model->countRowByKelurahan($kelurahanID,$ranting,$kodeJenis);
                            }else{
                                $rec = $this->Report_model->countRowByKecamatan($kecamatanID,$kodeJenis);
                            }
                        }else{
                            $rec = $this->Report_model->countRowByKota($kotaID,$kodeJenis);
                        }
                    }else{
                        $rec = $this->Report_model->countRowByPropinsi($propinsiID,$kodeJenis);
                    }
                }else{
                    $rec = $this->Report_model->countRow($kodeJenis);
                }
                
                $this->table->add_row(++$i,$namaGol,
                                $namaJenis,
                                $kodeJenis,
                                $rec);
            }
        }
        $data['table'] = $this->table->generate();
        $this->load->view('theme',$data);
    }
    
    function topdf () {
		$this->load->library('cezpdf');
		$this->load->helper('pdf');
		prep_pdf();
                
                $row = $this->Report_model->getLastByID(1)->row();
        //foreach ($parameter as $row){
            $propinsiID = $row->propinsi;
            $kotaID = $row->kota;
            $kecamatanID = $row->kecamatan;
            $kelurahanID = $row->kelurahan;
            $ranting = $row->ranting;
            
            if(!empty($propinsiID)){
            if(!empty($kotaID)){
                if(!empty($kecamatanID)){
                    if(!empty($kelurahanID)){
                        //echo $kelurahanID;
                        $asets = $this->Report_model->getAllByKelurahan($kelurahanID,$ranting);
                    }else{
                        $asets = $this->Report_model->getAllByKecamatan($kecamatanID,$ranting);
                    }
                }else{
                    $asets = $this->Report_model->getAllByKota($kotaID,$ranting);
                }
            }else{
                $asets = $this->Report_model->getAllByPropinsi($propinsiID,$ranting);
            }
        }else{
            $asets = $this->Report_model->getAllAset($ranting);
            
        }
            
		$data['report']= $asets;
		$titlecolumn = array(
                    'no' => 'no',
                    'name' => 'name',
                    'address' => 'address'
		);
		$this->cezpdf->ezTable($data['report'], $titlecolumn,'Rekap Entry Data');
		$this->cezpdf->ezStream();
	}
}

?>
