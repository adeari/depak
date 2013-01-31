<?php

class Login_model extends CI_Model {

    function Login_model(){
        parent::__construct();
    }
    
    var $table = 'user';
    
    function check_user($username, $password){
        
        $this->db->select('username,password');
        $this->db->from($this->table);
        $this->db->where('username',$username);
        $this->db->where('password',$password);
        $row = $this->db->get()->num_rows();
        
        if($row > 0){
            return TRUE;
        }else{
            return FALSE;
        }
    }
    
    function check_level($username){
        $this->db->select('akses');
        $this->db->from($this->table);
        $this->db->where('username',$username);
        return $this->db->get()->row();
    }
    
    function check_nama($username){
        $this->db->select('nama');
        $this->db->from($this->table);
        $this->db->where('username',$username);
        return $this->db->get()->row();
    }
}

/*
 * END Login_model Class
 * and open the template in the editor.
 */
?>
