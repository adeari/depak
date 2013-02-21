<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of search_model
 *
 * @author newDomas
 */
class Search_model extends CI_Model{
    //put your code here
    
    function Search_model(){
        parent::__construct();
    }
    
    var $table = 'search';
    
    function add($search){
        $this->db->insert($this->table,$search);
    }
    
    function isExist($id) {
    	$exist = false;
    	$this->db->select('*');
    	$this->db->from($this->table);
    	$this->db->limit(1,0);
    	if ($this->db->get()->num_rows()>0)
    		$exist = true;
    	return $exist;
    }
    
    function update($id,$search){
        $this->db->where('id',$id);
        $this->db->update($this->table,$search);
    }
    
    function delete($id){
        $this->db->where('id',$id);
        $this->db->delete($this->table);
    }
    
    function getLastSearch(){
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->order_by('id','desc');
        $this->db->limit(1,0);
        return $this->db->get()->row();
    }
    
    function getSearchByID($id) {
    	$this->db->select('propinsi,kota,kecamatan,kelurahan,ranting,jenis_aset,
            status_tanah,bukti_milik,pengelola');
    	$this->db->from($this->table);
    	$this->db->where('id',$id);
    	return $this->db->get()->result();
    }
    
    function getLastByID($id){
        $this->db->select('propinsi,kota,kecamatan,kelurahan,ranting,jenis_aset,
            status_tanah,bukti_milik,pengelola');
        $this->db->from($this->table);
        $this->db->where('id',$id);
        return $this->db->get();
    }
}

?>
