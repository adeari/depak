<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of propinsi_model
 *
 * @author newDomas
 */
class Propinsi_model extends CI_Model{
    
    function Propinsi_model(){
        parent::__construct();
    }
    
    var $table = 'tbpropinsi';
    
    function getPropinsi(){
        $this->db->select('propinsiID,namaPropinsi');
        $this->db->from($this->table);
        $this->db->order_by('namaPropinsi','asc');
        return $this->db->get()->result();
    }
    
    function getProp($id){
        $this->db->select('propinsiID,namaPropinsi');
        $this->db->from($this->table);
        $this->db->where('propinsiID',$id);
        return $this->db->get()->row();
    }
    
    function countPropinsi(){
        return $this->db->get($this->table)->num_rows();
    }
    
    function ambilPropinsi($limit, $offset){
        $this->db->select('propinsiID,namaPropinsi');
        $this->db->from($this->table);
        $this->db->limit($limit,$offset);
        $this->db->order_by('propinsiID','asc');
        return $this->db->get()->result();
    }
    
    function getPropinsiByID($propinsiID){
        $this->db->select('propinsiID,namaPropinsi');
        $this->db->from($this->table);
        $this->db->where('propinsiID',$propinsiID);
        return $this->db->get()->row();
    }
    
    function delete($propinsiID){
        $this->db->where('propinsiID', $propinsiID);
        $this->db->delete($this->table);
    }
    
    function add($propinsi){
        $this->db->insert($this->table, $propinsi);
    }
    
    function update($propinsiID, $propinsi){
        $this->db->where('propinsiID',$propinsiID);
        $this->db->update($this->table,$propinsi);
    }
    
    function countRec($limit, $offset){
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->limit($limit,$offset);
        return $this->db->get()->num_rows();
    }
}

?>
