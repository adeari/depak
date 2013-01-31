<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of penguna
 *
 * @author newDomas
 */
class Pengguna extends CI_Controller{
    //put your code here
    
    function Pengguna(){
        parent::__construct();
        $this->load->model('User_model','',TRUE);
    }
    
    var $title = 'Klasifikasi';
    var $limit = 20;
    
    function index(){
        if($this->session->userdata('login') == TRUE){
            $this->view();
        }else{
            redirect('home');
        }
    }
    
    function view($offset=0){
        $data['title'] = $this->title;
        $data['h2_title'] = 'Daftar Pengguna';
        $data['main_view'] = 'view_data';
        $offset_segment = 3;
        $offset = $this->uri->segment($offset_segment);
        
        $users = $this->User_model->getAllUser($this->limit,$offset);
        $num_rows = $this->User_model->countAllUser();
        $rec = $this->User_model->countRec($this->limit,$offset);
        if($num_rows > 0){
            $config['base_url'] = site_url('pengguna/view/');
            $config['total_rows'] = $num_rows;
            $config['per_page'] = $this->limit;
            $config['uri_segment'] = $offset_segment;
            $this->pagination->initialize($config);
            $data['pagination'] = $this->pagination->create_links();
            $data['num_rows'] = $num_rows;
            $data['rec'] = $offset + $rec;
            $tmpl = array('table_open' => '<table border="0" cellpadding="0" cellspacing="0">',
                'row_alt_start' => '<tr class="zebra">','row_alt_end' => '</tr>');
            
            $this->table->set_template($tmpl);
            $this->table->set_empty("&nbsp;");
            $this->table->set_heading('No.','Username','Nama Pengguna','Level Akses','Action');
            $i = 0 + $offset;
            
            foreach($users as $usr){
                $this->table->add_row(++$i,$usr->username,$usr->nama,$usr->akses,
                        anchor('pengguna/update/'.$usr->id,'update').'&nbsp;'.
                        anchor('pengguna/delete/'.$usr->id,'hapus',array('onclick'=>"return confirm('Data akan dihapus?')")));
            }
            $data['table'] = $this->table->generate();
        }else{
            $data['message'] = 'Tidak ada data yang ditampilkan!';
        }
        
        $data['link'] = array('link_add'=>  anchor('pengguna/add','Tambah data pengguna'));
        $this->load->view('theme',$data);
            
    }
    
    function add(){
        if($this->session->userdata('login') == TRUE){
            $data['title'] = $this->title;
            $data['h2_title'] = 'Input Data Pengguna';
            
            $data['form_action'] = site_url('pengguna/add_pengguna');
            $data['link'] = array('link_back'=>  anchor('pengguna/','kembali'));
            $data['main_view'] = 'input_pengguna';
            $this->load->view('theme',$data);
        }else{
            redirect('home');
        }
    }
    
    
    function add_pengguna(){
        $data['title'] = $this->title;
        $data['h2_title'] = 'Pengguna > Input Data Pengguna';
        $data['main_view'] = 'input_pengguna';
        $data['form_action'] = site_url('pengguna/add_pengguna');
        $data['link'] = array('link_back'=>  anchor('pengguna/','kembali'));
        $pengguna = array('user'=>  $this->input->post('user'),
            'pengguna'=>  $this->input->post('pengguna')
            );
            $this->User_model->add($pengguna);
            $this->session->set_flashdata('message','Data Jenis berhasil disimpan!');
            
            redirect('pengguna/add/');
    }
    
    function update(){
        if($this->session->userdata('login') == TRUE){
            $data['title'] = $this->title;
            $data['h2_title'] = 'Ubah Data Pengguna';
            $data['main_view'] = 'update_pengguna';
            $data['form_action'] = site_url('pengguna/update_pengguna');
            $data['link'] = array('link_back'=>  anchor('pengguna/','kembali'));
            
            $id = $this->uri->segment(3);
            $pengguna = $this->User_model->getUserByID($id)->row();
            $this->session->set_userdata('id',$pengguna->id);
            $data['default']['id'] = $pengguna->id;
            $data['default']['username'] = $pengguna->username;
            $data['default']['nama'] = $pengguna->nama;
            
            $this->load->view('theme',$data);
        }else{
            redirect('home');
        }
    }
    
    function update_pengguna(){
        $data['title'] = $this->title;
        $data['h2_title'] = 'Jenis > Update Data Jenis';
        $data['main_view'] = 'update_jenis';
        $data['form_action'] = site_url('jenis/update_jenis');
        $data['link'] = array('link_back'=>  anchor('jenis/','kembali'));
        
        $jenis = array('id'=>  $this->input->post('id'),
            'kode_klasifikasi'=>  $this->input->post('kode_klasifikasi'),
            'jenis'=>  $this->input->post('jenis')
            );
            $this->Jenis_model->update($this->input->post('id'),$jenis);
            $this->session->set_flashdata('message','Data jenis berhasil disimpan!');
            
            redirect('jenis/');
    }
    
    function delete(){
        if($this->session->userdata('login') == TRUE){
            
            $id = $this->uri->segment(3);
            $jenis = $this->User_model->delete($id);
            
            redirect('pengguna/');
        }else{
            redirect('home');
        }
    }
    
    
}

?>
