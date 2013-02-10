<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of aset
 *
 * @author newDomas
 */
class Aset extends CI_Controller{
    //put your code here
    
    function Aset(){
        parent::__construct();
        $this->load->model('Aset_model','',TRUE);
        $this->load->model('Propinsi_model','',TRUE);
        $this->load->model('Kota_model','',TRUE);
        $this->load->model('Kecamatan_model','',TRUE);
        $this->load->model('Kelurahan_model','',TRUE);
        $this->load->model('Jenis_model','',TRUE);
        $this->load->model('Status_model','',TRUE);
        $this->load->model('Bukti_model','',TRUE);
        $this->load->model('Pengelola_model','',TRUE);
        $this->load->model('Golongan_model','',TRUE);
    }
    
    var $title = 'Aset';
    var $limit = 20;
    var $cat1; var $cat2; var $cat3; var $cat4;
    var $cat5; var $cat6; var $cat7; var $cat8;
   
    function index(){
        if($this->session->userdata('login') == TRUE and $this->session->userdata('level')!='User'){
            
        $data['title'] = $this->title;
        //$data['h2_title'] = 'Input Aset';
        $data['main_view'] = 'input_aset';
        $data['form_action'] = site_url('aset/add_aset');
        
        //$data['pilihkota'] = $this->Kota_model->getKota();
        $this->load->view('theme',$data);
        }else{
            redirect('home');
        }
        
    }
    
    function add(){
        if($this->session->userdata('login') == TRUE and $this->session->userdata('level')!='User'){
            $data['title'] = $this->title;
            //$data['h2_title'] = 'Aset > Input Aset';
            
            $data['form_action'] = site_url('aset/add_aset');
            $data['link'] = array('link_back'=>  anchor('aset/add','Kembali'));
            $kelID = $this->uri->segment(3);
            if(!empty($kelID)){
                $data['main_view'] = 'input_aset1';
                $data['kelID'] = $this->uri->segment(3);
            }else{
                $data['main_view'] = 'input_aset';
            }
            $this->load->view('theme',$data);
        }else{
            redirect('home');
        }
    }
    
    function getNoAsetID(){
        echo '<input type="text" readonly="readonly" name="id" id="id" value="" size="30" />';
    }
    
    function getNewAsetID(){
        $year = date('Y');
        $kelID = substr($this->uri->segment(3),0,10);
        if(strlen($kelID)>0){
        
        if(!empty($kelID)){
            $newID = $kelID . "." . $year . "." . $this->Aset_model->getNewAsetID($kelID);
            echo '<input type="text" readonly="readonly" name="id" id="id" value="' . $newID . '" size="30" />';
        }else{
            echo '<input type="text" readonly="readonly" name="id" id="id" value="" size="30" />';
        }
        }
    }
    
