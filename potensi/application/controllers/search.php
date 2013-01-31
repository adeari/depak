<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of search
 *
 * @author newDomas
 */
class Search extends CI_Controller{
    //put your code here
    function Search(){
        parent::__construct();
        $this->load->model('Aset_model','',TRUE);
        $this->load->model('Propinsi_model','',TRUE);
        $this->load->model('Kota_model','',TRUE);
        $this->load->model('Kecamatan_model','',TRUE);
        $this->load->model('Kelurahan_model','',TRUE);
        $this->load->model('Jenis_model','',TRUE);
        $this->load->model('Golongan_model','',TRUE);
        $this->load->model('Status_model','',TRUE);
        $this->load->model('Bukti_model','',TRUE);
        $this->load->model('Pengelola_model','',TRUE);
        $this->load->model('Search_model','',TRUE);
    }
    
    var $title = 'Pencarian Data';
    var $limit = 20;
    
    function index(){
        $this->findIt();
    }
    
    function findIt(){
        if($this->session->userdata('login') == TRUE){
            $data['title'] = $this->title;
            $data['h2_title'] = 'Pencarian Data Aset';
            
            $data['form_action'] = site_url('search/simpan');
            $data['link'] = array('link_back'=>  anchor('search/','kembali'));
            $data['main_view'] = 'search';
            $this->load->view('theme',$data);
        }else{
            redirect('home');
        }
    }
    
    function simpan(){
        
        $propID = $this->input->post('propinsi');
        $kotaID = $this->input->post('kota');
        $kecID = $this->input->post('kecamatan');
        $kelID = $this->input->post('kelurahan');
        $ranting = $this->input->post('ranting');
        $jenis = $this->input->post('jenis');
        $status = $this->input->post('status');
        $bukti = $this->input->post('bukti');
        $pengelola = $this->input->post('pengelola');
        
        $search = array('propinsi'=>$propID,'kota'=>$kotaID,'kecamatan'=>$kecID,
            'kelurahan'=>$kelID,'ranting'=>$ranting,'jenis_aset'=>$jenis,
            'status_tanah'=>$status,'bukti_milik'=>$bukti,'pengelola'=>$pengelola);
        $this->Search_model->update(1,$search);
        $this->cari();
    }
    
    function cari(){
        
        $data['title'] = $this->title;
        $data['h2_title'] = 'Pencarian Data Aset';
        $data['main_view'] = 'view_data';
        $offset_segment = 3;
        $offset = $this->uri->segment($offset_segment);
        $row = $this->Search_model->getLastByID(1)->row();
        //foreach ($parameter as $row){
            $propinsiID = $row->propinsi;
            $kotaID = $row->kota;
            $kecamatanID = $row->kecamatan;
            $kelurahanID = $row->kelurahan;
            $ranting = $row->ranting;
            $jenis = $row->jenis_aset;
            $status = $row->status_tanah;
            $bukti = $row->bukti_milik;
            $pengelola = $row->pengelola;
        //}
        
        if(!empty($propinsiID)){

            if(!empty($kotaID)){
                
                if(!empty($kecamatanID)){

                    if(!empty($kelurahanID)){
                        //echo $kelurahanID;
                        $asets = $this->Aset_model->getAllByKelurahan($this->limit,$offset,$kelurahanID,$ranting,$jenis,$status,$bukti,$pengelola);
                        $num_rows = $this->Aset_model->countAllByKelurahan($kelurahanID,$ranting,$jenis,$status,$bukti,$pengelola);
                        $rec = $this->Aset_model->countRowByKelurahan($this->limit,$offset,$kelurahanID,$ranting,$jenis,$status,$bukti,$pengelola);
                    }else{
                        $asets = $this->Aset_model->getAllByKecamatan($this->limit,$offset,$kecamatanID,$ranting,$jenis,$status,$bukti,$pengelola);
                        $num_rows = $this->Aset_model->countAllByKecamatan($kecamatanID,$ranting,$jenis,$status,$bukti,$pengelola);
                        $rec = $this->Aset_model->countRowByKecamatan($this->limit,$offset,$kecamatanID,$ranting,$jenis,$status,$bukti,$pengelola);
                    }
                }else{
                    $asets = $this->Aset_model->getAllByKota($this->limit,$offset,$kotaID,$ranting,$jenis,$status,$bukti,$pengelola);
                    $num_rows = $this->Aset_model->countAllByKota($kotaID,$ranting,$jenis,$status,$bukti,$pengelola);
                    $rec = $this->Aset_model->countRowByKota($this->limit,$offset,$kotaID,$ranting,$jenis,$status,$bukti,$pengelola);
                }
            }else{
                $asets = $this->Aset_model->getAllByPropinsi($this->limit,$offset,$propinsiID,$ranting,$jenis,$status,$bukti,$pengelola);
                $num_rows = $this->Aset_model->countAllByPropinsi($propinsiID,$ranting,$jenis,$status,$bukti,$pengelola);
                $rec = $this->Aset_model->countRowByPropinsi($this->limit,$offset,$propinsiID,$ranting,$jenis,$status,$bukti,$pengelola);
            }
        }else{
            $asets = $this->Aset_model->getAll($this->limit,$offset,$ranting,$jenis,$status,$bukti,$pengelola);
            $num_rows = $this->Aset_model->countAll($ranting,$jenis,$status,$bukti,$pengelola);
            $rec = $this->Aset_model->countRow($this->limit,$offset,$ranting,$jenis,$status,$bukti,$pengelola);
        }
        
        if($num_rows > 0){
            $config['base_url'] = site_url('search/cari/');
            $config['total_rows'] = $num_rows;
            $config['per_page'] = $this->limit;
            $config['uri_segment'] = $offset_segment;
            $this->pagination->initialize($config);
            $data['pagination'] = $this->pagination->create_links();
            $data['num_rows'] = $num_rows;
            $data['rec'] = $offset + $rec;
            $tmpl = array('table_open' => '<table border="0" cellpadding="0" cellspacing="0" bgcolor="#ffffff">',
                'row_alt_start' => '<tr class="zebra">','row_alt_end' => '</tr>');
            
            $this->table->set_template($tmpl);
            $this->table->set_empty("&nbsp;");
            $this->table->set_heading('No.','ID Aset','Jenis Aset','Nama Aset','Lokasi', 'Ranting','Kecamatan','Kota/Kabupaten');
            $i = 0 + $offset;
            
            foreach($asets as $row){
                $kotaID = substr($row->id, 0, 4);
                $kota = $this->Kota_model->getKotaByID($kotaID);
                $kecamatanID = substr($row->id, 0, 6);
                $kecamatan = $this->Kecamatan_model->getKecamatanByID($kecamatanID);
                $namaKec = $kecamatan->namaKecamatan;
                $namaKota = $kota->namaKota;
                $this->table->add_row(++$i,anchor('aset/detail/'.$row->id,$row->id),
                        $row->ket_jenis,
                        $row->nama_aset,
                        $row->lokasi,
                        $row->ranting,
                        $namaKec,
                        $namaKota);
                }
            $data['table'] = $this->table->generate();
        }else{
            $data['message'] = 'Tidak ada data yang ditampilkan!';
        }
        
        //$data['link'] = array('link_add'=>  anchor('status/add','tambah data'));
        $this->load->view('theme',$data);
    }
    
