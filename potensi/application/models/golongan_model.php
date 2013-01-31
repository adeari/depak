<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of golongan_model
 *
 * @author newDomas
 */
class Golongan_model extends CI_Model{
    //put your code here
    function Golongan_model(){
        parent::__construct();
    }
    
    var $table = 'golongan';
    
    function getGolongan(){
        $this->db->select('id,golongan');
        $this->db->from($this->table);
        $this->db->order_by('id','ASC');
        return $this->db->get()->result();
    }
    
    function getGolonganByID($id){
        $this->db->select('id,golongan');
        $this->db->from($this->table);
        $this->db->where('id',$id);
        return $this->db->get()->row();
    }
    
    function countGolonganByID($id){
        $this->db->select('id');
        $this->db->from($this->table);
        $this->db->where('id',$id);
        return $this->db->get()->num_rows();
    }
    
    function add($golongan){
        $this->db->insert($this->table,$golongan);
    }
    
    function update($id,$golongan){
        $this->db->where('id',$id);
        $this->db->update($this->table,$golongan);
    }
    
    function delete($id){
        $this->db->where('id',$id);
        $this->db->delete($this->table);
    }
    
}

?>
