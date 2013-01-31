<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of bukti_model
 *
 * @author newDomas
 */
class Bukti_model extends CI_Model{
    //put your code here
    
    function Bukti_model(){
        parent::__construct();
    }
    
    var $table = 'bukti_milik';
    
    function getBuktiMilik(){
        $this->db->select('id,bukti_milik');
        $this->db->from($this->table);
        $this->db->order_by('id','ASC');
        return $this->db->get()->result();
    }
    
    function getAllBuktiMilik($limit,$offset){
        $this->db->select('id,bukti_milik');
        $this->db->from($this->table);
        $this->db->order_by('id','ASC');
        $this->db->limit($limit,$offset);
        return $this->db->get()->result();
    }
    
    function getBuktiMilikByID($id){
        $this->db->select('id,bukti_milik');
        $this->db->from($this->table);
        $this->db->where('id',$id);
        return $this->db->get();
    }
    
    function add($bukti){
        $this->db->insert($this->table,$bukti);
    }
    
    function update($id,$bukti){
        $this->db->where('id',$id);
        $this->db->update($this->table,$bukti);
    }
    
    function delete($id){
        $this->db->where('id',$id);
        $this->db->delete($this->table);
    }
    
    function countAllBuktiMilik(){
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
