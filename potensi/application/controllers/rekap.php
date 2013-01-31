<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of rekap
 *
 * @author newDomas
 */
class Rekap extends CI_Controller{
    //put your code here
    function Rekap(){
        parent::__construct();
        $this->load->model('Aset_model','',TRUE);
        $this->load->model('Propinsi_model','',TRUE);
        $this->load->model('Kota_model','',TRUE);
        $this->load->model('Kecamatan_model','',TRUE);
        $this->load->model('Kelurahan_model','',TRUE);
        $this->load->model('Jenis_model','',TRUE);
        $this->load->model('Status_model','',TRUE);
        $this->load->model('Bukti_model','',TRUE);
        $this->load->model('Pengelola_model','',TRUE);
        $this->load->model('Golongan_model','',TRUE);
    }
    
    var $title = 'Aset';
    var $limit = 20;
    var $cat1;var $cat2;var $cat3;var $cat4;
    var $cat5;var $cat6;var $cat7;var $cat8;
    
    function index(){
        if($this->session->userdata('login')==TRUE ){
            $data['main_view'] = 'rekap';
            $data['cat1'] = $this->Aset_model->countAsetByJenis("1");
            $data['cat2'] = $this->Aset_model->countAsetByJenis("2");
            $data['cat3'] = $this->Aset_model->countAsetByJenis("3");
            $data['cat4'] = $this->Aset_model->countAsetByJenis("4");
            $data['cat5'] = $this->Aset_model->countAsetByJenis("5");
            $data['cat6'] = $this->Aset_model->countAsetByJenis("6");
            $data['cat7'] = $this->Aset_model->countAsetByJenis("7");
            $data['cat8'] = $this->Aset_model->countAsetByJenis("8");
            $this->load->view('theme',$data);
            
        }else{
            redirect('home');
        }
    }
    
