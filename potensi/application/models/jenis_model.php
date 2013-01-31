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
class Jenis_model extends CI_Model{
    //put your code here
    function Jenis_model(){
        parent::__construct();
    }
    
    var $table = 'klasifikasi_aset';
    
    function getJenisAset(){
        $this->db->select('id,golongan,kode_klasifikasi,jenis');
        $this->db->from($this->table);
        $this->db->order_by('kode_klasifikasi','asc');
        return $this->db->get()->result();
    }
    
    function getAllJenis($limit,$offset){
        $this->db->select('id,kode_klasifikasi,jenis');
        $this->db->from($this->table);
        $this->db->order_by('kode_klasifikasi','asc');
        $this->db->limit($limit,$offset);
        return $this->db->get()->result();
    }
    
    function getJenisByID($id){
        $this->db->select('id,kode_klasifikasi,jenis');
        $this->db->from($this->table);
        $this->db->where('id',$id);
        return $this->db->get();
    }
    
    function getJenis($kode){
        $this->db->select('id,kode_klasifikasi,jenis');
        $this->db->from($this->table);
        $this->db->where('kode_klasifikasi',$kode);
        return $this->db->get();
    }
    
    function getJenisByCat($cat){
        $this->db->select('id,kode_klasifikasi,jenis');
        $this->db->from($this->table);
        $this->db->where('golongan',$cat);
        return $this->db->get();
    }
    
    function add($jenis){
        $this->db->insert($this->table,$jenis);
    }
    
    function update($id,$jenis){
        $this->db->where('id',$id);
        $this->db->update($this->table,$jenis);
    }
    
    function delete($id){
        $this->db->where('id',$id);
        $this->db->delete($this->table);
    }
    
    function countAllJenis(){
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