    function add_aset(){
        $data['title'] = $this->title;
        //$data['h2_title'] = 'Aset > Input Aset';
        $data['main_view'] = 'input_aset1';
        $data['form_action'] = site_url('aset/add_aset');
        $data['link'] = array('link_back'=>  anchor('aset/add','Kembali'));
        $tgl_entry = date("Y-m-d");
        $tgl = substr($this->input->post('tgl_survey'),0,2);
        $bln = substr($this->input->post('tgl_survey'),3,2);
        $thn = substr($this->input->post('tgl_survey'),6,4);
        $tgl_survey = $thn . '-' . $bln . '-' . $tgl;
        $kelID = substr($this->input->post('id'), 0, 10);
        
        $aset = array('id'=>  $this->input->post('id'),
            'jenis_aset'=>  $this->input->post('jenis_aset'),
            'ket_jenis'=>  $this->input->post('ket_jenis'),
            'nama_aset'=>  $this->input->post('nama_aset'),
            'lokasi'=>  $this->input->post('lokasi'),
            'pendiri'=>  $this->input->post('pendiri'),
            'th_berdiri'=>  $this->input->post('th_berdiri'),
            'luas_tanah'=>  $this->input->post('luas_tanah'),
            'luas_bangunan'=>  $this->input->post('luas_bangunan'),
            'status_tanah'=>  $this->input->post('status_tanah'),
            'ket_status'=>  $this->input->post('ket_status'),
            'bukti_milik'=>  $this->input->post('bukti_milik'),
            'ket_bukti'=>  $this->input->post('ket_bukti'),
            'pengelola'=>  $this->input->post('pengelola'),
            'ket_pengelola'=>  $this->input->post('ket_pengelola'),
            'penanggung_jawab'=>  $this->input->post('penanggung_jawab'),
            'telp'=>  $this->input->post('telp'),
            'keterangan'=>  $this->input->post('keterangan'),
            'tgl_survey'=>  $tgl_survey,
            'kprnu'=>  $this->input->post('kprnu'),
            'ranting'=> $this->input->post('ranting'),
            'petugas'=> $this->input->post('petugas'),
        	'propid'=> $this->input->post('propinsi'),
        	'kabid'=> $this->input->post('kota'),
        	'kecid'=> $this->input->post('kecamatan'),
        	'kelid'=> $this->input->post('kelurahan'),
            'created'=>  $tgl_entry,
            'createdBy'=>  $this->session->userdata('username')
            );
        $this->Aset_model->add($aset);
        $this->session->set_flashdata('message','Data aset berhasil disimpan!');
        redirect('aset/add/'.$kelID);
    }
    
    function update(){
        if($this->session->userdata('login') == TRUE and $this->session->userdata('level')!='User'){
            $data['title'] = $this->title;
            //$data['h2_title'] = 'Aset > Ubah Data Aset';
            $data['main_view'] = 'update_aset';
            $data['form_action'] = site_url('aset/update_aset');
            $data['link'] = array('link_back'=>  anchor('aset/add/','Kembali'));
            
            $id = $this->uri->segment(3);
            $aset = $this->Aset_model->getAsetByID($id);
            $this->session->set_userdata('id',$aset->id);
            $data['default']['id'] = $aset->id;
            $data['default']['jenis_aset'] = $aset->jenis_aset;
            $data['default']['ket_jenis'] = $aset->ket_jenis;
            $data['default']['nama_aset'] = $aset->nama_aset;
            $data['default']['lokasi'] = $aset->lokasi;
            $data['default']['pendiri'] = $aset->pendiri;
            $data['default']['th_berdiri'] = $aset->th_berdiri;
            $data['default']['luas_tanah'] = $aset->luas_tanah;
            $data['default']['luas_bangunan'] = $aset->luas_bangunan;
            $data['default']['status_tanah'] = $aset->status_tanah;
            $data['default']['ket_status'] = $aset->ket_status;
            $data['default']['bukti_milik'] = $aset->bukti_milik;
            $data['default']['ket_bukti'] = $aset->ket_bukti;
            $data['default']['pengelola'] = $aset->pengelola;
            $data['default']['ket_pengelola'] = $aset->ket_pengelola;
            $data['default']['penanggung_jawab'] = $aset->penanggung_jawab;
            $data['default']['telp'] = $aset->telp;
            $data['default']['keterangan'] = $aset->keterangan;
            $tgl_survey = substr($aset->tgl_survey, 8, 2) . '-' .
                    substr($aset->tgl_survey, 5, 2) . '-' .
                    substr($aset->tgl_survey, 0, 4);
            $data['default']['tgl_survey'] = $tgl_survey;
            $data['default']['kprnu'] = $aset->kprnu;
            $data['default']['ranting'] = $aset->ranting;
            $data['default']['petugas'] = $aset->petugas;

            $this->load->view('theme',$data);
        }else{
            redirect('home');
        }
    }
    
