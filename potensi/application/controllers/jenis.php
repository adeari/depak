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
class Jenis extends CI_Controller{
    //put your code here
    
    function Jenis(){
        parent::__construct();
        $this->load->model('Jenis_model','',TRUE);
        $this->load->model('Golongan_model','',TRUE);
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
        $data['h2_title'] = 'Klasifikasi Aset';
        $data['main_view'] = 'view_data';
        $offset_segment = 3;
        $offset = $this->uri->segment($offset_segment);
        
        $jenis = $this->Jenis_model->getAllJenis($this->limit,$offset);
        $num_rows = $this->Jenis_model->countAllJenis();
        $rec = $this->Jenis_model->countRec($this->limit,$offset);
        if($num_rows > 0){
            $config['base_url'] = site_url('jenis/view/');
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
            $this->table->set_heading('No.','Kode','Jenis Aset','Action');
            $i = 0 + $offset;
            
            foreach($jenis as $jns){
                $this->table->add_row(++$i,$jns->kode_klasifikasi,$jns->jenis,
                        anchor('jenis/update/'.$jns->id,'update').'&nbsp;'.
                        anchor('jenis/delete/'.$jns->id,'hapus',array('onclick'=>"return confirm('Data akan dihapus?')")));
            }
            $data['table'] = $this->table->generate();
        }else{
            $data['message'] = 'Tidak ada data yang ditampilkan!';
        }
        
        $data['link'] = array('link_add'=>  anchor('jenis/add','tambah data'));
        $this->load->view('theme',$data);
            
    }
    
    function add(){
        if($this->session->userdata('login') == TRUE){
            $data['title'] = $this->title;
            $data['h2_title'] = 'Jenis > Input Jenis';
            
            $data['form_action'] = site_url('jenis/add_jenis');
            $data['link'] = array('link_back'=>  anchor('jenis/','kembali'));
            $data['main_view'] = 'input_jenis';
            $this->load->view('theme',$data);
        }else{
            redirect('home');
        }
    }
    
    
    function add_jenis(){
        $data['title'] = $this->title;
        $data['h2_title'] = 'Jenis > Input Jenis';
        $data['main_view'] = 'input_jenis';
        $data['form_action'] = site_url('jenis/add_jenis');
        $data['link'] = array('link_back'=>  anchor('jenis/','kembali'));
        $jenis = array('kode_klasifikasi'=>  $this->input->post('kode_klasifikasi'),
            'jenis'=>  $this->input->post('jenis')
            );
            $this->Jenis_model->add($jenis);
            $this->session->set_flashdata('message','Data Jenis berhasil disimpan!');
            
            redirect('jenis/add/');
    }
    
    function update(){
        if($this->session->userdata('login') == TRUE){
            $data['title'] = $this->title;
            $data['h2_title'] = 'Jenis > Ubah Data Jenis';
            $data['main_view'] = 'update_jenis';
            $data['form_action'] = site_url('jenis/update_jenis');
            $data['link'] = array('link_back'=>  anchor('jenis/','kembali'));
            
            $id = $this->uri->segment(3);
            $jenis = $this->Jenis_model->getJenisByID($id)->row();
            $this->session->set_userdata('id',$jenis->id);
            $data['default']['id'] = $jenis->id;
            $data['default']['kode_klasifikasi'] = $jenis->kode_klasifikasi;
            $data['default']['jenis'] = $jenis->jenis;
            
            $this->load->view('theme',$data);
        }else{
            redirect('home');
        }
    }
    
    function update_jenis(){
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
            $jenis = $this->Jenis_model->delete($id);
            
            redirect('jenis/');
        }else{
            redirect('home');
        }
    }
    
    function getJenis(){
         $kode_jenis = $this->uri->segment(3);
         $jenis = $this->Jenis_model->getJenis($kode_jenis)->row();
         $num_rows = $this->Jenis_model->getJenis($kode_jenis)->num_rows();
         $gol = substr($kode_jenis, 0, 1);
         $golongan = $this->Golongan_model->getGolonganByID($gol);
         if($num_rows > 0){
            //if($jenis->jenis=='Lain-lain'){
            //    echo '<INPUT type="text" name="golongan" size="15" readonly="readonly" value="' . $golongan->golongan . '" />';
            //    echo '<INPUT type="text" name="ket_jenis" size="15" />';
            //}else{
                echo '<INPUT type="text" name="golongan" size="15" readonly="readonly" value="' . $golongan->golongan . '" /><br />';
                echo '<INPUT type="text" name="ket_jenis" size="40" value="' . $jenis->jenis . '" />';
            //}
         }else{
             echo 'Jenis Aset tidak ada!';
         }
    }
}

?>
