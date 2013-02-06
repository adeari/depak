<?php

/*
 * To change this theme, choose Tools | themes
 * and open the theme in the editor.
 */

/**
 * Description of kecamatan
 *
 * @author newDomas
 */
class Kecamatan extends CI_Controller{
    //put your code here
    function Kecamatan(){
        parent::__construct();
        $this->load->model('Propinsi_model','',TRUE);
        $this->load->model('Kota_model','',TRUE);
        $this->load->model('Kecamatan_model','',TRUE);
    }
    
    var $title = 'Kecamatan';
    var $limit = 20;
    
    function index(){
        $this->showPropinsi();
    }
    
    function showPropinsi($offset=0){
        if($this->session->userdata('login') == TRUE){
            $data['title'] = $this->title;
            $data['h2_title'] = 'Propinsi';
            $data['main_view'] = 'view_data';
            $offset_segment = 3;
            $offset = $this->uri->segment($offset_segment);
            
            $propinsi = $this->Propinsi_model->getPropinsi();
            $num_rows = $this->Propinsi_model->countPropinsi();
            $rec = $this->Propinsi_model->countRec($this->limit, $offset);
            
            if($num_rows > 0){
                $config['base_url'] = site_url('propinsi/');
                $config['total_rows'] = $num_rows;
                $config['per_page'] = $this->limit;
                //$config['uri_segment'] = $offset_segment;
                $this->pagination->initialize($config);
                $data['pagination'] = $this->pagination->create_links();
                $data['num_rows'] = $num_rows;
                $data['rec'] = $offset + $rec;
                
                $tmpl = array('table_open' => '<table border="0" cellpadding="0" cellspacing="0">',
                    'row_alt_start' => '<tr class="zebra">','row_alt_end' => '</tr>');

                $this->table->set_template($tmpl);
                $this->table->set_empty("&nbsp;");
                $this->table->set_heading('No.','ID Propinsi','Nama Propinsi','Action');
                $i = 0 ;

                foreach($propinsi as $prop){
                    $this->table->add_row(++$i,$prop->propinsiID,$prop->namaPropinsi,
                            anchor('kecamatan/showKota/'.$prop->propinsiID,'view'));
                }
                $data['table'] = $this->table->generate();
            }else{
                $data['message'] = 'Tidak ada data yang ditampilkan!';
            }

            $data['link'] = array('link_add'=>  anchor('propinsi/add','tambah data'));
            $this->load->view('theme',$data);
        }else{
            redirect('home');
        }
    }
    
    function liat(){
        $kotaID = $this->uri->segment(3);
        $kecamatan = $this->Kecamatan_model->getKecamatan($kotaID);
        foreach($kecamatan as $kec){
            echo $kec->kecamatanID. ' - ' . $kec->namaKecamatan . '<br />';
                }
                echo $this->Kecamatan_model->countKecamatan($kotaID);
    }
    
    function viewKecamatan($kotaID, $offset=0){
        if($this->session->userdata('login') == TRUE){
            $data['title'] = $this->title;
            $data['h2_title'] = 'Kecamatan';
            $data['main_view'] = 'view_data';
            $uri_segment = 3;
            $offset_segment = 4;

            $kotaID = $this->uri->segment($uri_segment);
            $offset = $this->uri->segment($offset_segment);

            $kecamatan = $this->Kecamatan_model->getKec($kotaID,  $this->limit,$offset);
            $num_rows = $this->Kecamatan_model->countKecamatan($kotaID);
            $rec = $this->Kecamatan_model->countRec($kotaID,  $this->limit,$offset);
            if($num_rows > 0){
                $config['base_url'] = site_url('kecamatan/viewKecamatan/'.$kotaID);
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
                $this->table->set_heading('No.','ID Kecamatan','Nama Kecamatan','Action');
                $i = 0 ;

                foreach($kecamatan as $kec){
                    $this->table->add_row(++$i,$kec->kecamatanID,$kec->namaKecamatan,
                            anchor('kecamatan/update/'.$kec->kecamatanID,'update').'&nbsp;'. 
                            anchor('kecamatan/delete/'.$kec->kecamatanID,'hapus',
                            array('onclick'=>"return confirm('Data akan dihapus?')")));
                }
                $data['table'] = $this->table->generate();
            }else{
                $data['message'] = 'Tidak ada data yang ditampilkan!';
            }

            $data['link'] = array('link_add'=>  anchor('kecamatan/add/'.$this->uri->segment(3),'tambah data'));
            
            $this->load->view('theme',$data);
        }else{
            redirect('home');
        }

    }
    
    function getKecamatan(){
        $kotaID = substr($this->uri->segment(3),0,4);
        $kecID = substr($this->uri->segment(3),0,6);
        $kecamatan = $this->Kecamatan_model->getKecamatan($kotaID);
        echo 'Kecamatan<br />';
        echo '<SELECT name="kecamatan" onchange="ambil_kel($(this).val())" style="width:220px">';
        echo '<option value="">-- pilih --</option>';
        foreach($kecamatan as $data){
            if($data->kecamatanID == $kecID){
                echo '<option value="' . $data->kecamatanID . '" selected>' . $data->namaKecamatan . '</option>';
            }else{
                echo '<option value="' . $data->kecamatanID . '">' . $data->namaKecamatan . '</option>';
            }
        }
        echo '</select>';
        
    }
    
    
    function getRekapKec(){
        $kotaID = substr($this->uri->segment(3),0,4);
        $kecamatan = $this->Kecamatan_model->getKecamatan($kotaID);
        echo 'Kecamatan<br />';
        echo '<SELECT name="kecamatan" onchange="rekap_kel($(this).val())" style="width:180px">';
        echo '<option value="">-- pilih --</option>';
        foreach($kecamatan as $data){
            echo '<option value="' . $data->kecamatanID . '">' . $data->namaKecamatan . '</option>';
        }
        echo '</select>';
        
    }
    
