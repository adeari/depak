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
class rpjo extends CI_Controller{
	//put your code here

	function rpjo(){
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
	
	function perKabupatenrinci(){
		if($this->session->userdata('login') == TRUE and ($this->session->userdata('level')!='User' or $this->session->userdata('level')!='Entry')){
			$kabupatenID = $this->uri->segment(3);
			$data['main_view'] = 'rpjo_view';
			$data['viewPage'] = "rincianKabupaten";
			$data['linkExport'] = site_url("rpjo");
	
			$data['namaKabupaten'] = anchor('rpjo/perKabupaten',$this->Kota_model->getNamaKotaByKotaID($kabupatenID));
			$data['kabupatenID'] = $kabupatenID;
				
			if ($this->Aset_model->getCountRincianKabupaten($kabupatenID)>0)	{
				$tmpl = array('table_open' => '<table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#ffffff">',
						'row_alt_start' => '<tr class="zebra">','row_alt_end' => '</tr>');
				$this->table->set_template($tmpl);
				$this->table->set_empty("&nbsp;");
				$cellJumlah = array('data' => 'Jumlah', 'width' => '10%');
				$this->table->set_heading('No.','Golongan','Jenis Obyek','Kode',$cellJumlah);
				$i = 0 ;
				$asets = $this->Aset_model->getRincianKabupaten($kabupatenID);
				foreach ($asets as $row){
					$cellNomor = array('data' => ++$i, 'style' => 'text-align: right', 'width' => '5%' );
					$cellJumlah = array('data' => number_format($row->jumlah,0,",","."), 'style' => 'text-align: right');
					$this->table->add_row($cellNomor,$row->golongan,$row->jenis,$row->jenis_aset,$cellJumlah);
				}
				$data['table'] = $this->table->generate();
			} else {
				$data['message'] = 'Tidak ada data yang ditampilkan!';
			}
				
				
			$this->load->view('theme',$data);
		}
	}
	
	function perKecamatanrinci(){
		if($this->session->userdata('login') == TRUE and ($this->session->userdata('level')!='User' or $this->session->userdata('level')!='Entry')){
			$kecamaatanID = $this->uri->segment(3);
			$kabupatenID = $this->uri->segment(4);
			$data['main_view'] = 'rpjo_view';
			$data['viewPage'] = "rincianKecamatan";
			$data['linkExport'] = site_url("rpjo");
			
			$data['kecamatanID'] = $kecamaatanID;
	
			$data['namaKecamatan'] = anchor('rpjo/perKecamatan/'.$kabupatenID,$this->Kecamatan_model->getNamaKecamatanByKecamatanID($kecamaatanID));
	
			if ($this->Aset_model->getCountRincianKecamatan($kecamaatanID)>0)	{
				$tmpl = array('table_open' => '<table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#ffffff">',
						'row_alt_start' => '<tr class="zebra">','row_alt_end' => '</tr>');
				$this->table->set_template($tmpl);
				$this->table->set_empty("&nbsp;");
				$cellJumlah = array('data' => 'Jumlah', 'width' => '10%');
				$this->table->set_heading('No.','Golongan','Jenis Obyek','Kode',$cellJumlah);
				$i = 0 ;
				$asets = $this->Aset_model->getRincianKecamatan($kecamaatanID);
				foreach ($asets as $row){
					$cellNomor = array('data' => ++$i, 'style' => 'text-align: right', 'width' => '5%' );
					$cellJumlah = array('data' => number_format($row->jumlah,0,",","."), 'style' => 'text-align: right');
					$this->table->add_row($cellNomor,$row->golongan,$row->jenis,$row->jenis_aset,$cellJumlah);
				}
				$data['table'] = $this->table->generate();
			} else {
				$data['message'] = 'Tidak ada data yang ditampilkan!';
			}
	
	
			$this->load->view('theme',$data);
		}
	}
	
	function perDesarinci(){
		if($this->session->userdata('login') == TRUE and ($this->session->userdata('level')!='User' or $this->session->userdata('level')!='Entry')){
			$desaID = $this->uri->segment(3);
			$data['desaID'] = $desaID;
			$kecamaatanID = $this->uri->segment(4);
			$kebupatenID = $this->uri->segment(5);
			$data['main_view'] = 'rpjo_view';
			$data['viewPage'] = "rincianDesa";
			$data['linkExport'] = site_url("rpjo");
	
			$data['namaDesa'] = anchor('rpjo/perDesa/'.$kecamaatanID."/".$kebupatenID,$this->Kelurahan_model->getNamaKelurahanbyId($desaID));
	
			if ($this->Aset_model->getCountRincianDesa($desaID)>0)	{
				$tmpl = array('table_open' => '<table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#ffffff">',
						'row_alt_start' => '<tr class="zebra">','row_alt_end' => '</tr>');
				$this->table->set_template($tmpl);
				$this->table->set_empty("&nbsp;");
				$cellJumlah = array('data' => 'Jumlah', 'width' => '10%');
				$this->table->set_heading('No.','Golongan','Jenis Obyek','Kode',$cellJumlah);
				$i = 0 ;
				$asets = $this->Aset_model->getRincianDesa($desaID);
				foreach ($asets as $row){
					$cellNomor = array('data' => ++$i, 'style' => 'text-align: right', 'width' => '5%' );
					$cellJumlah = array('data' => number_format($row->jumlah,0,",","."), 'style' => 'text-align: right');
					$this->table->add_row($cellNomor,$row->golongan,$row->jenis,$row->jenis_aset,$cellJumlah);
				}
				$data['table'] = $this->table->generate();
			} else {
				$data['message'] = 'Tidak ada data yang ditampilkan!';
			}
	
	
			$this->load->view('theme',$data);
		}
	}
	
	function perDesa(){
		if($this->session->userdata('login') == TRUE and ($this->session->userdata('level')!='User' or $this->session->userdata('level')!='Entry')){
			$kecamatanID = $this->uri->segment(3);
			$kebupatenID = $this->uri->segment(4);
			$data['main_view'] = 'rpjo_view';
			$data['viewPage'] = "levelDesa";
	
			$data['namaKecamatan'] = anchor('rpjo/perKecamatan/'.$kebupatenID,$this->Kecamatan_model->getNamaKecamatanByKecamatanID($kecamatanID));
			$data['linkExport'] = site_url("rpjo");
			$data['kecamatanID'] = $kecamatanID;
	
			if ($this->Aset_model->getCountlevelDesa($kecamatanID)>0)	{
				$tmpl = array('table_open' => '<table  border="0" cellpadding="0" cellspacing="0" bgcolor="#ffffff">',
						'row_alt_start' => '<tr class="zebra">','row_alt_end' => '</tr>');
				$this->table->set_template($tmpl);
				$this->table->set_empty("&nbsp;");
				$cellJumlah = array('data' => 'Jumlah', 'width' => '10%');
				$this->table->set_heading('No.','Desa / Kelurahan',$cellJumlah,'Rincian');
				$i = 0 ;
				$asets = $this->Aset_model->getlevelDesa($kecamatanID);
				foreach ($asets as $row){
					$cellNomor = array('data' => ++$i, 'style' => 'text-align: right', 'width' => '5%' );
					$cellJumlah = array('data' => number_format($row->jumlah,0,",","."), 'style' => 'text-align: right');
					$this->table->add_row($cellNomor,$row->namaKelurahan,
							$cellJumlah,anchor('rpjo/perDesarinci/'.$row->kelid.'/'.$kecamatanID."/".$kebupatenID,'Rincian'));
				}
				$data['table'] = $this->table->generate();
			} else {
				$data['message'] = 'Tidak ada data yang ditampilkan!';
			}
	
	
			$this->load->view('theme',$data);
		}
	}
	
	function perKecamatan(){
		if($this->session->userdata('login') == TRUE and ($this->session->userdata('level')!='User' or $this->session->userdata('level')!='Entry')){
			$kabupatenID = $this->uri->segment(3);
			$data['kabupatenID'] = $kabupatenID;
			$data['main_view'] = 'rpjo_view';
			$data['viewPage'] = "levelKecamatan";
	
			$data['namaKabupaten'] = anchor('rpjo/perKabupaten',$this->Kota_model->getNamaKotaByKotaID($kabupatenID));
			$data['linkExport'] = site_url("rpjo");
	
			if ($this->Aset_model->getCountlevelKecamatan($kabupatenID)>0)	{
				$tmpl = array('table_open' => '<table  border="0" cellpadding="0" cellspacing="0" bgcolor="#ffffff">',
						'row_alt_start' => '<tr class="zebra">','row_alt_end' => '</tr>');
				$this->table->set_template($tmpl);
				$this->table->set_empty("&nbsp;");
				$cellJumlah = array('data' => 'Jumlah', 'width' => '10%');
				$this->table->set_heading('No.','Kecamatan',$cellJumlah,'Rincian');
				$i = 0 ;
				$asets = $this->Aset_model->getlevelKecamatan($kabupatenID);
				foreach ($asets as $row){
					$cellNomor = array('data' => ++$i, 'style' => 'text-align: right', 'width' => '5%' );
					$cellJumlah = array('data' => number_format($row->jumlah,0,",","."), 'style' => 'text-align: right');
					$this->table->add_row($cellNomor,anchor('rpjo/perDesa/'.$row->kecid."/".$kabupatenID,$row->namaKecamatan),
							$cellJumlah,anchor('rpjo/perKecamatanrinci/'.$row->kecid.'/'.$kabupatenID,'Rincian'));
				}
				$data['table'] = $this->table->generate();
			} else {
				$data['message'] = 'Tidak ada data yang ditampilkan!';
			}
	
	
			$this->load->view('theme',$data);
		}
	}
	
	function perKabupaten(){
		if($this->session->userdata('login') == TRUE and ($this->session->userdata('level')!='User' or $this->session->userdata('level')!='Entry')){
			$propinsiID = 35;
			$data['main_view'] = 'rpjo_view';
			$data['viewPage'] = "levelKabupaten";
		
			$data['namaPropinsi'] = anchor('rpjo',$this->Propinsi_model->getPropinsiNAMEByID($propinsiID));
			$data['propinsiID'] = $propinsiID;
			$data['linkExport'] = site_url("rpjo");
				
			if ($this->Aset_model->getCountlevelKabupaten($propinsiID)>0)	{
				$tmpl = array('table_open' => '<table  border="0" cellpadding="0" cellspacing="0" bgcolor="#ffffff">',
						'row_alt_start' => '<tr class="zebra">','row_alt_end' => '</tr>');
				$this->table->set_template($tmpl);
				$this->table->set_empty("&nbsp;");
				$cellJumlah = array('data' => 'Jumlah', 'width' => '10%');
				$this->table->set_heading('No.','Kabupaten / Kota',$cellJumlah,'Rincian');
				$i = 0 ;
				$asets = $this->Aset_model->getlevelKabupaten($propinsiID);
				foreach ($asets as $row){
					$cellNomor = array('data' => ++$i, 'style' => 'text-align: right', 'width' => '5%' );
					$cellJumlah = array('data' => number_format($row->jumlah,0,",","."), 'style' => 'text-align: right');
					$this->table->add_row($cellNomor,anchor('rpjo/perKecamatan/'.$row->kabid,$row->namaKota),
							$cellJumlah,anchor('rpjo/perKabupatenrinci/'.$row->kabid,'Rincian'));
				}
				$data['table'] = $this->table->generate();
			} else {
				$data['message'] = 'Tidak ada data yang ditampilkan!';
			}
				
				
			$this->load->view('theme',$data);
		}
	}
	
	function rincianObjectPropinsi(){
		if($this->session->userdata('login') == TRUE and ($this->session->userdata('level')!='User' or $this->session->userdata('level')!='Entry')){
			$propinsiID = 35;
			$data['main_view'] = 'rpjo_view';
			$data['viewPage'] = "rincianPropinsi";
			$data['linkExport'] = site_url("rpjo");
				
			$data['propinsiID'] = $propinsiID;
			$data['namaPropinsi'] = anchor('rpjo',$this->Propinsi_model->getPropinsiNAMEByID($propinsiID));
			
			if ($this->Aset_model->getCountRincianPropinsi($propinsiID)>0)	{
				
				$tmpl = array('table_open' => '<table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#ffffff">',
						'row_alt_start' => '<tr class="zebra">','row_alt_end' => '</tr>');
				$this->table->set_template($tmpl);
				$this->table->set_empty("&nbsp;");
				$cellJumlah = array('data' => 'Jumlah', 'width' => '10%');
				$this->table->set_heading('No.','Golongan','Jenis Obyek','Kode',$cellJumlah);
				$i = 0 ;
				$asets = $this->Aset_model->getRincianPropinsi($propinsiID);
				foreach ($asets as $row){
					$cellNomor = array('data' => ++$i, 'style' => 'text-align: right', 'width' => '5%' );
					$cellJumlah = array('data' => number_format($row->jumlah,0,",","."), 'style' => 'text-align: right');
					$this->table->add_row($cellNomor,$row->golongan,$row->jenis,$row->jenis_aset,$cellJumlah);
				}			
				
				$data['table'] = $this->table->generate();
			} else {
				$data['message'] = 'Tidak ada data yang ditampilkan!';
			}
			
			
			$this->load->view('theme',$data);
		}
	}

	function viewdata(){
		if($this->session->userdata('login') == TRUE and ($this->session->userdata('level')!='User' or $this->session->userdata('level')!='Entry')){

			$data['title'] = $this->title;
			$data['main_view'] = 'rpjo_view';
			$data['viewPage'] = "propinsi";
			$propinsiID = 35;
			
			$data['namaPropinsi'] = $this->Propinsi_model->getPropinsiNAMEByID($propinsiID);
			
			$data['tglSkr'] = date('d/m/Y');
			$data['totalOFF'] = number_format($this->Aset_model->countAllAset(),0,",",".");
			$data['rincianObject'] = anchor('rpjo/rincianObjectPropinsi','Rincian per Jenis Obyek');
			$data['jmlObjekPerkabupaten'] = anchor('rpjo/perKabupaten','Jumlah obyek Per Kabupaten');
			
			$this->load->view('theme',$data);
		}else{
			redirect('home');
		}

	}

	
	


	function createpdf(){
		$reportSelected = $this->input->get("jenis");
		if (strcmp($reportSelected,"rinciPropinsi")==0) {
			$propinsiID = $this->input->get("propinsiID");
			$propinsiName = $this->Propinsi_model->getPropinsiNAMEByID($propinsiID);
			$pdfFile = "rincian_propinsi_".str_replace(" ","_",$propinsiName)."_".date('Ymd-Hi');
			$java = "java -jar ".$this->config->config['directoryJarReport']
			."reportNU.jar pdf "
			.$this->config->config['directoryJarReport']." "
			.$this->config->config['directoryPDFReport']." rincianPropinsi ".$pdfFile." ".$propinsiID." ".$propinsiName;
			
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
			
			exec($java);
			header('Content-type: application/pdf');
			$ResultPDF = $this->config->config['directoryPDFReport'].$pdfFile.".pdf";
			header("Content-Disposition:attachment;filename=".$pdfFile.".pdf");
			readfile($ResultPDF);
		} else if (strcmp($reportSelected,"rinciKabupaten")==0) {
			$kabupatenID = $this->input->get("kabupatenID");
			$kabupatenName = $this->Kota_model->getNamaKotaByKotaID($kabupatenID);
			$pdfFile = "rincian_".str_replace(" ","_",$kabupatenName)."_".date('Ymd-Hi');
			$java = "java -jar ".$this->config->config['directoryJarReport']
			."reportNU.jar pdf "
			.$this->config->config['directoryJarReport']." "
			.$this->config->config['directoryPDFReport']." rincianKabupaten ".$pdfFile." ".$kabupatenID." ".$kabupatenName;
			
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
			exec($java);
			header('Content-type: application/pdf');
			$ResultPDF = $this->config->config['directoryPDFReport'].$pdfFile.".pdf";
			header("Content-Disposition:attachment;filename=".$pdfFile.".pdf");
			readfile($ResultPDF);
		} else if (strcmp($reportSelected,"rinciKecamatan")==0) {
			$kecamatanID = $this->input->get("kecamatanID");
			$kecamatanName = $this->Kecamatan_model->getNamaKecamatanByKecamatanID($kecamatanID);
			$pdfFile = "rincian_".str_replace(" ","_",$kecamatanName)."_".date('Ymd-Hi');
			$java = "java -jar ".$this->config->config['directoryJarReport']
			."reportNU.jar pdf "
			.$this->config->config['directoryJarReport']." "
			.$this->config->config['directoryPDFReport']." rincianKecamatan ".$pdfFile." ".$kecamatanID." ".$kecamatanName;
			
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
			exec($java);
			header('Content-type: application/pdf');
			$ResultPDF = $this->config->config['directoryPDFReport'].$pdfFile.".pdf";
			header("Content-Disposition:attachment;filename=".$pdfFile.".pdf");
			readfile($ResultPDF);
		} else if (strcmp($reportSelected,"rinciDesa")==0) {
			$desaID = $this->input->get("desaID");
			$desaName = $this->Kelurahan_model->getNamaKelurahanbyId($desaID);
			$pdfFile = "rincian_desa_".str_replace(" ","_",$desaName)."_".date('Ymd-Hi');
			$java = "java -jar ".$this->config->config['directoryJarReport']
			."reportNU.jar pdf "
			.$this->config->config['directoryJarReport']." "
			.$this->config->config['directoryPDFReport']." rincianDesa ".$pdfFile." ".$desaID." ".$desaName;
			
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
			exec($java);
			header('Content-type: application/pdf');
			$ResultPDF = $this->config->config['directoryPDFReport'].$pdfFile.".pdf";
			header("Content-Disposition:attachment;filename=".$pdfFile.".pdf");
			readfile($ResultPDF);
		} else if (strcmp($reportSelected,"diKabupaten")==0) {
			$propinsiID = $this->input->get("propinsiID");
			$propinsiName = $this->Propinsi_model->getPropinsiNAMEByID($propinsiID);
			$pdfFile = "rekap_objek_di_propinsi_".str_replace(" ","_",$propinsiName)."_".date('Ymd-Hi');
			$java = "java -jar ".$this->config->config['directoryJarReport']
			."reportNU.jar pdf "
			.$this->config->config['directoryJarReport']." "
			.$this->config->config['directoryPDFReport']." levelKabupaten ".$pdfFile." ".$propinsiID." ".$propinsiName;
			
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
			exec($java);
			header('Content-type: application/pdf');
			$ResultPDF = $this->config->config['directoryPDFReport'].$pdfFile.".pdf";
			header("Content-Disposition:attachment;filename=".$pdfFile.".pdf");
			readfile($ResultPDF);
		} else if (strcmp($reportSelected,"diKecamatan")==0) {
			$kabupatenID = $this->input->get("kabupatenID");
			$kabupatenName = $this->Kota_model->getNamaKotaByKotaID($kabupatenID);
			$pdfFile = "rekap_objek_di_".str_replace(" ","_",$kabupatenName)."_".date('Ymd-Hi');
			$java = "java -jar ".$this->config->config['directoryJarReport']
			."reportNU.jar pdf "
			.$this->config->config['directoryJarReport']." "
			.$this->config->config['directoryPDFReport']." levelKecamatan ".$pdfFile." ".$kabupatenID." ".$kabupatenName;
			
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
			exec($java);
			header('Content-type: application/pdf');
			$ResultPDF = $this->config->config['directoryPDFReport'].$pdfFile.".pdf";
			header("Content-Disposition:attachment;filename=".$pdfFile.".pdf");
			readfile($ResultPDF);
		} else if (strcmp($reportSelected,"diDesa")==0) {
			$kecamatanID = $this->input->get("kecamatanID");
			$kecamatanName = $this->Kecamatan_model->getNamaKecamatanByKecamatanID($kecamatanID);
			$pdfFile = "rekap_objek_di_".str_replace(" ","_",$kecamatanName)."_".date('Ymd-Hi');
			$java = "java -jar ".$this->config->config['directoryJarReport']
			."reportNU.jar pdf "
			.$this->config->config['directoryJarReport']." "
			.$this->config->config['directoryPDFReport']." levelDesa ".$pdfFile." ".$kecamatanID." ".$kecamatanName;
			
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
			exec($java);
			header('Content-type: application/pdf');
			$ResultPDF = $this->config->config['directoryPDFReport'].$pdfFile.".pdf";
			header("Content-Disposition:attachment;filename=".$pdfFile.".pdf");
			readfile($ResultPDF);
		}
	}
}

?>
