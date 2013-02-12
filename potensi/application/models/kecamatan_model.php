<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of kecamatan_model
 *
 * @author newDomas
 */
class Kecamatan_model extends CI_Model{
    
    function Kecamatan_model(){
        parent::__construct();
    }
    
    var $table = 'tbkecamatan';
    
    function getKecamatan($kotaID){
        $this->db->select('kecamatanID,namaKecamatan');
        $this->db->from('tbkecamatan');
        $this->db->where('kotaID',$kotaID);
        $this->db->order_by('namaKecamatan','asc');
        return $this->db->get()->result();
    }
    
    function getKec($kotaID,$limit,$offset){
        $this->db->select('kecamatanID,namaKecamatan');
        $this->db->from('tbkecamatan');
        $this->db->where('kotaID',$kotaID);
        $this->db->limit($limit,$offset);
        $this->db->order_by('kecamatanID','asc');
        return $this->db->get()->result();
    }
    
    function getKecamatanByID($kecamatanID){
        $this->db->select('kecamatanID,kotaID,namaKecamatan');
        $this->db->from('tbkecamatan');
        $this->db->where('kecamatanID',$kecamatanID);
        return $this->db->get()->row();
    }
    
    function delete($kecamatanID){
        $this->db->where('kecamatanID', $kecamatanID);
        $this->db->delete($this->table);
    }
    
    function add($kecamatan){
        $this->db->insert($this->table, $kecamatan);
    }
    
    function update($kecamatanID, $kecamatan){
        $this->db->where('kecamatanID',$kecamatanID);
        $this->db->update($this->table,$kecamatan);
    }
    
    function countKecamatan($kotaID){
        $this->db->select('kecamatanID');
        $this->db->from('tbkecamatan');
        $this->db->where('kotaID',$kotaID);
        return $this->db->get()->num_rows();
    }
    
    function countRec($kotaID,$limit,$offset){
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('kotaID',$kotaID);
        $this->db->limit($limit,$offset);
        return $this->db->get()->num_rows();
    }
    
    function getNamaKecamatanByKecamatanID($kecamatanID){
    	$kecamatanName ="";
    	$this->db->select('namaKecamatan');
    	$this->db->from($this->table);
    	$this->db->where('kecamatanID',$kecamatanID);
    	$kecamatan = $this->db->get()->result();
    	foreach($kecamatan as $data){
    		$kecamatanName = $data->namaKecamatan;
    	}
    	return $kecamatanName;
    }
}

?>
