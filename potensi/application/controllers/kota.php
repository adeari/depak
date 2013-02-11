<?php

/*
 * To change this theme, choose Tools | themes
 * and open the theme in the editor.
 */

/**
 * Description of kota
 *
 * @author newDomas
 */
class Kota extends CI_Controller{
    //put your code here
    
    function Kota(){
        parent::__construct();
        $this->load->model('Propinsi_model','',TRUE);
        $this->load->model('Kota_model','',TRUE);
    }
    
    var $title = 'Kota';
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
                            anchor('kota/viewKota/'.$prop->propinsiID,'view'));
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
    
    function viewKota($propinsiID,$offset=0){
        if($this->session->userdata('login') == TRUE){
            $data['title'] = $this->title;
            $data['h2_title'] = 'Kota';
            $data['main_view'] = 'view_data';
            $uri_segment = 3;
            $offset_segment = 4;

            $propinsiID = $this->uri->segment($uri_segment);
            $offset = $this->uri->segment($offset_segment);

            $kota = $this->Kota_model->getKota($propinsiID);
            $num_rows = $this->Kota_model->countKota($propinsiID);
            $rec = $this->Kota_model->countRec($propinsiID,$this->limit, $offset);
            if($num_rows > 0){
                $config['base_url'] = site_url('kota/viewKota/');
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
                            anchor('kota/update/'.$city->kotaID,'update').'&nbsp;'. 
                            anchor('kota/delete/'.$city->kotaID,'hapus',
                            array('onclick'=>"return confirm('Data akan dihapus?')")));
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
    
    function getKota(){
        $propinsiID = substr($this->uri->segment(3),0,2);
        $kotaID = substr($this->uri->segment(3),0,4);
        $kota = $this->Kota_model->getKota($propinsiID);
        echo 'Kota<br />';
        echo '<SELECT name="kota" onchange="ambil_kec($(this).val())" style="width:220px">';
        echo '<option value="">-- pilih --</option>';
        foreach($kota as $data){
            if($data->kotaID == $kotaID){
                echo '<option value="' . $data->kotaID . '" selected>' . $data->namaKota . '</option>';
            }else{
                echo '<option value="' . $data->kotaID . '">' . $data->namaKota . '</option>';
            }
        }
        echo '</select>';
    }
    
    function getKotaRPaset(){
    	$propinsiID = $this->uri->segment(3);
    	$kotaID = $this->uri->segment(4);
    	$kota = $this->Kota_model->getKota($propinsiID);
    	echo 'Kota<br />';
    	echo '<SELECT name="kota" onchange="ambil_kecInRPaset($(this).val(),true)" style="width:220px">';
    	echo '<option value="">-- pilih --</option>';
    	foreach($kota as $data){
    		if($data->kotaID == $kotaID){
    			echo '<option value="' . $data->kotaID . '" selected>' . $data->namaKota . '</option>';
    		}else{
    			echo '<option value="' . $data->kotaID . '">' . $data->namaKota . '</option>';
    		}
    	}
    	echo '</select>';
    }
    
    function getRekapKota(){
        $propinsiID = substr($this->uri->segment(3),0,2);
        $kota = $this->Kota_model->getKota($propinsiID);
        echo 'Kota<br />';
        echo '<SELECT name="kota" onchange="rekap_kec($(this).val())" style="width:180px">';
        echo '<option value="">-- pilih --</option>';
        foreach($kota as $data){
            echo '<option value="' . $data->kotaID . '">' . $data->namaKota . '</option>';
        }
        echo '</select>';
    }
    
    function add(){
        if($this->session->userdata('login') == TRUE){
            $data['title'] = $this->title;
            $data['h2_title'] = 'Kota > Input Data Kota';
            $data['main_view'] = 'input_kota';
            $data['form_action'] = site_url('kota/add_kota');
            $data['link'] = array('link_back'=>  anchor('kota/','kembali'));

            $this->load->view('theme',$data);
        }else{
            redirect('home');
        }
    }
    
    function add_kota(){
        $data['title'] = $this->title;
        $data['h2_title'] = 'Kota > Input Data Kota';
        $data['main_view'] = 'input_kota';
        $data['form_action'] = site_url('kota/add_kota');
        $data['link'] = array('link_back'=>  anchor('kota/','kembali'));
        
        $kota = array('kotaID'=>  $this->input->post('kotaID'),
            'propinsiID'=>  $this->input->post('propinsiID'),
            'namaKota'=>  $this->input->post('namaKota'),
            'created'=> date('Y-m-d'),
            'createdBy'=>  $this->session->userdata('username')
            );
            $this->Kota_model->add($kota);
            $this->session->set_flashdata('message','Data kota berhasil disimpan!');
            
            redirect('kota/add');
    }

    function update_kota(){
        $data['title'] = $this->title;
        $data['h2_title'] = 'Kota > Update Data Kota';
        $data['main_view'] = 'update_kota';
        $data['form_action'] = site_url('kota/update_kota');
        $data['link'] = array('link_back'=>  anchor('kota/viewKota/'. $this->input->post('kotaID'),'kembali'));
        
        $kota = array('kotaID'=>  $this->input->post('kotaID'),
            'propinsiID'=>  $this->input->post('propinsiID'),
            'namaKota'=>  $this->input->post('namaKota'),
            'updated'=>  date('Y-m-d'),
            'updatedBy'=>  $this->session->userdata('username')
            );
            $this->Kota_model->update($this->input->post('kotaID'),$kota);
            $this->session->set_flashdata('message','Data kota berhasil disimpan!');
            
            redirect('kota/');
    }
    
    function update(){
        if($this->session->userdata('login') == TRUE){
            $data['title'] = $this->title;
            $data['h2_title'] = 'Kota > Ubah Data Kota';
            $data['main_view'] = 'update_kota';
            $data['form_action'] = site_url('kota/update_kota');
            $data['link'] = array('link_back'=>  anchor('kota/','kembali'));

            $id = $this->uri->segment(3);
            $kota = $this->Kota_model->getKotaByID($id);
            $this->session->set_userdata('kotaID',$id);
            $data['default']['kotaID'] = $kota->kotaID;
            $data['default']['propinsiID'] = $kota->propinsiID;
            $data['default']['namaKota'] = $kota->namaKota;
            
            $this->load->view('theme',$data);
        }else{
            redirect('home');
        }
    }
    
    function delete(){
        if($this->session->userdata('login') == TRUE){
            
            $id = $this->uri->segment(3);
            $kota = $this->Kota_model->delete($id);
            
            redirect('kota/');
        }else{
            redirect('home');
        }
    }

}

?>
