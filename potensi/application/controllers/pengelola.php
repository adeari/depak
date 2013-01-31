<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of jenis
 *
 * @author newDomas
 */
class Pengelola extends CI_Controller{
    //put your code here
    
    function Pengelola(){
        parent::__construct();
        $this->load->model('Pengelola_model','',TRUE);
    }
    
    var $title = 'Pengelola';
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
        $data['h2_title'] = 'Pengelola';
        $data['main_view'] = 'view_data';
        $offset_segment = 3;
        $offset = $this->uri->segment($offset_segment);
        
        $pengelola = $this->Pengelola_model->getAllPengelola($this->limit,$offset);
        $num_rows = $this->Pengelola_model->countAllPengelola();
        $rec = $this->Pengelola_model->countRec($this->limit,$offset);
        if($num_rows > 0){
            $config['base_url'] = site_url('pengelola/view/');
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
            $this->table->set_heading('No.','Pengelola','Action');
            $i = 0 + $offset;
            
            foreach($pengelola as $row){
                $this->table->add_row(++$i,$row->pengelola,
                        anchor('pengelola/update/'.$row->id,'update').'&nbsp;'.
                        anchor('pengelola/delete/'.$row->id,'hapus',array('onclick'=>"return confirm('Data akan dihapus?')")));
            }
            $data['table'] = $this->table->generate();
        }else{
            $data['message'] = 'Tidak ada data yang ditampilkan!';
        }
        
        $data['link'] = array('link_add'=>  anchor('pengelola/add','tambah data'));
        $this->load->view('theme',$data);
            
    }
    
    function add(){
        if($this->session->userdata('login') == TRUE){
            $data['title'] = $this->title;
            $data['h2_title'] = 'Pengelola > Input Pengelola';
            
            $data['form_action'] = site_url('pengelola/add_pengelola');
            $data['link'] = array('link_back'=>  anchor('pengelola/','kembali'));
            $data['main_view'] = 'input_pengelola';
            $this->load->view('theme',$data);
        }else{
            redirect('home');
        }
    }
    
    
    function add_pengelola(){
        $data['title'] = $this->title;
        $data['h2_title'] = 'Pengelola > Input Pengelola';
        $data['main_view'] = 'input_pengelola';
        $data['form_action'] = site_url('pengelola/add_pengelola');
        $data['link'] = array('link_back'=>  anchor('pengelola/','kembali'));
        $pengelola = array('pengelola'=>  $this->input->post('pengelola'));
        $this->Pengelola_model->add($pengelola);
        $this->session->set_flashdata('message','Data Pengelola berhasil disimpan!');
            
        redirect('pengelola/add/');
    }
    
    function update(){
        if($this->session->userdata('login') == TRUE){
            $data['title'] = $this->title;
            $data['h2_title'] = 'Pengelola > Ubah Data Pengelola';
            $data['main_view'] = 'update_pengelola';
            $data['form_action'] = site_url('pengelola/update_pengelola');
            $data['link'] = array('link_back'=>  anchor('pengelola/','kembali'));
            
            $id = $this->uri->segment(3);
            $pengelola = $this->Pengelola_model->getPengelolaByID($id)->row();
            $this->session->set_userdata('id',$pengelola->id);
            $data['default']['id'] = $pengelola->id;
            $data['default']['pengelola'] = $pengelola->pengelola;
            
            $this->load->view('theme',$data);
        }else{
            redirect('home');
        }
    }
    
    function update_pengelola(){
        $data['title'] = $this->title;
        $data['h2_title'] = 'Pengelola > Update Data Pengelola';
        $data['main_view'] = 'update_pengelola';
        $data['form_action'] = site_url('pengelola/update_pengelola');
        $data['link'] = array('link_back'=>  anchor('pengelola/','kembali'));
        
        $pengelola = array('id'=>  $this->input->post('id'),
            'pengelola'=>  $this->input->post('pengelola')
            );
        $this->Pengelola_model->update($this->input->post('id'),$pengelola);
        $this->session->set_flashdata('message','Data Pengelola berhasil disimpan!');
            
        redirect('pengelola/');
    }
    
    function delete(){
        if($this->session->userdata('login') == TRUE){
            
            $id = $this->uri->segment(3);
            $pengelola = $this->Pengelola_model->delete($id);
            
            redirect('pengelola/');
        }else{
            redirect('home');
        }
    }
    
    function getPengelola(){
         $pengelolaID = $this->uri->segment(3);
         $pengelola = $this->Pengelola_model->getPengelolaByID($pengelolaID)->row();
         $num_rows = $this->Pengelola_model->getPengelolaByID($pengelolaID)->num_rows();
         if($num_rows > 0){
            if($pengelola->pengelola=='Lainnya'){
                echo '<INPUT type="text" name="ket_pengelola" size="10">';
            }else{
                echo '<INPUT type="hidden" name="ket_pengelola" size="10" value="' . $pengelola->pengelola . '" />';
            }
         }
    }
    
}

?>
