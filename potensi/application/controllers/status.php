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
class Status extends CI_Controller{
    //put your code here
    
    function Status(){
        parent::__construct();
        $this->load->model('Status_model','',TRUE);
    }
    
    var $title = 'Status Tanah';
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
        $data['h2_title'] = 'Status Tanah';
        $data['main_view'] = 'view_data';
        $offset_segment = 3;
        $offset = $this->uri->segment($offset_segment);
        
        $status = $this->Status_model->getAllStatusTanah($this->limit,$offset);
        $num_rows = $this->Status_model->countAllStatusTanah();
        $rec = $this->Status_model->countRec($this->limit,$offset);
        if($num_rows > 0){
            $config['base_url'] = site_url('status/view/');
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
            $this->table->set_heading('No.','Status Tanah','Action');
            $i = 0 + $offset;
            
            foreach($status as $row){
                $this->table->add_row(++$i,$row->status_tanah,
                        anchor('status/update/'.$row->id,'update').'&nbsp;'.
                        anchor('status/delete/'.$row->id,'hapus',array('onclick'=>"return confirm('Data akan dihapus?')")));
            }
            $data['table'] = $this->table->generate();
        }else{
            $data['message'] = 'Tidak ada data yang ditampilkan!';
        }
        
        $data['link'] = array('link_add'=>  anchor('status/add','tambah data'));
        $this->load->view('theme',$data);
            
    }
    
    function add(){
        if($this->session->userdata('login') == TRUE){
            $data['title'] = $this->title;
            $data['h2_title'] = 'Status Tanah > Input Status Tanah';
            
            $data['form_action'] = site_url('status/add_status');
            $data['link'] = array('link_back'=>  anchor('status/','kembali'));
            $data['main_view'] = 'input_status';
            $this->load->view('theme',$data);
        }else{
            redirect('home');
        }
    }
    
    
    function add_status(){
        $data['title'] = $this->title;
        $data['h2_title'] = 'Status Tanah > Input Status Tanah';
        $data['main_view'] = 'input_status';
        $data['form_action'] = site_url('status/add_status');
        $data['link'] = array('link_back'=>  anchor('status/','kembali'));
        $status = array('status_tanah'=>  $this->input->post('status_tanah'));
        $this->Status_model->add($status);
        $this->session->set_flashdata('message','Data Status Tanah berhasil disimpan!');
            
        redirect('status/add/');
    }
    
    function update(){
        if($this->session->userdata('login') == TRUE){
            $data['title'] = $this->title;
            $data['h2_title'] = 'Status Tanah > Ubah Data Status Tanah';
            $data['main_view'] = 'update_status';
            $data['form_action'] = site_url('status/update_status');
            $data['link'] = array('link_back'=>  anchor('status/','kembali'));
            
            $id = $this->uri->segment(3);
            $status = $this->Status_model->getStatusTanahByID($id)->row();
            $this->session->set_userdata('id',$status->id);
            $data['default']['id'] = $status->id;
            $data['default']['status_tanah'] = $status->status_tanah;
            
            $this->load->view('theme',$data);
        }else{
            redirect('home');
        }
    }
    
    function update_status(){
        $data['title'] = $this->title;
        $data['h2_title'] = 'Status Tanah > Update Data Status Tanah';
        $data['main_view'] = 'update_status';
        $data['form_action'] = site_url('status/update_status');
        $data['link'] = array('link_back'=>  anchor('status/','kembali'));
        
        $status = array('id'=>  $this->input->post('id'),
            'status_tanah'=>  $this->input->post('status_tanah')
            );
        $this->Status_model->update($this->input->post('id'),$status);
        $this->session->set_flashdata('message','Data Status Tanah berhasil disimpan!');
            
        redirect('status/');
    }
    
    function delete(){
        if($this->session->userdata('login') == TRUE){
            
            $id = $this->uri->segment(3);
            $status = $this->Status_model->delete($id);
            
            redirect('status/');
        }else{
            redirect('home');
        }
    }
    
    function getStatus(){
         $statusID = $this->uri->segment(3);
         $status = $this->Status_model->getStatusTanahByID($statusID)->row();
         $num_rows = $this->Status_model->getStatusTanahByID($statusID)->num_rows();
         if($num_rows > 0){
            if($status->status_tanah=='Lainnya'){
                echo '<INPUT type="text" name="ket_status" size="10">';
            }else{
                echo '<INPUT type="hidden" name="ket_status" size="10" value="' . $status->status_tanah . '" />';
            }
         }
    }
    
}

?>