    function showKota($propinsiID,$offset=0){
        if($this->session->userdata('login') == TRUE){
            $data['title'] = $this->title;
            $data['h2_title'] = 'Kota';
            $data['main_view'] = 'view_data';
            $uri_segment = 3;
            $offset_segment = 4;

            $kotaID = $this->uri->segment($uri_segment);
            $offset = $this->uri->segment($offset_segment);

            $kota = $this->Kota_model->getKota($propinsiID);
            $num_rows = $this->Kota_model->countKota($propinsiID);
            $rec = $this->Kota_model->countRec($propinsiID,$this->limit, $offset);
            if($num_rows > 0){
                $config['base_url'] = site_url('kota/');
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
                $this->table->set_heading('No.','ID Kota','Nama Kota','Action');
                $i = 0 ;

                foreach($kota as $city){
                    $this->table->add_row(++$i,$city->kotaID,$city->namaKota,
                            anchor('kecamatan/viewKecamatan/'.$city->kotaID,'view'));
                }
                $data['table'] = $this->table->generate();
            }else{
                $data['message'] = 'Tidak ada data yang ditampilkan!';
            }

            $data['link'] = array('link_add'=>  anchor('kota/add/'.$propinsiID,'tambah data'));
            $this->load->view('theme',$data);
        }else{
            redirect('home');
        }
    
    }
    
    function add(){
        if($this->session->userdata('login') == TRUE){
            $data['title'] = $this->title;
            $data['h2_title'] = 'Kecamatan > Input Data Kecamatan';
            $data['main_view'] = 'input_kecamatan';
            $data['form_action'] = site_url('kecamatan/add_kecamatan');
            $data['link'] = array('link_back'=>  anchor('kecamatan/','kembali'));
            $this->load->view('theme',$data);
        }else{
            redirect('home');
        }
    }
    
    function add_kecamatan(){
        $data['title'] = $this->title;
        $data['h2_title'] = 'Kecamatan > Input Data Kecamatan';
        $data['main_view'] = 'input_kecamatan';
        $data['form_action'] = site_url('kecamatan/add_kecamatan');
        $data['link'] = array('link_back'=>  anchor('kecamatan/','kembali'));
        $kotaID = $this->input->post('kecamatanID');
        $kotaID = substr($kotaID, 0, 4);
        $kecamatan = array('kecamatanID'=>  $this->input->post('kecamatanID'),
            'kotaID'=>  $kotaID,
            'namaKecamatan'=>  $this->input->post('namaKecamatan'),
            'created'=> date('Y-m-d'),
            'createdBy'=>  $this->session->userdata('username')
            );
            $this->Kecamatan_model->add($kecamatan);
            $this->session->set_flashdata('message','Data kecamatan berhasil disimpan!');
            
            redirect('kecamatan/add/'.$kotaID);
    }

    function update_kecamatan(){
        $data['title'] = $this->title;
        $data['h2_title'] = 'Kecamatan > Update Data Kecamatan';
        $data['main_view'] = 'update_kecamatan';
        $data['form_action'] = site_url('kecamatan/update_kecamatan');
        $data['link'] = array('link_back'=>  anchor('kecamatan/viewKecamatan/'. $this->input->post('kotaID'),'kembali'));
        $kotaID = $this->input->post('kecamatanID');
        $kotaID = substr($kotaID, 0, 4);
        $kecamatan = array('kecamatanID'=>  $this->input->post('kecamatanID'),
            'kotaID'=>  $kotaID,
            'namaKecamatan'=>  $this->input->post('namaKecamatan'),
            'updated'=>  date('Y-m-d'),
            'updatedBy'=>  $this->session->userdata('username')
            );
            $this->Kecamatan_model->update($this->input->post('kecamatanID'),$kecamatan);
            $this->session->set_flashdata('message','Data kecamatan berhasil disimpan!');
            
            redirect('kecamatan/');
    }
    
    function update(){
        if($this->session->userdata('login') == TRUE){
            $data['title'] = $this->title;
            $data['h2_title'] = 'Kecamatan > Ubah Data Kecamatan';
            $data['main_view'] = 'update_kecamatan';
            $data['form_action'] = site_url('kecamatan/update_kecamatan');
            $data['link'] = array('link_back'=>  anchor('kecamatan/','kembali'));

            $id = $this->uri->segment(3);
            $kecamatan = $this->Kecamatan_model->getKecamatanByID($id);
            $this->session->set_userdata('kecamatanID',$id);
            $data['default']['kecamatanID'] = $kecamatan->kecamatanID;
            $data['default']['kotaID'] = $kecamatan->kotaID;
            $data['default']['namaKecamatan'] = $kecamatan->namaKecamatan;
            
            $this->load->view('theme',$data);
        }else{
            redirect('home');
        }
    }
    
    function delete(){
        if($this->session->userdata('login') == TRUE){
            
            $id = $this->uri->segment(3);
            $kecamatan = $this->Kecamatan_model->delete($id);
            
            redirect('kecamatan/');
        }else{
            redirect('home');
        }
    }
}

?>
