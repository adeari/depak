<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of report_model
 *
 * @author domas
 */
class Report_model extends CI_Model{
    //put your code here
    
    function Report_model(){
        parent::__construct();
    }
    
    var $table = 'report';
    
    function update($id,$search){
        $this->db->where('id',$id);
        $this->db->update($this->table,$search);
    }
    
    function getLastByID($id){
        $this->db->select('propinsi,kota,kecamatan,kelurahan,ranting');
        $this->db->from($this->table);
        $this->db->where('id',$id);
        return $this->db->get();
    }
    
    function getAll($limit,$offset,$ranting){
        $this->db->select('*');
        $this->db->from('aset');
        if(strlen($ranting)>0){
            $this->db->like('ranting',$ranting);
        }
        $this->db->order_by('id','asc');
        $this->db->limit($limit,$offset);
        return $this->db->get()->result();
    }
    
    function getAsetByKelurahan($limit,$offset,$kelurahanID,$ranting){
        $this->db->select('*');
        $this->db->from('aset');
        $this->db->where('LEFT(id,10)',$kelurahanID);
        if(strlen($ranting)>0){
            $this->db->where('ranting',$ranting);
        }
        $this->db->limit($limit,$offset);
        $this->db->order_by('id','asc');
        return $this->db->get()->result();
    }
    
    function getAsetByKecamatan($limit,$offset,$kecamatanID,$ranting){
        $this->db->select('*');
        $this->db->from('aset');
        $this->db->where('LEFT(id,6)',$kecamatanID);
        if(strlen($ranting)>0){
            $this->db->where('ranting',$ranting);
        }
        $this->db->limit($limit,$offset);
        $this->db->order_by('id','asc');
        return $this->db->get()->result();
    }
    
    function getAsetByKota($limit,$offset,$kotaID,$ranting){
        $this->db->select('*');
        $this->db->from('aset');
        $this->db->where('LEFT(id,4)',$kotaID);
        if(strlen($ranting)>0){
            $this->db->where('ranting',$ranting);
        }
        $this->db->limit($limit,$offset);
        $this->db->order_by('id','asc');
        return $this->db->get()->result();
    }
    
    function getAsetByPropinsi($limit,$offset,$propinsiID,$ranting){
        $this->db->select('*');
        $this->db->from('aset');
        $this->db->where('LEFT(id,2)',$propinsiID);
        if(strlen($ranting)>0){
            $this->db->where('ranting',$ranting);
        }
        $this->db->limit($limit,$offset);
        $this->db->order_by('id','asc');
        return $this->db->get()->result();
    }
    
    function countAll($ranting){
        $this->db->select('id');
        $this->db->from($this->table);
        if(strlen($ranting)>0){
            $this->db->where('ranting',$ranting);
        }
        return $this->db->get()->num_rows();
    }
    
    function countAsetByPropinsi($propinsiID,$ranting){
        $this->db->select('*');
        $this->db->from('aset');
        $this->db->where('LEFT(id,2)',$propinsiID);
        if(strlen($ranting)>0){
            $this->db->where('ranting',$ranting);
        }
        return $this->db->get()->num_rows();
    }
    
    function countAsetByKota($kotaID,$ranting){
        $this->db->select('*');
        $this->db->from('aset');
        $this->db->where('LEFT(id,4)',$kotaID);
        if(strlen($ranting)>0){
            $this->db->where('ranting',$ranting);
        }
        return $this->db->get()->num_rows();
    } 
    
    function countAsetByKecamatan($kecamatanID,$ranting){
        $this->db->select('*');
        $this->db->from('aset');
        $this->db->where('LEFT(id,6)',$kecamatanID);
        if(strlen($ranting)>0){
            $this->db->where('ranting',$ranting);
        }
        return $this->db->get()->num_rows();
    }
    
    function countAsetByKelurahan($kelurahanID,$ranting){
        $this->db->select('*');
        $this->db->from('aset');
        $this->db->where('LEFT(id,10)',$kelurahanID);
        if(strlen($ranting)>0){
            $this->db->where('ranting',$ranting);
        }
        return $this->db->get()->num_rows();
    }
    
    function countRowByKelurahan($kelurahanID,$ranting,$jenis){
        $this->db->select('*');
        $this->db->from('aset');
        $this->db->where('LEFT(id,10)',$kelurahanID);
        if(strlen($ranting)>0){
            $this->db->where('ranting',$ranting);
        }
        $this->db->where('jenis_aset',$jenis);
        return $this->db->get()->num_rows();
    }
    
    function countRowByKecamatan($kecamatanID,$jenis){
        $this->db->select('*');
        $this->db->from('aset');
        $this->db->where('LEFT(id,6)',$kecamatanID);
        $this->db->where('jenis_aset',$jenis);
        return $this->db->get()->num_rows();
    }
    
    function countRowByKota($kotaID,$jenis){
        $this->db->select('*');
        $this->db->from('aset');
        $this->db->where('LEFT(id,4)',$kotaID);
        $this->db->where('jenis_aset',$jenis);
        return $this->db->get()->num_rows();
    }
    
    function countRowByPropinsi($propinsiID,$jenis){
        $this->db->select('*');
        $this->db->from('aset');
        $this->db->where('LEFT(id,2)',$propinsiID);
        $this->db->where('jenis_aset',$jenis);
        return $this->db->get()->num_rows();
    }
    
    function countRow($jenis){
        $this->db->select('id');
        $this->db->from('aset');
        $this->db->where('jenis_aset',$jenis);
        return $this->db->get()->num_rows();
    }
}

?>