    function update_aset(){
        $data['title'] = $this->title;
        //$data['h2_title'] = 'Aset > Update Data Aset';
        $data['main_view'] = 'update_aset';
        $data['form_action'] = site_url('aset/update_aset');
        $data['link'] = array('link_back'=>  anchor('aset/add/','Kembali'));
        $tgl_update = date("Y-m-d");
        $tgl_survey = substr($this->input->post('tgl_survey'), 6, 4) . '-' .
                substr($this->input->post('tgl_survey'), 3, 2) . '-' .
                substr($this->input->post('tgl_survey'), 0, 2);
        //$ket_status = '';
        $status_tanah = $this->input->post('status_tanah');
        if($status_tanah=='5'){
            $ket_status = $this->input->post('ket_status');
        }else{
            $status = $status = $this->Status_model->getStatusTanahByID($status_tanah)->row();
            $ket_status = $status->status_tanah;
        }
        
        $bukti_milik = $this->input->post('bukti_milik');
        if($bukti_milik=='5'){
            $ket_bukti = $this->input->post('ket_bukti');
        }else{
            $bukti = $this->Bukti_model->getBuktiMilikByID($bukti_milik)->row();
            $ket_bukti = $bukti->bukti_milik;
        }
        
        $pengelola = $this->input->post('pengelola');
        if($pengelola=='4'){
            $ket_pengelola = $this->input->post('ket_pengelola');
        }else{
            $kelola = $this->Pengelola_model->getPengelolaByID($pengelola)->row();
            $ket_pengelola = $kelola->pengelola;
        }
        
        $aset = array('id'=>  $this->input->post('id'),
            'jenis_aset'=>  $this->input->post('jenis_aset'),
            'ket_jenis'=>  $this->input->post('ket_jenis'),
            'nama_aset'=>  $this->input->post('nama_aset'),
            'lokasi'=>  $this->input->post('lokasi'),
            'pendiri'=>  $this->input->post('pendiri'),
            'th_berdiri'=>  $this->input->post('th_berdiri'),
            'luas_tanah'=>  $this->input->post('luas_tanah'),
            'luas_bangunan'=>  $this->input->post('luas_bangunan'),
            'status_tanah'=>  $status_tanah,
            'ket_status'=>  $ket_status,
            'bukti_milik'=>  $bukti_milik,
            'ket_bukti'=>  $ket_bukti,
            'pengelola'=>  $pengelola,
            'ket_pengelola'=>  $ket_pengelola,
            'penanggung_jawab'=>  $this->input->post('penanggung_jawab'),
            'telp'=>  $this->input->post('telp'),
            'keterangan'=>  $this->input->post('keterangan'),
            'tgl_survey'=>  $tgl_survey,
            'kprnu'=>  $this->input->post('kprnu'),
            'ranting'=> $this->input->post('ranting'),
            'petugas'=> $this->input->post('petugas'),
            'updated'=>  $tgl_update,
            'updatedBy'=>  $this->session->userdata('username')
            );
            $this->Aset_model->update($this->input->post('id'),$aset);
            $this->session->set_flashdata('message','Data aset berhasil disimpan!');
            
            redirect('rekap/');
    }
    
    function detail(){
        $data['title'] = $this->title;
        $data['h2_title'] = 'Aset';
        $data['main_view'] = 'view_detail';
        $data['id'] = $this->uri->segment(3);
        
        $this->load->view('theme',$data);
    }
    
