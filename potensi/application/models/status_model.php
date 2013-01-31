<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of status_model
 *
 * @author newDomas
 */
class Status_model extends CI_Model{
    //put your code here
    
    function Status_model(){
        parent::__construct();
    }
    
    var $table = 'status_tanah';
    
    function getStatusTanah(){
        $this->db->select('id,status_tanah');
        $this->db->from($this->table);
        $this->db->order_by('id','ASC');
        return $this->db->get()->result();
    }
    
    function getAllStatusTanah($limit,$offset){
        $this->db->select('id,status_tanah');
        $this->db->from($this->table);
        $this->db->order_by('id','ASC');
        $this->db->limit($limit,$offset);
        return $this->db->get()->result();
    }
    
    function getStatusTanahByID($id){
        $this->db->select('id,status_tanah');
        $this->db->from($this->table);
        $this->db->where('id',$id);
        return $this->db->get();
    }
    
    function add($status){
        $this->db->insert($this->table,$status);
    }
    
    function update($id,$status){
        $this->db->where('id',$id);
        $this->db->update($this->table,$status);
    }
    
    function delete($id){
        $this->db->where('id',$id);
        $this->db->delete($this->table);
    }
    
    function countAllStatusTanah(){
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
