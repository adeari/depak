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
            $data['link'] = array('link_back'=>  anchor('aset/view','Kembali'));
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
    
    function getNewAsetID(){
        $year = date('Y');
        $kelID = substr($this->uri->segment(3),0,10);
        if(!empty($kelID)){
            $newID = $kelID . "." . $year . "." . $this->Aset_model->getNewAsetID($kelID);
        }
        echo '<input type="text" readonly="readonly" name="id" value="' . $newID . '" size="30" />';
        
    }
    
    
    function add_aset(){
        $data['title'] = $this->title;
        //$data['h2_title'] = 'Aset > Input Aset';
        $data['main_view'] = 'input_aset1';
        $data['form_action'] = site_url('aset/add_aset');
        $data['link'] = array('link_back'=>  anchor('aset/view','Kembali'));
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
            'created'=>  $tgl_entry,
            'createdBy'=>  $this->session->userdata('username')
            );
        $this->Aset_model->add($aset);
        $this->session->set_flashdata('message','Data aset berhasil disimpan!');
        $data['default']['kelID']= ($kelID);
        $data['default']['kprnu'] = $this->input->post('kprnu');
        $data['default']['tgl_survey'] = $this->input->post('tgl_survey');
        $data['default']['ranting'] = $this->input->post('ranting');
        $data['default']['petugas'] = $this->input->post('petugas');
        redirect('aset/add/'.$kelID);
    }
    
    function update(){
        if($this->session->userdata('login') == TRUE and $this->session->userdata('level')!='User'){
            $data['title'] = $this->title;
            //$data['h2_title'] = 'Aset > Ubah Data Aset';
            $data['main_view'] = 'update_aset';
            $data['form_action'] = site_url('aset/update_aset');
            $data['link'] = array('link_back'=>  anchor('aset/view/','Kembali'));
            
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
            $data['default']['tgl_survey'] = $aset->tgl_survey;
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
        $data['link'] = array('link_back'=>  anchor('aset/view/','Kembali'));
        $tgl_update = date("Y-m-d");
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
            'tgl_survey'=>  $this->input->post('tgl_survey'),
            'kprnu'=>  $this->input->post('kprnu'),
            'ranting'=> $this->input->post('ranting'),
            'petugas'=> $this->input->post('petugas'),
            'updated'=>  $tgl_update,
            'updatedBy'=>  $this->session->userdata('username')
            );
            $this->Aset_model->update($this->input->post('id'),$aset);
            $this->session->set_flashdata('message','Data aset berhasil disimpan!');
            
            redirect('aset/');
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
            $this->table->set_heading('No.','ID Aset','Jenis Aset','Nama Aset','Lokasi','Ranting');
            
            $i = 0 + $offset;
            
            foreach($asets as $aset){
                $this->table->add_row(++$i,
                anchor('aset/detail/'.$aset->id,$aset->id),
                $aset->ket_jenis,
                $aset->nama_aset,
                $aset->lokasi,
                $aset->ranting);
                
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
}

?>