    function view($offset=0){
        $data['title'] = $this->title;
        
        $data['main_view'] = 'view_data';
        $uri_segment = 3;
        $offset_segment = 4;
        $jenis = trim($this->uri->segment($uri_segment));
        $offset = $this->uri->segment($offset_segment);
        //$data['h2_title'] = $jenis . strlen($jenis==1);
        
        if(empty($jenis)){
            $asets = $this->Aset_model->getAllAset($this->limit,$offset)->result();
            $num_rows = $this->Aset_model->countAllAset();
        }else{
            if(strlen($jenis)==1){
                $asets = $this->Aset_model->getAsetByJenis($jenis,$this->limit,$offset)->result();
                $num_rows = $this->Aset_model->countAsetByJenis($jenis);
            }else{
                $asets = $this->Aset_model->getAsetByKodeJenis($jenis,$this->limit,$offset)->result();
                $num_rows = $this->Aset_model->countAsetByKodeJenis($jenis);
            }
        }

        if($num_rows > 0){
            $config['base_url'] = site_url('aset/view/'.$jenis);
            $config['total_rows'] = $num_rows;
            $config['per_page'] = $this->limit;
            $config['uri_segment'] = $offset_segment;
            $this->pagination->initialize($config);
            $data['pagination'] = $this->pagination->create_links();
            
            $tmpl = array('table_open' => '<table border="0" cellpadding="0" cellspacing="0">',
                'row_alt_start' => '<tr class="zebra">','row_alt_end' => '</tr>');
            
            $this->table->set_template($tmpl);
            $this->table->set_empty("&nbsp;");
            $this->table->set_heading('No.','ID Aset','Jenis Aset','Nama Aset','Lokasi','Ranting','Kecamatan','Kota/Kabupaten');
            
            $i = 0 + $offset;
            
            foreach($asets as $aset){
                $kotaID = substr($aset->id, 0, 4);
                $kota = $this->Kota_model->getKotaByID($kotaID);
                $kecamatanID = substr($aset->id, 0, 6);
                $kecamatan = $this->Kecamatan_model->getKecamatanByID($kecamatanID);
                $namaKec = $kecamatan->namaKecamatan;
                $namaKota = $kota->namaKota;
                $this->table->add_row(++$i,
                anchor('aset/detail/'.$aset->id,$aset->id),
                $aset->ket_jenis,
                $aset->nama_aset,
                $aset->lokasi,
                $aset->ranting,
                $namaKec,
                $namaKota);
                
            }
            $data['table'] = $this->table->generate();
        }else{
            $data['message'] = 'Tidak ada data yang ditampilkan!';
        }
        
        if($this->session->userdata('level')!=("User")){
            $data['link'] = array('link_add'=>  anchor('aset/add','tambah data'));
        }
        $this->load->view('theme',$data);
            
    }
    
    function viewAset($offset=0){
        $data['title'] = $this->title;
        
        $data['main_view'] = 'view_data';
        $cat = $this->uri->segment(3);
        $id = $this->uri->segment(4);
        $offset = $this->uri->segment(5);
        
        $asets = $this->Aset_model->getAsetByCat($cat,$id,$this->limit,$offset);
        $num_rows = $this->Aset_model->countAsetByCat($cat,$id);

        if($num_rows > 0){
            $config['base_url'] = site_url('aset/view/'.$cat);
            $config['total_rows'] = $num_rows;
            $config['per_page'] = $this->limit;
            $config['uri_segment'] = 5;
            $this->pagination->initialize($config);
            $data['pagination'] = $this->pagination->create_links();
            
            $tmpl = array('table_open' => '<table border="0" cellpadding="0" cellspacing="0">',
                'row_alt_start' => '<tr class="zebra">','row_alt_end' => '</tr>');
            
            $this->table->set_template($tmpl);
            $this->table->set_empty("&nbsp;");
            $this->table->set_heading('No.','ID Aset','Jenis Aset','Nama Aset','Lokasi','Ranting','Kecamatan','Kota/Kabupaten');
            
            $i = 0 + $offset;
            
            foreach($asets as $aset){
                $kotaID = substr($aset->id, 0, 4);
                $kota = $this->Kota_model->getKotaByID($kotaID);
                $kecamatanID = substr($aset->id, 0, 6);
                $kecamatan = $this->Kecamatan_model->getKecamatanByID($kecamatanID);
                $namaKec = $kecamatan->namaKecamatan;
                $namaKota = $kota->namaKota;
                $this->table->add_row(++$i,
                anchor('aset/detail/'.$aset->id,$aset->id),
                $aset->ket_jenis,
                $aset->nama_aset,
                $aset->lokasi,
                $aset->ranting,
                $namaKec,
                $namaKota);
                
            }
            $data['table'] = $this->table->generate();
        }else{
            $data['message'] = 'Tidak ada data yang ditampilkan!';
        }
        
        if($this->session->userdata('level')!=("User")){
            $data['link'] = array('link_add'=>  anchor('aset/add','tambah data'));
        }
        $this->load->view('theme',$data);
            
    }
    