    function hide(){
        echo '&nbsp;';
    }
    function detail(){
        $ID = $this->uri->segment(3);
        $aset = $this->Aset_model->getAsetByID($ID);
        $tgl_survey = substr($aset->tgl_survey, 8, 2) . '-' .
                substr($aset->tgl_survey, 5, 2) . '-' .
                substr($aset->tgl_survey, 0, 4);
        $tgl_create = substr($aset->created, 8, 2) . '-' .
                substr($aset->created, 5, 2) . '-' .
                substr($aset->created, 0, 4);
        $tgl_update = substr($aset->updated, 8, 2) . '-' .
                substr($aset->updated, 5, 2) . '-' .
                substr($aset->updated, 0, 4);
        echo '<p>
            <table width="620" cellpadding="0" cellspacing="0" border="1" align="center" bgcolor="#ffffff">
                <tr>
                    <td>
                        <table width="620" cellpadding="0" cellspacing="0" border="0">
                            
                            <tr>
                                <td width="150">Ranting NU</td>
                                <td width="25">:</td>
                                <td>' . $aset->ranting . '</td>
                            </tr>
                            <tr class="zebra">
                                <td width="150">Ketua Ranting NU</td>
                                <td width="25">:</td>
                                <td>' . $aset->kprnu . '</td>
                            </tr>
                            <tr>
                                <td width="150">Tgl. Survey</td>
                                <td width="25">:</td>
                                <td>' . $tgl_survey . '</td>
                            </tr>
                            <tr class="zebra">
                                <td width="150">Petugas Pendataan</td>
                                <td width="25">:</td>
                                <td>' . $aset->petugas . '</td>
                            </tr>
                            <tr>
                                <td width="150">Petugas Input</td>
                                <td width="25">:</td>
                                <td>' . $aset->createdBy . '</td>
                            </tr>
                            <tr class="zebra">
                                <td width="150">Tgl. Input</td>
                                <td width="25">:</td>
                                <td>' . $tgl_create . '</td>
                            </tr>
                            <tr>
                                <td width="150">Petugas Edit</td>
                                <td width="25">:</td>
                                <td>' . $aset->updatedBy . '</td>
                            </tr>
                            <tr class="zebra">
                                <td width="150">Tgl. Edit</td>
                                <td width="25">:</td>
                                <td>' . $tgl_update . '</td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table></p>';
    }
}

?>
