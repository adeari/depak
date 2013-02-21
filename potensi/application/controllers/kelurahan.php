<?php

/*
 * To change this theme, choose Tools | themes
 * and open the theme in the editor.
 */

/**
 * Description of kelurahan
 *
 * @author newDomas
 */
class Kelurahan extends CI_Controller{
    //put your code here
    function Kelurahan(){
        parent::__construct();
        $this->load->model('Propinsi_model','',TRUE);
        $this->load->model('Kota_model','',TRUE);
        $this->load->model('Kecamatan_model','',TRUE);
        $this->load->model('Kelurahan_model','',TRUE);
    }
    
    var $title = 'Kelurahan';
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
                            anchor('kelurahan/showKota/'.$prop->propinsiID,'view'));
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
    
    function getKelurahan(){
        $kecamatanID = substr($this->uri->segment(3),0,6);
        $kelID = substr($this->uri->segment(3),0,10);
        $kelurahan = $this->Kelurahan_model->getKelurahan($kecamatanID);
        echo 'Kelurahan<br />';
        echo '<SELECT name="kelurahan" onchange="getNewAsetID($(this).val())" style="width:220px">';
        echo '<option value="">-- pilih --</option>';
        foreach($kelurahan as $data){
            if($data->kelurahanID == $kelID){
                echo '<option value="' . $data->kelurahanID . '" selected>' . $data->namaKelurahan . '</option>';
            }else{
                echo '<option value="' . $data->kelurahanID . '">' . $data->namaKelurahan . '</option>';
            }
        }
        echo '</select>';
    }
    
    function getKelurahanSearch(){
    	$kecamatanID = $this->uri->segment(3);
    	$kelID = $this->uri->segment(4);
    	$kelurahan = $this->Kelurahan_model->getKelurahan($kecamatanID);
    	echo 'Kelurahan<br />';
    	echo '<SELECT name="kelurahan" onchange="getNewAsetID($(this).val())" style="width:220px">';
    	echo '<option value="">-- pilih --</option>';
    	foreach($kelurahan as $data){
    		if($data->kelurahanID == $kelID){
    			echo '<option value="' . $data->kelurahanID . '" selected>' . $data->namaKelurahan . '</option>';
    		}else{
    			echo '<option value="' . $data->kelurahanID . '">' . $data->namaKelurahan . '</option>';
    		}
    	}
    	echo '</select>';
    }
    
    function getRekapKel(){
        $kecamatanID = substr($this->uri->segment(3),0,6);
        $kelurahan = $this->Kelurahan_model->getKelurahan($kecamatanID);
        echo 'Kelurahan<br />';
        echo '<SELECT name="kelurahan" onchange="getRekap($(this).val())" style="width:180px">';
        echo '<option value="">-- pilih --</option>';
        foreach($kelurahan as $data){
            echo '<option value="' . $data->kelurahanID . '">' . $data->namaKelurahan . '</option>';
        }
        echo '</select>';
    }
    
    function showKecamatan($kotaID, $offset=0){
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
                            anchor('kelurahan/viewKelurahan/'.$kec->kecamatanID,'view'));
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
                            anchor('kelurahan/showKecamatan/'.$city->kotaID,'view'));
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
    
    function viewKelurahan($kecamatanID, $offset=0){
        if($this->session->userdata('login') == TRUE){
            $data['title'] = $this->title;
            $data['h2_title'] = 'Kelurahan';
            $data['main_view'] = 'view_data';
            $uri_segment = 3;
            $offset_segment = 4;

            $kecamatanID = $this->uri->segment($uri_segment);
            $offset = $this->uri->segment($offset_segment);

            $kelurahan = $this->Kelurahan_model->getKel($kecamatanID,  $this->limit,$offset);
            $num_rows = $this->Kelurahan_model->countKelurahan($kecamatanID);
            $rec = $this->Kota_model->countRec($kecamatanID,$this->limit, $offset);
            if($num_rows > 0){
                $config['base_url'] = site_url('kelurahan/viewKelurahan/'.$kecamatanID);
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
                $this->table->set_heading('No.','ID Kelurahan','Nama Kelurahan','Action');
                $i = 0 ;

                foreach($kelurahan as $kel){
                    $this->table->add_row(++$i,$kel->kelurahanID,$kel->namaKelurahan,
                            anchor('kelurahan/update/'.$kel->kelurahanID,'update').'&nbsp;'. 
                            anchor('kelurahan/delete/'.$kel->kelurahanID,'hapus',
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
    
    function add(){
        if($this->session->userdata('login') == TRUE){
            $data['title'] = $this->title;
            $data['h2_title'] = 'Kelurahan > Input Data Kelurahan';
            $data['main_view'] = 'input_kelurahan';
            $data['form_action'] = site_url('kelurahan/add_kelurahan');
            $data['link'] = array('link_back'=>  anchor('kelurahan/','kembali'));
            $this->load->view('theme',$data);
        }else{
            redirect('home');
        }
    }
    
    function add_kelurahan(){
        $data['title'] = $this->title;
        $data['h2_title'] = 'Kelurahan > Input Data Kelurahan';
        $data['main_view'] = 'input_kelurahan';
        $data['form_action'] = site_url('kelurahan/add_kelurahan');
        $data['link'] = array('link_back'=>  anchor('kelurahan/','kembali'));
        $kecamatanID = $this->input->post('kelurahanID');
        $kecamatanID = substr($kecamatanID, 0, 6);
        $kelurahan = array('kelurahanID'=>  $this->input->post('kelurahanID'),
            'kecamatanID'=>  $kecamatanID,
            'namaKelurahan'=>  $this->input->post('namaKelurahan'),
            'created'=> date('Y-m-d'),
            'createdBy'=>  $this->session->userdata('username')
            );
            $this->Kelurahan_model->add($kelurahan);
            $this->session->set_flashdata('message','Data kelurahan berhasil disimpan!');
            
            redirect('kelurahan/add/'.$kecamatanID);
    }

    function update_kelurahan(){
        $data['title'] = $this->title;
        $data['h2_title'] = 'Kelurahan > Update Data Kelurahan';
        $data['main_view'] = 'update_kelurahan';
        $data['form_action'] = site_url('kelurahan/update_kelurahan');
        $data['link'] = array('link_back'=>  anchor('kelurahan/viewKelurahan/'. $this->input->post('kecamatanID'),'kembali'));
        $kecamatanID = $this->input->post('kelurahanID');
        $kecamatanID = substr($kecamatanID, 0, 6);
        $kelurahan = array('kelurahanID'=>  $this->input->post('kelurahanID'),
            'kecamatanID'=>  $kecamatanID,
            'namaKelurahan'=>  $this->input->post('namaKelurahan'),
            'updated'=>  date('Y-m-d'),
            'updatedBy'=>  $this->session->userdata('username')
            );
            $this->Kelurahan_model->update($this->input->post('kelurahanID'),$kelurahan);
            $this->session->set_flashdata('message','Data kelurahan berhasil disimpan!');
            
            redirect('kelurahan/');
    }
    
    function update(){
        if($this->session->userdata('login') == TRUE){
            $data['title'] = $this->title;
            $data['h2_title'] = 'Kelurahan > Ubah Data Kelurahan';
            $data['main_view'] = 'update_kelurahan';
            $data['form_action'] = site_url('kelurahan/update_kelurahan');
            $data['link'] = array('link_back'=>  anchor('kelurahan/','kembali'));

            $id = $this->uri->segment(3);
            $kelurahan = $this->Kelurahan_model->getKelurahanByID($id);
            $this->session->set_userdata('kelurahanID',$id);
            $data['default']['kelurahanID'] = $kelurahan->kelurahanID;
            //$data['default']['kecamatanID'] = $kelurahan->kecamatanID;
            $data['default']['namaKelurahan'] = $kelurahan->namaKelurahan;
            
            $this->load->view('theme',$data);
        }else{
            redirect('home');
        }
    }
    
    function delete(){
        if($this->session->userdata('login') == TRUE){
            
            $id = $this->uri->segment(3);
            $kelurahan = $this->Kelurahan_model->delete($id);
            
            redirect('kelurahan/');
        }else{
            redirect('home');
        }
    }
}

?>