    function delete(){
        if($this->session->userdata('login') == TRUE){
            
            $id = $this->uri->segment(3);
            $aset = $this->Aset_model->delete($id);
            
            redirect('aset/');
        }else{
            redirect('home');
        }
    }
    
    function cat(){
        if($this->session->userdata('login') == TRUE){
            $cat = $this->uri->segment(3);
            $gol = $this->Golongan_model->getGolonganByID($cat); 
            $numRows = $this->Golongan_model->countGolonganByID($cat); 
            $data['title'] = $this->title;
            $data['h2_title'] = $gol->golongan;
            $data['main_view'] = 'view_data';
            

            if($numRows > 0){
            $tmpl = array('table_open' => '<table border="0" cellpadding="0" cellspacing="0">',
                'row_alt_start' => '<tr class="zebra">','row_alt_end' => '</tr>');
            
            $this->table->set_template($tmpl);
            $this->table->set_empty("&nbsp;");
            $this->table->set_heading('No.','Kode','Jenis Aset','Jumlah');
            $jenis = $this->Jenis_model->getJenisByCat($cat)->result();
            $i = 0;
            
            foreach($jenis as $data1){
                $jumlah = $this->Aset_model->countAsetByKodeJenis($data1->kode_klasifikasi);
                $this->table->add_row(++$i,
                        $data1->kode_klasifikasi,
                        anchor('aset/view/'.$data1->kode_klasifikasi,$data1->jenis),
                        $jumlah);
            }
            
            $data['table'] = $this->table->generate();
            
            $this->load->view('theme',$data);
        }else{
            $data['message'] = 'Tidak ada data yang ditampilkan!';
        }
            
        }else{
            redirect('home');
        }
    }
    
    function countRekapProp(){
        $propID = $this->uri->segment(3);
        $this->cat1 = $this->Aset_model->countRekapProp($propID,1);
        $this->cat2 = $this->Aset_model->countRekapProp($propID,2);
        $this->cat3 = $this->Aset_model->countRekapProp($propID,3);
        $this->cat4 = $this->Aset_model->countRekapProp($propID,4);
        $this->cat5 = $this->Aset_model->countRekapProp($propID,5);
        $this->cat6 = $this->Aset_model->countRekapProp($propID,6);
        $this->cat7 = $this->Aset_model->countRekapProp($propID,7);
        $this->cat8 = $this->Aset_model->countRekapProp($propID,8);
        //$this->viewRekap($propID);
    }
    
    function countRekapKota(){
        $kotaID = substr($this->uri->segment(3),0,4);
        $this->cat1 = $this->Aset_model->countRekapKota($kotaID,1);
        $this->cat2 = $this->Aset_model->countRekapKota($kotaID,2);
        $this->cat3 = $this->Aset_model->countRekapKota($kotaID,3);
        $this->cat4 = $this->Aset_model->countRekapKota($kotaID,4);
        $this->cat5 = $this->Aset_model->countRekapKota($kotaID,5);
        $this->cat6 = $this->Aset_model->countRekapKota($kotaID,6);
        $this->cat7 = $this->Aset_model->countRekapKota($kotaID,7);
        $this->cat8 = $this->Aset_model->countRekapKota($kotaID,8);
        //$this->viewRekap($kotaID);
    }
    
    function countRekapKec($kecID){
        $kecID = substr($this->uri->segment(3),0,6);
        $this->cat1 = $this->Aset_model->countRekapKec($kecID,1);
        $this->cat2 = $this->Aset_model->countRekapKec($kecID,2);
        $this->cat3 = $this->Aset_model->countRekapKec($kecID,3);
        $this->cat4 = $this->Aset_model->countRekapKec($kecID,4);
        $this->cat5 = $this->Aset_model->countRekapKec($kecID,5);
        $this->cat6 = $this->Aset_model->countRekapKec($kecID,6);
        $this->cat7 = $this->Aset_model->countRekapKec($kecID,7);
        $this->cat8 = $this->Aset_model->countRekapKec($kecID,8);
        //$this->viewRekap($kecID);
    }
    
