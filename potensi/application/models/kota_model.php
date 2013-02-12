<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of kota_model
 *
 * @author newDomas
 */
    
class Kota_model extends CI_Model{
    
    function Kota_model(){
        parent::__construct();
    }
    
    var $table = 'tbkota';
    
    function getKota($propinsiID){
        $this->db->select('kotaID,namaKota');
        $this->db->from('tbkota');
        $this->db->where('propinsiID',$propinsiID);
        $this->db->order_by('namaKota','asc');
        return $this->db->get()->result();
    }
    
    function countKota($propinsiID){
        $this->db->select('kotaID');
        $this->db->from('tbkota');
        $this->db->where('propinsiID',$propinsiID);
        return $this->db->get()->num_rows();
    }
    
    function getKotaByID($kotaID){
        $this->db->select('kotaID,propinsiID,namaKota');
        $this->db->from($this->table);
        $this->db->where('kotaID',$kotaID);
        return $this->db->get()->row();
    }
    
    function getNamaKotaByKotaID($kotaID){
    	$cityName ="";
    	$this->db->select('namaKota');
    	$this->db->from($this->table);
    	$this->db->where('kotaID',$kotaID);
    	$kota = $this->db->get()->result();
    	foreach($kota as $data){
    		$cityName = $data->namaKota;
    	}
    	return $cityName;
    }
    
    function delete($kotaID){
        $this->db->where('kotaID', $kotaID);
        $this->db->delete($this->table);
    }
    
    function add($kota){
        $this->db->insert($this->table, $kota);
    }
    
    function update($kotaID, $kota){
        $this->db->where('kotaID',$kotaID);
        $this->db->update($this->table,$kota);
    }
    
    function countRec($propinsiID,$limit,$offset){
        $this->db->select('kotaID');
        $this->db->from('tbkota');
        $this->db->where('propinsiID',$propinsiID);
        $this->db->limit($limit,$offset);
        return $this->db->get()->num_rows();
    }
}

?>
