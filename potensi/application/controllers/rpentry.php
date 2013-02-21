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
class rpentry extends CI_Controller{
	//put your code here

	function rpentry(){
		parent::__construct();
		$this->load->model('Aset_model','',TRUE);
		$this->load->model('Propinsi_model','',TRUE);
		$this->load->model('Kota_model','',TRUE);
		$this->load->model('Kecamatan_model','',TRUE);
		$this->load->model('Report_model','',TRUE);
		$this->load->model('Golongan_model','',TRUE);
		$this->load->model('Jenis_model','',TRUE);
		$this->load->model('Kelurahan_model','',TRUE);
	}

	var $title = 'Rekapitulasi Entry Aset';
	var $limit = 20;
	var $hasil;
	function index(){
		$this->viewdata();
	}
	
	function detail(){
		if($this->session->userdata('login') == TRUE and ($this->session->userdata('level')!='User' or $this->session->userdata('level')!='Entry')){
		
			$data['title'] = $this->title;
			$data['main_view'] = 'rpentry_view';
			$perSonName = urldecode($this->uri->segment(3));
			$data['idPerson'] = $perSonName;
			$data['jenisReport'] = 'person';
			$data['person'] = anchor('rpentry',$perSonName);
			$data['linkExport'] = site_url("rpentry");
			$data['total'] = number_format($this->Aset_model->getCountRekapEntrybyCreatedBY($perSonName),0,",",".");
			
			if ($this->Aset_model->getCountRekapEntry()>0) {
		
				$tmpl = array('table_open' => '<table border="0" cellpadding="0" cellspacing="0" bgcolor="#ffffff">',
						'row_alt_start' => '<tr class="zebra">','row_alt_end' => '</tr>');
		
				$this->table->set_template($tmpl);
				$this->table->set_empty("&nbsp;");
				$cellJumlah = array('data' => 'Jumlah', 'width' => '10%');
				$this->table->set_heading('No.','Tanggal',$cellJumlah);
		
				$i = 0 ;
				$asets = $this->Aset_model->getRekapEntryEveryDatedependONCreatedBY($perSonName);
				$totalAmount = 0;
				foreach($asets as $row){
					$cellNomor = array('data' => ++$i, 'style' => 'text-align: right', 'width' => '5%' );
					$cellJumlah = array('data' => number_format($row->jumlah,0,",","."), 'style' => 'text-align: right');
					$this->table->add_row($cellNomor,$row->created,$cellJumlah);
					$totalAmount += $row->jumlah;
				}
				$cellJumlah = array('data' => number_format($totalAmount,0,",","."), 'colspan' => 3 ,'style' => 'text-align: right');
				$this->table->add_row($cellJumlah);
		
				$data['table'] = $this->table->generate();
			} else {
				$data['message'] = 'Tidak ada data yang ditampilkan!';
			}
		
			$this->load->view('theme',$data);
		}else{
			redirect('home');
		}
	}

	function viewdata(){
		if($this->session->userdata('login') == TRUE and ($this->session->userdata('level')!='User' or $this->session->userdata('level')!='Entry')){

			$data['title'] = $this->title;
			$data['main_view'] = 'rpentry_view';
			$data['jenisReport'] = '1';
			$data['idPerson'] = '';
			
			
			if ($this->Aset_model->getCountRekapEntry()>0) {
				
				$tmpl = array('table_open' => '<table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#ffffff">',
						'row_alt_start' => '<tr class="zebra">','row_alt_end' => '</tr>');

				$this->table->set_template($tmpl);
				$this->table->set_empty("&nbsp;");
				$cellJumlah = array('data' => 'Jumlah', 'width' => '10%');
				$this->table->set_heading('No.','Petugas Entry Data',$cellJumlah);

				$i = 0 ;
				$asets = $this->Aset_model->getRekapEntry();
				foreach($asets as $row){
					$cellNomor = array('data' => ++$i, 'style' => 'text-align: right', 'width' => '5%' );
					$cellJumlah = array('data' => number_format($row->jumlah,0,",","."), 'style' => 'text-align: right');
					$this->table->add_row($cellNomor,anchor('rpentry/detail/'.$row->createdBy,$row->createdBy),$cellJumlah);
				}
				
				$data['table'] = $this->table->generate();
			} else {
				$data['message'] = 'Tidak ada data yang ditampilkan!';
			}

			$this->load->view('theme',$data);
		}else{
			redirect('home');
		}

	}

	function createpdf(){
		$jenis = $this->input->get("jenis");
		$PDFame="";
		if (strcmp($jenis,"1")==0) {
			$PDFame = "rekapentry_".date('Ymd-Hi');
			$java = "java -jar ".$this->config->config['directoryJarReport']
			."reportNU.jar pdf "
					.$this->config->config['directoryJarReport']." "
							.$this->config->config['directoryPDFReport']." rekapEntry ".$PDFame;
		} else if (strcmp($jenis,"person")==0) {
			$person = urldecode($this->input->get("id"));
			$Total = number_format($this->Aset_model->getCountRekapEntrybyCreatedBY($person),0,",",".");
			
			$PDFame = "rincianEntry_".str_replace(" ","_",$person)."_".date('Ymd-Hi');
			$java = "java -jar ".$this->config->config['directoryJarReport']
			."reportNU.jar pdf "
					.$this->config->config['directoryJarReport']." "
							.$this->config->config['directoryPDFReport']." rekapEntryPerson ".$PDFame." ".$Total." ".$person;
		}
		
		
		$path=$this->config->config['directoryPDFReport'];
		$handle=opendir($path);
		$dateNOW = date("Ymd");
		while (($file = readdir($handle))!==false) {
			$truFILe = $path.$file;
			$filesDAte = substr($file,(strlen($file)-17),8);
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