    function countRekapKel($kelID){
        $kelID = substr($this->uri->segment(3),0,10);
        $this->cat1 = $this->Aset_model->countRekapKel($kelID,1);
        $this->cat2 = $this->Aset_model->countRekapKel($kelID,2);
        $this->cat3 = $this->Aset_model->countRekapKel($kelID,3);
        $this->cat4 = $this->Aset_model->countRekapKel($kelID,4);
        $this->cat5 = $this->Aset_model->countRekapKel($kelID,5);
        $this->cat6 = $this->Aset_model->countRekapKel($kelID,6);
        $this->cat7 = $this->Aset_model->countRekapKel($kelID,7);
        $this->cat8 = $this->Aset_model->countRekapKel($kelID,8);
        //$this->viewRekap($kelID);
        
    }
    
    function countRekapAll(){
        
        $this->cat1 = $this->Aset_model->countRekapAll(1);
        $this->cat2 = $this->Aset_model->countRekapAll(2);
        $this->cat3 = $this->Aset_model->countRekapAll(3);
        $this->cat4 = $this->Aset_model->countRekapAll(4);
        $this->cat5 = $this->Aset_model->countRekapAll(5);
        $this->cat6 = $this->Aset_model->countRekapAll(6);
        $this->cat7 = $this->Aset_model->countRekapAll(7);
        $this->cat8 = $this->Aset_model->countRekapAll(8);
        //$this->viewRekap('');
    }
    
    function countRekap(){
        
        
        $id = $this->uri->segment(3);
        $lenID = strlen($id);
        
            switch ($lenID){
                case 2:
                    $this->countRekapProp($id);
                    break;
                case 4:
                    $this->countRekapKota($id);
                    break;
               case 6:
                    $this->countRekapKec($id);
                    break;
               case 10:
                    $this->countRekapKel($id);
                    break;
                default:
            $this->countRekapAll();
            
        }
        $this->viewRekap($id);
        
    }
    
