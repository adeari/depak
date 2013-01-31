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
class Bukti extends CI_Controller{
    //put your code here
    
    function Bukti(){
        parent::__construct();
        $this->load->model('Bukti_model','',TRUE);
    }
    
    var $title = 'Bukti Kepemilikan';
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
        $data['h2_title'] = 'Bukti Kepemilikan';
        $data['main_view'] = 'view_data';
        $offset_segment = 3;
        $offset = $this->uri->segment($offset_segment);
        
        $bukti = $this->Bukti_model->getAllBuktiMilik($this->limit,$offset);
        $num_rows = $this->Bukti_model->countAllBuktiMilik();
        $rec = $this->Bukti_model->countRec($this->limit,$offset);
        if($num_rows > 0){
            $config['base_url'] = site_url('bukti/view/');
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
            $this->table->set_heading('No.','Bukti Kepemilikan','Action');
            $i = 0 + $offset;
            
            foreach($bukti as $row){
                if($this->session->userdata('level')=='Administrator' || 
                    $this->session->userdata('level')=='Supervisor'){
                    $this->table->add_row(++$i,$row->bukti_milik,
                        anchor('bukti/update/'.$row->id,'update').'&nbsp;'.
                        anchor('bukti/delete/'.$row->id,'hapus',array('onclick'=>"return confirm('Data akan dihapus?')")));
                }else{
                    $this->table->add_row(++$i,$row->bukti_milik,'update'.'&nbsp;'.
                        'hapus');
                }
            }
            $data['table'] = $this->table->generate();
        }else{
            $data['message'] = 'Tidak ada data yang ditampilkan!';
        }
        
        if($this->session->userdata('level')!='User'){
            $data['link'] = array('link_add'=>  anchor('bukti/add','tambah data'));
        }
        $this->load->view('theme',$data);
            
    }
    
    function add(){
        if($this->session->userdata('login') == TRUE){
            $data['title'] = $this->title;
            $data['h2_title'] = 'Bukti Kepemilikan > Input Bukti Kepemilikan';
            
            $data['form_action'] = site_url('bukti/add_bukti');
            $data['link'] = array('link_back'=>  anchor('bukti/','kembali'));
            $data['main_view'] = 'input_bukti';
            $this->load->view('theme',$data);
        }else{
            redirect('home');
        }
    }
    
    
    function add_bukti(){
        $data['title'] = $this->title;
        $data['h2_title'] = 'Bukti Kepemilikan > Input Bukti Kepemilikan';
        $data['main_view'] = 'input_bukti';
        $data['form_action'] = site_url('bukti/add_bukti');
        $data['link'] = array('link_back'=>  anchor('bukti/','kembali'));
        $bukti = array('bukti_milik'=>  $this->input->post('bukti_milik'));
        $this->Bukti_model->add($bukti);
        $this->session->set_flashdata('message','Data Bukti Kepemilikan berhasil disimpan!');
            
        redirect('bukti/add/');
    }
    
    function update(){
        if($this->session->userdata('login') == TRUE){
            $data['title'] = $this->title;
            $data['h2_title'] = 'Bukti Kepemilikan > Ubah Data Bukti Kepemilikan';
            $data['main_view'] = 'update_bukti';
            $data['form_action'] = site_url('bukti/update_bukti');
            $data['link'] = array('link_back'=>  anchor('bukti/','kembali'));
            
            $id = $this->uri->segment(3);
            $bukti = $this->Bukti_model->getBuktiMilikByID($id)->row();
            $this->session->set_userdata('id',$bukti->id);
            $data['default']['id'] = $bukti->id;
            $data['default']['bukti_milik'] = $bukti->bukti_milik;
            
            $this->load->view('theme',$data);
        }else{
            redirect('home');
        }
    }
    
    function update_bukti(){
        $data['title'] = $this->title;
        $data['h2_title'] = 'Bukti Kepemilikan > Update Data Bukti Kepemilikan';
        $data['main_view'] = 'update_bukti';
        $data['form_action'] = site_url('bukti/update_bukti');
        $data['link'] = array('link_back'=>  anchor('bukti/','kembali'));
        
        $bukti = array('id'=>  $this->input->post('id'),
            'bukti_milik'=>  $this->input->post('bukti_milik')
            );
        $this->Bukti_model->update($this->input->post('id'),$bukti);
        $this->session->set_flashdata('message','Data Bukti Kepemilikan berhasil disimpan!');
            
        redirect('bukti/');
    }
    
    function delete(){
        if($this->session->userdata('login') == TRUE){
            
            $id = $this->uri->segment(3);
            $bukti = $this->Bukti_model->delete($id);
            
            redirect('bukti/');
        }else{
            redirect('home');
        }
    }
    
    function getBukti(){
         $buktiID = $this->uri->segment(3);
         $bukti = $this->Bukti_model->getBuktiMilikByID($buktiID)->row();
         $num_rows = $this->Bukti_model->getBuktiMilikByID($buktiID)->num_rows();
         if($num_rows > 0){
            if($bukti->bukti_milik=='Lainnya'){
                echo '<INPUT type="text" name="ket_bukti" size="10">';
            }else{
                echo '<INPUT type="hidden" name="ket_bukti" size="10" value="' . $bukti->bukti_milik . '" />';
            }
         }
    }
    
}

?>
