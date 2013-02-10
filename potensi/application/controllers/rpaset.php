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
class rpaset extends CI_Controller{
    //put your code here
    
    function rpaset(){
        parent::__construct();
        $this->load->model('Aset_model','',TRUE);
        $this->load->model('Propinsi_model','',TRUE);
        $this->load->model('Kota_model','',TRUE);
        $this->load->model('Kecamatan_model','',TRUE);
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
        $data['main_view'] = 'rpaset';
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
        $ranting = $this->input->post('ranting');
        
        $search = array('propinsi'=>$propID,'kota'=>$kotaID,'kecamatan'=>$kecID,
            'ranting'=>$ranting);
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
                $ranting = $row->ranting;

                if(!empty($propinsiID)){
                    if(!empty($kotaID)){
                        if(!empty($kecamatanID)){
                                $rec = $this->Report_model->countRowByKecamatan($kecamatanID,$kodeJenis);
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
            $ranting = $row->ranting;
            
            if(!empty($propinsiID)){
            if(!empty($kotaID)){
                if(!empty($kecamatanID)){
                        $asets = $this->Report_model->getAllByKecamatan($kecamatanID,$ranting);
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
	
	function createpdf(){
		$genrateMD5 = md5($this->session->userdata['username']);
		if (strlen($genrateMD5)>4)
			$genrateMD5 = substr($genrateMD5,0,4);
		$PDFame = "newAset_".date('dmY_His')."_".$genrateMD5;
		$java = "java -jar ".$this->config->config['directoryJarReport']
		."reportNU.jar pdf "
				.$this->config->config['directoryJarReport']." "
						.$this->config->config['directoryPDFReport']." newaasetLaporan ".$PDFame;
		$kondisi ="";
		if (strlen($this->input->get("propinsi"))>0)
		{
			$kondisi .=" ".$this->input->get("propinsi");
		}
		if (strlen($this->input->get("kota"))>0)
		{
			$kondisi .=" ".$this->input->get("kota");
		}
		if (strlen($this->input->get("kecamatan"))>0)
		{
			$kondisi .=" ".$this->input->get("kecamatan");
		}
		$java .=$kondisi;
		$path=$this->config->config['directoryPDFReport'];
		
		$handle=opendir($path);		
		$dateNOW = date("dmY");
		while (($file = readdir($handle))!==false) {
			$truFILe = $path.$file;
			$filesDAte = substr($file,8,8);
			if (strcmp($dateNOW,$filesDAte)!=0&&
					strcmp($file,".")!=0&&
					strcmp($file,"..")!=0
			) {
				unlink($truFILe);
			}
		}
		closedir($handle);
		exec ($java);
		header('Content-type: application/pdf');
		$ResultPDF = $this->config->config['directoryPDFReport'].$PDFame.".pdf";
		header("Content-Disposition:attachment;filename=".$PDFame.".pdf");
		readfile($ResultPDF);
	}
}

?>