    function viewRekap($id){
        
        $cetak = '
        <table width="100%" cellpadding="0" and cellspacing="0">
            <tr>
                <td width="25%"><div align="center">
                    <a href="' ;
                    if($this->session->userdata('login')==TRUE){
                        $cetak .= base_url() . 'index.php/aset/viewAset/1/'.$id;
                    }else{
                        $cetak .= '#';
                    }
        $cetak .= '"><img width="160" height="160" src="' . base_url() . 'images/masjid.jpg" />
                    </a></div>
                </td>
                <td width="25"><div align="center">
                    <a href="';
                    if($this->session->userdata('login')==TRUE){
                        $cetak .= base_url() . 'index.php/aset/viewAset/2/'.$id;
                    }else{
                        $cetak .= '#';
                    }
        $cetak .= '"><img width="160" height="160" alt="" src="' . base_url() . 'images/pendidikan.jpg" />
                    </a></div>
                </td>
                <td width="25%"><div align="center">
                    <a href="';
                    if($this->session->userdata('login')==TRUE){
                        $cetak .= base_url() . 'index.php/aset/viewAset/3/'.$id;
                    }else{
                        $cetak .= '#';
                    }
        $cetak .= '"><img width="160" height="160" alt="" src="' . base_url() . 'images/sosial.jpg" />
                    </a></div>
                </td>
                <td width="25%"><div align="center">
                    <a href="';
                    if($this->session->userdata('login')==TRUE){
                        $cetak .= base_url() . 'index.php/aset/viewAset/4/'.$id;
                    }else{
                        $cetak .= '#';
                    }
        $cetak .= '"><img width="160" height="160" alt="" src="' . base_url() . 'images/perkantoran.jpg" />
                    </a></div>
                </td>
            </tr>
            <tr>
                <td width="25%">
                    <table width="160" cellpadding="0" cellspacing="0" align="center">
                        <tr><td bgcolor="#2F89B6"><div class="noline">
                            <a href="';
                            if($this->session->userdata('login')==TRUE){
                                $cetak .= base_url() . 'index.php/aset/viewAset/1/'.$id;
                            }else{
                                $cetak .= '#';
                            }
        $cetak .= '"><div class="kategori">
                            Tempat Ibadah<br />'. $this->cat1 . '</div>
                            </a></div></td></tr>
                    </table>
                </td>
                <td width="25%">
                    <table width="160" cellpadding="0" cellspacing="0" align="center">
                        <tr><td bgcolor="#A04661"><div class="noline">
                            <a href="';
                            if($this->session->userdata('login')==TRUE){
                                $cetak .= base_url() . 'index.php/aset/viewAset/2/'.$id;
                            }else{
                                $cetak .= '#';
                            }
        $cetak .= '"><div class="kategori">
                            Pendidikan<br />' . $this->cat2 . '</div>
                            </a></div></td></tr>
                    </table>
                </td>
                <td width="25%" align="center">
                    <table width="160" cellpadding="0" cellspacing="0" align="center">
                        <tr><td bgcolor="#5B9121"><div class="noline">
                        <a href="';
                        if($this->session->userdata('login')==TRUE){
                            $cetak .= base_url() . 'index.php/aset/viewAset/3/'.$id;
                        }else{
                            $cetak .= '#';
                        }
        $cetak .= '"><div class="kategori">
                            Sosial<br />' . $this->cat3 . '</div>
                            </a></div></td></tr>
                    </table>
                </td>
                <td width="25%" align="center">
                    <table width="160" cellpadding="0" cellspacing="0" align="center">
                        <tr><td bgcolor="#EB9500"><div class="noline">
                        <a href="';
                        if($this->session->userdata('login')==TRUE){
                            $cetak .= base_url() . 'index.php/aset/viewAset/4/'.$id;
                        }else{
                            $cetak .= '#';
                        }
        $cetak .= '"><div class="kategori">
                            Perkantoran<br />' . $this->cat4 . '</div>
                            </a></div></td></tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td width="25%">
                    <div align="center"><a href="';
                    if($this->session->userdata('login')==TRUE){
                        $cetak .= base_url() . 'index.php/aset/viewAset/5/'.$id;
                    }else{
                        $cetak .= '#';
                    }
                
        $cetak .= '"><img width="160" height="160" src="' . base_url() . 'images/dokter.png" />
                    </a></div>
                </td>
                <td width="25%"><div align="center">
                    <a href="' ;
                    if($this->session->userdata('login')==TRUE){
                        $cetak .= base_url() . 'index.php/aset/viewAset/6/'.$id;
                    }else{
                        $cetak .= '#';
                    }
        $cetak .= '"><img width="160" height="160" src="'. base_url() . 'images/ekonomi.jpg" />
                    </a></div>
                </td>
                <td width="25%"><div align="center">
                    <a href="' ;
                    if($this->session->userdata('login')==TRUE){
                        $cetak .= base_url() . 'index.php/aset/viewAset/7/'.$id;
                    }else{
                        $cetak .= '#';
                    }
        $cetak .= '"><img width="160" height="160" src="' . base_url() . 'images/media.png" />
                    </a></div>
                </td>
                <td width="25%"><div align="center">
                    <a href="';
                    if($this->session->userdata('login')==TRUE){
                        $cetak .= base_url() . 'index.php/aset/viewAset/8/'.$id;
                    }else{
                        $cetak .= '#';
                    }
        $cetak .= '"><img width="160" height="160" src="' . base_url() . 'images/lain2.jpg" />
                    </a></div>
                </td>
            </tr>
            <tr>
                <td width="25%">
                <table width="160" cellpadding="0" cellspacing="0" align="center">
                    <tr>
                        <td bgcolor="#2F89B6">
                            <div class="noline">
                                <a href="';
                                if($this->session->userdata('login')==TRUE){
                                    $cetak .= base_url() . 'index.php/aset/viewAset/5/'.$id;
                                }else{
                                    $cetak .= '#';
                                }
        $cetak .= '"><div class="kategori">Kesehatan<br />' . $this->cat5 . '</div>
                    </a>
                    </div></td></tr>
                </table>
                </td>
                <td width="25%" align="center">
                <table width="160" cellpadding="0" cellspacing="0" align="center">
                    <tr><td bgcolor="#A04661"><div class="noline">
                    <a href="';
                    if($this->session->userdata('login')==TRUE){
                        $cetak .= base_url() . 'index.php/aset/viewAset/6/'.$id;
                    }else{
                        $cetak .= '#';
                    }
        $cetak .= '"><div class="kategori">Ekonomi<br />' . $this->cat6 . '</div>
                    </a>
                    </div></td></tr>
                </table>
                </td>
                <td width="25%" align="center">
                <table width="160" cellpadding="0" cellspacing="0" align="center">
                    <tr><td bgcolor="#5B9121"><div class="noline">
                    <a href="';
                    if($this->session->userdata('login')==TRUE){
                        $cetak .= base_url() . 'index.php/aset/viewAset/7/'.$id;
                    }else{
                        echo '#';
                    }
        $cetak .= '"><div class="kategori">Media Dakwah<br />' . $this->cat7 . '</div>
                    </a>
                    </div></td></tr>
                </table>
                </td>
                <td width="25%" align="center">
                <table width="160" cellpadding="0" cellspacing="0" align="center">
                    <tr><td bgcolor="#EB9500"><div class="noline">
                    <a href="';
                    if($this->session->userdata('login')==TRUE){
                        $cetak .= base_url() . 'index.php/aset/viewAset/8/'.$id;
                    }else{
                        $cetak .= '#';
                    }
        $cetak .= '"><div class="kategori">Lain-lain<br />' . $this->cat8 . '</div>
                    </a>
                    </div></td></tr>
                </table>
                </td></tr></table>';
        echo $cetak ;
        
    }
    
