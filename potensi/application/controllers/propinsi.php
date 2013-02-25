<?php

/*
 * To change this theme, choose Tools | themes
 * and open the theme in the editor.
 */

/**
 * Description of propinsi
 *
 * @author newDomas
 */
class Propinsi extends CI_Controller{
    //put your code here
    
    function Propinsi(){
        parent::__construct();
        $this->load->model('Propinsi_model','',TRUE);
    }
    
    var $title = 'Propinsi';
    var $limit = 20;
    
    function index($offset=0){
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
                            anchor('propinsi/update/'.$prop->propinsiID,'update').'&nbsp;'. 
                            anchor('propinsi/delete/'.$prop->propinsiID,'hapus',
                            array('onclick'=>"return confirm('Data akan dihapus?')")));
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
    
    function add(){
        if($this->session->userdata('login') == TRUE){
            $data['title'] = $this->title;
            $data['h2_title'] = 'Propinsi > Input Data Propinsi';
            $data['main_view'] = 'input_propinsi';
            $data['form_action'] = site_url('propinsi/add_propinsi');
            $data['link'] = array('link_back'=>  anchor('propinsi/','kembali'));

            $this->load->view('theme',$data);
        }else{
            redirect('home');
        }
    }
    
    function add_propinsi(){
        $data['title'] = $this->title;
        $data['h2_title'] = 'Propinsi > Input Data Propinsi';
        $data['main_view'] = 'input_propinsi';
        $data['form_action'] = site_url('propinsi/add_propinsi');
        $data['link'] = array('link_back'=>  anchor('propinsi/','kembali'));
        
        $propinsi = array('propinsiID'=>  $this->input->post('propinsiID'),
            'namaPropinsi'=>  $this->input->post('namaPropinsi'),
            'created'=> date('Y-m-d'),
            'createdBy'=>  $this->session->userdata('username')
            );
            $this->Propinsi_model->add($propinsi);
            $this->session->set_flashdata('message','Data propinsi berhasil disimpan!');
            
            redirect('propinsi/add');
    }

    function update_propinsi(){
        $data['title'] = $this->title;
        $data['h2_title'] = 'Propinsi > Update Data Propinsi';
        $data['main_view'] = 'update_propinsi';
        $data['form_action'] = site_url('propinsi/update_propinsi');
        $data['link'] = array('link_back'=>  anchor('propinsi/','kembali'));
        
        $propinsi = array('propinsiID'=>  $this->input->post('propinsiID'),
            'namaPropinsi'=>  $this->input->post('namaPropinsi'),
            'updated'=>  date('Y-m-d'),
            'updateBy'=>  $this->session->userdata('username')
            );
            $this->Propinsi_model->update($this->input->post('propinsiID'),$propinsi);
            $this->session->set_flashdata('message','Data kota berhasil disimpan!');
            
            redirect('propinsi/');
    }
    
    function update(){
        if($this->session->userdata('login') == TRUE){
            $data['title'] = $this->title;
            $data['h2_title'] = 'Propinsi > Ubah Data Propinsi';
            $data['main_view'] = 'update_propinsi';
            $data['form_action'] = site_url('propinsi/update_propinsi');
            $data['link'] = array('link_back'=>  anchor('aset/','kembali'));

            $id = $this->uri->segment(3);
            $propinsi = $this->Propinsi_model->getProp($id);
            $this->session->set_userdata('propinsiID',$propinsi->propinsiID);
            $data['default']['propinsiID'] = $propinsi->propinsiID;
            $data['default']['namaPropinsi'] = $propinsi->namaPropinsi;
            
            $this->load->view('theme',$data);
        }else{
            redirect('home');
        }
    }
    
    function delete(){
        if($this->session->userdata('login') == TRUE){
            
            $id = $this->uri->segment(3);
            $propinsi = $this->Propinsi_model->delete($id);
            
            redirect('propinsi/');
        }else{
            redirect('home');
        }
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
    
    function getPropinsiInRPaset(){
    	$propID = substr($this->uri->segment(3),0,2);
    	$propinsi = $this->Propinsi_model->getPropinsi();
    	echo 'Propinsi<br>';
    	echo '<SELECT name="propinsi" onchange="ambil_kotaInRPaset($(this).val(),true)" style="width:220px">';
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
    
    function getRekapProp(){
        $propinsi = $this->Propinsi_model->getPropinsi();
        echo 'Propinsi<br />';
        echo '<SELECT name="propinsi" id="propinsi" onchange="rekap_kota($(this).val())" style="width:180px">';
        echo '<option value="">-- pilih --</option>';
        foreach($propinsi as $row){
            echo '<option value="' . $row->propinsiID . '">' . $row->namaPropinsi. '</option>';
        }
        echo '</select>';
    }
}

?>
