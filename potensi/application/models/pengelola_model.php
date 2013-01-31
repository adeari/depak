<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of pengelola_model
 *
 * @author newDomas
 */
class Pengelola_model extends CI_Model{
    //put your code here
    
    function Pengelola_model(){
        parent::__construct();
    }
    
    var $table = 'pengelola';
    
    function getPengelola(){
        $this->db->select('id,pengelola');
        $this->db->from($this->table);
        $this->db->order_by('id','ASC');
        return $this->db->get()->result();
    }
    
    function getAllPengelola($limit,$offset){
        $this->db->select('id,pengelola');
        $this->db->from($this->table);
        $this->db->order_by('id','ASC');
        $this->db->limit($limit,$offset);
        return $this->db->get()->result();
    }
    
    function getPengelolaByID($id){
        $this->db->select('id,pengelola');
        $this->db->from($this->table);
        $this->db->where('id',$id);
        return $this->db->get();
    }
    
    function add($pengelola){
        $this->db->insert($this->table,$pengelola);
    }
    
    function update($id,$pengelola){
        $this->db->where('id',$id);
        $this->db->update($this->table,$pengelola);
    }
    
    function delete($id){
        $this->db->where('id',$id);
        $this->db->delete($this->table);
    }
    
    function countAllPengelola(){
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