    function getPropinsi(){
        $propID = substr($this->uri->segment(3),0,2);
        $propinsi = $this->Propinsi_model->getPropinsi();
        echo 'Propinsi<br />';
        echo '<SELECT name="propinsi" onchange="ambil_kota($(this).val())" style="width:220px">';
        echo '<option value="">-- pilih --</option>';
        foreach($propinsi as $data){
            if($data->propinsiID == $propID){
                echo '<option value="' . $data->propinsiID . '" selected>' . $data->namaPropinsi. '</option>';
            }else{
                echo '<option value="' . $data->propinsiID . '">' . $data->namaPropinsi. '</option>';
            }
        }
        echo '</select>';
    }
    
    function getJenis(){
        $id = $this->uri->segment(3);
        $aset = $this->Aset_model->getAsetByID($id); 
        $kode_jenis = $aset->jenis_aset;
        $jenis = $this->Jenis_model->getJenis($kode_jenis)->row();
        $num_rows = $this->Jenis_model->getJenis($kode_jenis)->num_rows();
        $gol = substr($kode_jenis, 0, 1);
        $golongan = $this->Golongan_model->getGolonganByID($gol);
        if($num_rows > 0){
                echo '<INPUT type="text" name="golongan" size="15" readonly="readonly" value="' . $golongan->golongan . '" /><br />';
                echo '<INPUT type="text" name="ket_jenis" size="40" value="' . $jenis->jenis . '" />';
         }else{
             echo 'Jenis Aset tidak ada!';
         }
    }
    
    function cekAset(){
        $jenis = $this->uri->segment(3);
        $id = substr($this->uri->segment(4),0,10);
        $nama = $this->uri->segment(5);
        $nama = str_replace("%20", " ", $nama);
        if($this->Aset_model->cekAset($id,$jenis,$nama)){
            echo '<script type="text/javascript">
                    alert("Nama Aset sudah ada!");
                  </script>';
        }
    }
    
    function hitung(){
        $id = $this->uri->segment(3);
        
        switch (strlen($id)){
            case 2:
                $jumlah = $this->Aset_model->countAsetByPropinsi($id);
                break;
            case 4:
                $jumlah = $this->Aset_model->countAsetByKota($id);
                break;
            case 6:
                $jumlah = $this->Aset_model->countAsetByKecamatan($id);
                break;
            case 10:
                $jumlah = $this->Aset_model->countAsetByKelurahan($id);
                break;
        }
        echo "TOTAL ASET : " . $jumlah;
        
    }
}

?>
