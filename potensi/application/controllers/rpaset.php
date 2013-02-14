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
			$data['main_view'] = 'rpaset_view';
			$data['form_action'] = site_url('rpaset');
			$offset = 0;
			if (strlen($this->uri->segment(6))>0) {
				$offset = $this->uri->segment(6);
			}
			$propinsiID = '';
			$kotaID = '';
			$kecamatanID = '';
			
			if (strlen($this->uri->segment(3))>1&&strcmp(substr($this->uri->segment(3),0,1),"a")==0) {
				$propinsiID = substr($this->uri->segment(3),1);
			}
			
			if (strlen($this->uri->segment(4))>1&&strcmp(substr($this->uri->segment(4),0,1),"b")==0) {
				$kotaID = substr($this->uri->segment(4),1);
			}
			
			if (strlen($this->uri->segment(5))>1&&strcmp(substr($this->uri->segment(5),0,1),"c")==0) {
				$kecamatanID = substr($this->uri->segment(5),1);
			}
			
			if (strlen($this->input->post("propinsi"))>0)
			{
				$offset = 0;
				$propinsiID = $this->input->post("propinsi");
			}
			if (strlen($this->input->post("kota"))>0)
			{
				$offset = 0;
				$kotaID = $this->input->post("kota");
			}
			if (strlen($this->input->post("kecamatan"))>0)
			{
				$offset = 0;
				$kecamatanID = $this->input->post("kecamatan");
			}
			

			if(!empty($propinsiID)){

				if(!empty($kotaID)){

					if(!empty($kecamatanID)){
						$asets = $this->Aset_model->getAllByKecamatan($this->limit,$offset,$kecamatanID,'','','','','');
						$num_rows = $this->Aset_model->countAllByKecamatan($kecamatanID,'','','','','');
						$rec = $this->Aset_model->countRowByKecamatan($this->limit,$offset,$kecamatanID,'','','','','');
					}else{
						$asets = $this->Aset_model->getAllByKota($this->limit,$offset,$kotaID,'','','','','');
						$num_rows = $this->Aset_model->countAllByKota($kotaID,'','','','','');
						$rec = $this->Aset_model->countRowByKota($this->limit,$offset,$kotaID,'','','','','');
					}
				}else{
					$asets = $this->Aset_model->getAllByPropinsi($this->limit,$offset,$propinsiID,'','','','','');
					$num_rows = $this->Aset_model->countAllByPropinsi($propinsiID,'','','','','');
					$rec = $this->Aset_model->countRowByPropinsi($this->limit,$offset,$propinsiID,'','','','','');
				}
			}else{
				$asets = $this->Aset_model->getAll($this->limit,$offset,'','','','','');
				$num_rows = $this->Aset_model->countAll('','','','','');
				$rec = $this->Aset_model->countRow($this->limit,$offset,'','','','','');
			}

			if($num_rows > 0){
				$config['base_url'] = site_url('rpaset/viewdata/a'.$propinsiID.'/b'.$kotaID.'/c'.$kecamatanID);
				$config['total_rows'] = $num_rows;
				$config['per_page'] = $this->limit;
				$config['uri_segment'] = 6;
				$this->pagination->initialize($config);
				$data['pagination'] = $this->pagination->create_links();
				$data['num_rows'] = $num_rows;
				$data['rec'] = $offset + $rec;
				$tmpl = array('table_open' => '<table border="0" cellpadding="0" cellspacing="0" bgcolor="#ffffff" width="100%">',
						'row_alt_start' => '<tr class="zebra">','row_alt_end' => '</tr>');

				$this->table->set_template($tmpl);
				$this->table->set_empty("&nbsp;");
				$this->table->set_heading('No.','ID-Aset','Jenis','Nama','Lokasi', 'Ranting','Desa');

				$i = 0 + $offset;

				foreach($asets as $row){
					$namaKelurahan = $this->Kelurahan_model->getNamaKelurahanbyId($row->kelid);
					$this->table->add_row(++$i,$row->id,
							$row->ket_jenis,
							$row->nama_aset,
							$row->lokasi,
							$row->ranting,
							$namaKelurahan
					);
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
		$tmpl = array('table_open' => '<table border="0" cellpadding="0" cellspacing="0" bgcolor="#ffffff" width="100%">',
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



		//$data['table'] = $this->table->generate();
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
