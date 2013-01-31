<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of kelurahan
 *
 * @author newDomas
 */
class Kelurahan_model extends CI_Model {
    
    function Kelurahan_model(){
        parent::__construct();
    }
    
    var $table = 'tbkelurahan';
    
    function getKelurahan($kecamatanID){
        $this->db->select('kelurahanID,namaKelurahan');
        $this->db->from($this->table);
        $this->db->where('kecamatanID',$kecamatanID);
        $this->db->order_by('namaKelurahan','asc');
        return $this->db->get()->result();
    }
    
    function getKel($kecamatanID,$limit,$offset){
        $this->db->select('kelurahanID,namaKelurahan');
        $this->db->from('tbkelurahan');
        $this->db->where('kecamatanID',$kecamatanID);
        $this->db->limit($limit,$offset);
        $this->db->order_by('kelurahanID','asc');
        return $this->db->get()->result();
    }
    
    function getKelurahanByID($kelurahanID){
        $this->db->select('kelurahanID,namaKelurahan');
        $this->db->from($this->table);
        $this->db->where('kelurahanID',$kelurahanID);
        return $this->db->get()->row();
    }
    
    function delete($kelurahanID){
        $this->db->where('kelurahanID', $kelurahanID);
        $this->db->delete($this->table);
    }
    
    function add($kelurahan){
        $this->db->insert($this->table, $kelurahan);
    }
    
    function update($kelurahanID, $kelurahan){
        $this->db->where('kelurahanID',$kelurahanID);
        $this->db->update($this->table,$kelurahan);
    }
    
    function countKelurahan($kecamatanID){
        $this->db->select('kelurahanID');
        $this->db->from('tbkelurahan');
        $this->db->where('kecamatanID',$kecamatanID);
        return $this->db->get()->num_rows();
    }
    
    function countRec($kecamatanID,$limit,$offset){
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('kecamatanID',$kecamatanID);
        $this->db->limit($limit,$offset);
        return $this->db->get()->num_rows();
    }
}

?>