    function countRekapAll(){
        
        $this->cat1 = $this->Aset_model->countRekapAll(1);
        $this->cat2 = $this->Aset_model->countRekapAll(2);
        $this->cat3 = $this->Aset_model->countRekapAll(3);
        $this->cat4 = $this->Aset_model->countRekapAll(4);
        $this->cat5 = $this->Aset_model->countRekapAll(5);
        $this->cat6 = $this->Aset_model->countRekapAll(6);
        $this->cat7 = $this->Aset_model->countRekapAll(7);
        $this->cat8 = $this->Aset_model->countRekapAll(8);
        $this->viewRekap();
    }
    
        
    
    
    function viewRekap(){
        $cetak = '
        <table width="100%" cellpadding="0" and cellspacing="0">
            <tr>
                <td width="25%"><div align="center">
                    <a href="' ;
                    if($this->session->userdata('login')==TRUE){
                        $cetak .= base_url() . 'index.php/aset/viewAset/1/';
                    }else{
                        $cetak .= '#';
                    }
        $cetak .= '"><img width="160" height="160" src="' . base_url() . 'images/masjid.png" />
                    </a></div>
                </td>
                <td width="25"><div align="center">
                    <a href="';
                    if($this->session->userdata('login')==TRUE){
                        $cetak .= base_url() . 'index.php/aset/viewAset/2/';
                    }else{
                        $cetak .= '#';
                    }
        $cetak .= '"><img width="160" height="160" alt="" src="' . base_url() . 'images/sma.png" />
                    </a></div>
                </td>
                <td width="25%"><div align="center">
                    <a href="';
                    if($this->session->userdata('login')==TRUE){
                        $cetak .= base_url() . 'index.php/aset/viewAset/3/';
                    }else{
                        $cetak .= '#';
                    }
        $cetak .= '"><img width="160" height="160" alt="" src="' . base_url() . 'images/sosial.png" />
                    </a></div>
                </td>
                <td width="25%"><div align="center">
                    <a href="';
                    if($this->session->userdata('login')==TRUE){
                        $cetak .= base_url() . 'index.php/aset/viewAset/4/';
                    }else{
                        $cetak .= '#';
                    }
        $cetak .= '"><img width="160" height="160" alt="" src="' . base_url() . 'images/pwnujatim.png" />
                    </a></div>
                </td>
            </tr>
            <tr>
                <td width="25%">
                    <table width="160" cellpadding="0" cellspacing="0" align="center">
                        <tr><td bgcolor="#2F89B6"><div class="noline">
                            <a href="';
                            if($this->session->userdata('login')==TRUE){
                                $cetak .= base_url() . 'index.php/aset/viewAset/1/';
                            }else{
                                $cetak .= '#';
                            }
        $cetak .= '"><div class="kategori">
                            <h4>Tempat Ibadah<br />'. $this->cat1 . '</h4></div>
                            </a></div></td></tr>
                    </table>
                </td>
                <td width="25%">
                    <table width="160" cellpadding="0" cellspacing="0" align="center">
                        <tr><td bgcolor="#A04661"><div class="noline">
                            <a href="';
                            if($this->session->userdata('login')==TRUE){
                                $cetak .= base_url() . 'index.php/aset/viewAset/2/';
                            }else{
                                $cetak .= '#';
                            }
        $cetak .= '"><div class="kategori">
                            <h4>Pendidikan<br />' . $this->cat2 . '</h4></div>
                            </a></div></td></tr>
                    </table>
                </td>
                <td width="25%" align="center">
                    <table width="160" cellpadding="0" cellspacing="0" align="center">
                        <tr><td bgcolor="#5B9121"><div class="noline">
                        <a href="';
                        if($this->session->userdata('login')==TRUE){
                            $cetak .= base_url() . 'index.php/aset/viewAset/3/';
                        }else{
                            $cetak .= '#';
                        }
        $cetak .= '"><div class="kategori">
                            <h4>Sosial<br />' . $this->cat3 . '</h4></div>
                            </a></div></td></tr>
                    </table>
                </td>
                <td width="25%" align="center">
                    <table width="160" cellpadding="0" cellspacing="0" align="center">
                        <tr><td bgcolor="#EB9500"><div class="noline">
                        <a href="';
                        if($this->session->userdata('login')==TRUE){
                            $cetak .= base_url() . 'index.php/aset/viewAset/4/';
                        }else{
                            $cetak .= '#';
                        }
        $cetak .= '"><div class="kategori">
                            <h4>Perkantoran<br />' . $this->cat4 . '</h4></div>
                            </a></div></td></tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td width="25%">
                    <div align="center"><a href="';
                    if($this->session->userdata('login')==TRUE){
                        $cetak .= base_url() . 'index.php/aset/viewAset/5/';
                    }else{
                        $cetak .= '#';
                    }
                
        $cetak .= '"><img width="160" height="160" src="' . base_url() . 'images/dokter.png" />
                    </a></div>
                </td>
                <td width="25%"><div align="center">
                    <a href="' ;
                    if($this->session->userdata('login')==TRUE){
                        $cetak .= base_url() . 'index.php/aset/viewAset/6/';
                    }else{
                        $cetak .= '#';
                    }
        $cetak .= '"><img width="160" height="160" src="'. base_url() . 'images/ekonomi.png" />
                    </a></div>
                </td>
                <td width="25%"><div align="center">
                    <a href="' ;
                    if($this->session->userdata('login')==TRUE){
                        $cetak .= base_url() . 'index.php/aset/viewAset/7/';
                    }else{
                        $cetak .= '#';
                    }
        $cetak .= '"><img width="160" height="160" src="' . base_url() . 'images/media.png" />
                    </a></div>
                </td>
                <td width="25%"><div align="center">
                    <a href="';
                    if($this->session->userdata('login')==TRUE){
                        $cetak .= base_url() . 'index.php/aset/viewAset/8/';
                    }else{
                        $cetak .= '#';
                    }
        $cetak .= '"><img width="160" height="160" src="' . base_url() . 'images/Aula01.jpg" />
                    </a></div>
                </td>
            </tr>
            <tr>
                <td width="25%">
                <table width="160" cellpadding="0" cellspacing="0" align="center">
                    <tr>
                        <td bgcolor="#2F89B6">
                            <div class="noline">
                                <a href="';
                                if($this->session->userdata('login')==TRUE){
                                    $cetak .= base_url() . 'index.php/aset/viewAset/5/';
                                }else{
                                    $cetak .= '#';
                                }
        $cetak .= '"><div class="kategori"><h4>Kesehatan<br />' . $this->cat5 . '</h4></div>
                    </a>
                    </div></td></tr>
                </table>
                </td>
                <td width="25%" align="center">
                <table width="160" cellpadding="0" cellspacing="0" align="center">
                    <tr><td bgcolor="#A04661"><div class="noline">
                    <a href="';
                    if($this->session->userdata('login')==TRUE){
                        $cetak .= base_url() . 'index.php/aset/viewAset/6/';
                    }else{
                        $cetak .= '#';
                    }
        $cetak .= '"><div class="kategori"><h4>Ekonomi<br />' . $this->cat6 . '</h4></div>
                    </a>
                    </div></td></tr>
                </table>
                </td>
                <td width="25%" align="center">
                <table width="160" cellpadding="0" cellspacing="0" align="center">
                    <tr><td bgcolor="#5B9121"><div class="noline">
                    <a href="';
                    if($this->session->userdata('login')==TRUE){
                        $cetak .= base_url() . 'index.php/aset/viewAset/7/';
                    }else{
                        $cetak .= '#';
                    }
        $cetak .= '"><div class="kategori"><h4>Media Dakwah<br />' . $this->cat7 . '</h4></div>
                    </a>
                    </div></td></tr>
                </table>
                </td>
                <td width="25%" align="center">
                <table width="160" cellpadding="0" cellspacing="0" align="center">
                    <tr><td bgcolor="#EB9500"><div class="noline">
                    <a href="';
                    if($this->session->userdata('login')==TRUE){
                        $cetak .= base_url() . 'index.php/aset/viewAset/8/';
                    }else{
                        $cetak .= '#';
                    }
        $cetak .= '"><div class="kategori"><h4>Lain-lain<br />' . $this->cat8 . '</h4></div>
                    </a>
                    </div></td></tr>
                </table>
                </td></tr></table>';
        
        $cetak .= '<p>
                    <div class="hitung"></div>
                </p>';
        return $cetak ;
    }
}

?>
