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

	function viewdata(){
		if($this->session->userdata('login') == TRUE and ($this->session->userdata('level')!='User' or $this->session->userdata('level')!='Entry')){

			$data['title'] = $this->title;
			$data['main_view'] = 'rpentry_view';
			$data['form_action'] = site_url('rpaset');
			

			
				$tmpl = array('table_open' => '<table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#ffffff">',
						'row_alt_start' => '<tr class="zebra">','row_alt_end' => '</tr>');

				$this->table->set_template($tmpl);
				$this->table->set_empty("&nbsp;");
				$cellJumlah = array('data' => 'Jumlah', 'width' => '10%');
				$this->table->set_heading('No.','Petugas Entry Data',$cellJumlah);

				$i = 0 ;
				$asets = $this->Aset_model->getRekapEntry();
				foreach($asets as $row){
					$cellJumlah = array('data' => $row->jumlah, 'style' => 'text-align: right');
					$this->table->add_row(++$i,$row->createdBy,$cellJumlah);
				}
				
				$data['table'] = $this->table->generate();
			

			$this->load->view('theme',$data);
		}else{
			redirect('home');
		}

	}

	
	function printDataHere(){
		$PDFame = "AsetNU-";
		$kondisi ="";
		if (strlen($this->input->get("propinsi"))>0)
		{
			$kondisi .=" ".$this->input->get("propinsi");
		}
		if (strlen($this->input->get("kota"))>0)
		{
			$kondisi .=" ".$this->input->get("kota");
			$PDFame .= str_replace(" ","_",
					$this->Kota_model->getNamaKotaByKotaID($this->input->get("kota")))."-";
		}
		if (strlen($this->input->get("kecamatan"))>0)
		{
			$kondisi .=" ".$this->input->get("kecamatan");
			$PDFame .= str_replace(" ","_",
					$this->Kecamatan_model->getNamaKecamatanByKecamatanID($this->input->get("kecamatan")))."-";
		}
		$PDFame.=date('Ymd-Hi');
		$java = "java -jar ".$this->config->config['directoryJarReport']
		."reportNU.jar cetak "
				.$this->config->config['directoryJarReport']." "
						.$this->config->config['directoryPDFReport']." newaasetLaporan ".$PDFame.$kondisi;
		
		
		exec ($java);
	}


	function createpdf(){
		//(06:51:40 AM) Garuda Edwio: AsetNU-Kab.Blitar-Kec.Kademangan-20130212-0651
		//(06:52:52 AM) Garuda Edwio: AsetNU-NamaKabupaten-NamaKecamatan-YYYYMMDD-HHMM
		//(07:12:55 AM) Garuda Edwio: format 24 jam
		$PDFame = "AsetNU-";
		$kondisi ="";
		if (strlen($this->input->get("propinsi"))>0)
		{
			$kondisi .=" ".$this->input->get("propinsi");
		}
		if (strlen($this->input->get("kota"))>0)
		{
			$kondisi .=" ".$this->input->get("kota");
			$PDFame .= str_replace(" ","_",
					$this->Kota_model->getNamaKotaByKotaID($this->input->get("kota")))."-";
		}
		if (strlen($this->input->get("kecamatan"))>0)
		{
			$kondisi .=" ".$this->input->get("kecamatan");
			$PDFame .= str_replace(" ","_",
					$this->Kecamatan_model->getNamaKecamatanByKecamatanID($this->input->get("kecamatan")))."-";
		}
		$PDFame.=date('Ymd-Hi');
		$java = "java -jar ".$this->config->config['directoryJarReport']
		."reportNU.jar pdf "
				.$this->config->config['directoryJarReport']." "
						.$this->config->config['directoryPDFReport']." newaasetLaporan ".$PDFame.$kondisi;

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
