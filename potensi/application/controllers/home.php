<?php

    class Home extends CI_Controller {
        
        function Home(){
            parent::__construct();
            $this->load->model('Login_model','',TRUE);
            $this->load->model('Aset_model','',TRUE);
            
        }
        
        function index(){
            $data['main_view'] = 'home';
            $data['cat1'] = $this->Aset_model->countAsetByJenis("1");
            $data['cat2'] = $this->Aset_model->countAsetByJenis("2");
            $data['cat3'] = $this->Aset_model->countAsetByJenis("3");
            $data['cat4'] = $this->Aset_model->countAsetByJenis("4");
            $data['cat5'] = $this->Aset_model->countAsetByJenis("5");
            $data['cat6'] = $this->Aset_model->countAsetByJenis("6");
            $data['cat7'] = $this->Aset_model->countAsetByJenis("7");
            $data['cat8'] = $this->Aset_model->countAsetByJenis("8");
            $this->load->view('theme',$data);
            
        }
        
        function login(){
                $username = $this->input->post('username');
                $password = md5($this->input->post('password'));
            
                if($this->Login_model->check_user($username,$password)==TRUE){
                    $level = $this->Login_model->check_level($username);
                    $nama = $this->Login_model->check_nama($username);
                    $data = array('username'=>$nama->nama,'login' => TRUE,'level'=>$level->akses);
                    $this->session->set_userdata($data);
                    redirect('rekap');
                }else{
                    //$this->session->set_flashdata('message','Maaf, username '.$username . '/' .$password.' Anda salah');
                    redirect('home/index');
                }
        }

        function logout(){
            $this->session->sess_destroy();
            redirect('home','refresh');
        }

        function cekAkses(){
            $user = $this->uri->segment(3);
            $level = $this->Login_model->check_level($user);
            echo $level->akses;
        }
        
    }

?>
