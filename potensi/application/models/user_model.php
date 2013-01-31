<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of jenis_model
 *
 * @author newDomas
 */
class User_model extends CI_Model{
    //put your code here
    function User_model(){
        parent::__construct();
    }
    
    var $table = 'user';
    
       
    function getUser(){
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->order_by('username','asc');
        return $this->db->get()->result();
    }
    
    function getAllUser($limit,$offset){
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->order_by('username','asc');
        $this->db->limit($limit,$offset);
        return $this->db->get()->result();
    }
    
    function getUserByID($id){
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('id',$id);
        return $this->db->get();
    }
    
    function getUserByUsername($username){
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('username',$username);
        return $this->db->get();
    }
    
    function add($user){
        $this->db->insert($this->table,$user);
    }
    
    function update($id,$user){
        $this->db->where('id',$id);
        $this->db->update($this->table,$user);
    }
    
    function delete($id){
        $this->db->where('id',$id);
        $this->db->delete($this->table);
    }
    
    function countAllUser(){
        return $this->db->get($this->table)->num_rows();
    }
    
    function countRec($limit,$offset){
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->limit($limit,$offset);
        return $this->db->get()->num_rows();
    }
}

?>
