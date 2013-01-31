<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of aset_model
 *
 * @author newDomas
 */
class Aset_model extends CI_Model{
    
    function Aset_model(){
        parent::__construct();
    }
    
    var $table = 'aset';
    
    
    function getNewAsetID($kelurahanID){
        
        $query = "SELECT max(RIGHT(id,4)) AS newid FROM aset WHERE LEFT(id,10)='$kelurahanID'";
        
        $newID = '';
        $hasil = $this->db->query($query)->result();
        foreach($hasil as $data){
            $newID = $data->newid;
        }
        
        $idBaru = (int)$newID +1;
        $newID = strval($idBaru);
        switch (strlen($newID)){
            case 1 :
                $newID = '000' . $newID;
                break;
            case 2 :
                $newID = '00' . $newID;
                break;
            case 3 :
                $newID = '0' . $newID;
                break;
        }
        return $newID;
        
    }
    
    function add($aset){
        $this->db->insert($this->table,$aset);
    }
    
    function update($id,$aset){
        $this->db->where('id',$id);
        $this->db->update($this->table,$aset);
    }
    
    function delete($id){
        $this->db->where('id',$id);
        $this->db->delete($this->table);
    }
    
    function countAllAset(){
        return $this->db->get($this->table)->num_rows();
    }
    
    function countAll($ranting,$jenis,$status,$bukti,$pengelola){
        $this->db->select('id');
        $this->db->from($this->table);
        if(strlen($jenis)>0){
            $this->db->where('jenis_aset',$jenis);
        }
        if(strlen($status)>0){
            $this->db->where('status_tanah',$status);
        }
        if(strlen($bukti)>0){
            $this->db->where('bukti_milik',$bukti);
        }
        if(strlen($pengelola)>0){
            $this->db->where('pengelola',$pengelola);
        }
        if(strlen($ranting)>0){
            $this->db->where('ranting',$ranting);
        }
        if(strlen($status)>0){
            $this->db->where('status_tanah',$status);
        }
        if(strlen($bukti)>0){
            $this->db->where('bukti_milik',$bukti);
        }
        if(strlen($pengelola)>0){
            $this->db->where('pengelola',$pengelola);
        }
        if(strlen($ranting)>0){
            $this->db->where('ranting',$ranting);
        }
        return $this->db->get()->num_rows();
    }

    function countRow($limit,$offset,$ranting,$jenis,$status,$bukti,$pengelola){
        $this->db->select('id');
        $this->db->from($this->table);
        if(strlen($jenis)>0){
            $this->db->where('jenis_aset',$jenis);
        }
        if(strlen($status)>0){
            $this->db->where('status_tanah',$status);
        }
        if(strlen($bukti)>0){
            $this->db->where('bukti_milik',$bukti);
        }
        if(strlen($pengelola)>0){
            $this->db->where('pengelola',$pengelola);
        }
        if(strlen($ranting)>0){
            $this->db->where('ranting',$ranting);
        }
        $this->db->limit($limit,$offset);
        return $this->db->get()->num_rows();
    }

    function countAsetByJenis($jenis){
        $this->db->select('id');
        $this->db->from($this->table);
        $this->db->where('left(jenis_aset,1)',$jenis);
        return $this->db->get()->num_rows();
    }
    
    function countAsetByKodeJenis($jenis){
        $this->db->select('id');
        $this->db->from($this->table);
        $this->db->where('jenis_aset',$jenis);
        return $this->db->get()->num_rows();
    }
    
    function countAsetByKelurahan($kelurahanID){
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('LEFT(id,10)',$kelurahanID);
        return $this->db->get()->num_rows();
    }
    
    function countAllByKelurahan($kelurahanID,$ranting,$jenis,$status,$bukti,$pengelola){
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('LEFT(id,10)',$kelurahanID);
        if(strlen($jenis)>0){
            $this->db->where('jenis_aset',$jenis);
        }
        if(strlen($status)>0){
            $this->db->where('status_tanah',$status);
        }
        if(strlen($bukti)>0){
            $this->db->where('bukti_milik',$bukti);
        }
        if(strlen($pengelola)>0){
            $this->db->where('pengelola',$pengelola);
        }
        if(strlen($ranting)>0){
            $this->db->where('ranting',$ranting);
        }
        return $this->db->get()->num_rows();
    }
    
    function countRowByKelurahan($limit,$offset,$kelurahanID,$ranting,$jenis,$status,$bukti,$pengelola){
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('LEFT(id,10)',$kelurahanID);
        if(strlen($jenis)>0){
            $this->db->where('jenis_aset',$jenis);
        }
        if(strlen($status)>0){
            $this->db->where('status_tanah',$status);
        }
        if(strlen($bukti)>0){
            $this->db->where('bukti_milik',$bukti);
        }
        if(strlen($pengelola)>0){
            $this->db->where('pengelola',$pengelola);
        }
        if(strlen($ranting)>0){
            $this->db->where('ranting',$ranting);
        }
        $this->db->limit($limit,$offset);
        return $this->db->get()->num_rows();
    }
    
    function getAllByKelurahan($limit,$offset,$kelurahanID,$ranting,$jenis,$status,$bukti,$pengelola){
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('LEFT(id,10)',$kelurahanID);
        if(strlen($jenis)>0){
            $this->db->where('jenis_aset',$jenis);
        }
        if(strlen($status)>0){
            $this->db->where('status_tanah',$status);
        }
        if(strlen($bukti)>0){
            $this->db->where('bukti_milik',$bukti);
        }
        if(strlen($pengelola)>0){
            $this->db->where('pengelola',$pengelola);
        }
        if(strlen($ranting)>0){
            $this->db->where('ranting',$ranting);
        }
        $this->db->order_by('id','asc');
        $this->db->limit($limit,$offset);
        return $this->db->get()->result();
    }
        
    function getAsetByKelurahan($kelurahanID){
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('LEFT(id,10)',$kelurahanID);
        $this->db->order_by('id','asc');
        return $this->db->get()->result();
        }
        
    function countAsetByKecamatan($kecamatanID){
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('LEFT(id,6)',$kecamatanID);
        return $this->db->get()->num_rows();
    }
    
    function countAllByKecamatan($kecamatanID,$ranting,$jenis,$status,$bukti,$pengelola){
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('LEFT(id,6)',$kecamatanID);
        if(strlen($jenis)>0){
            $this->db->where('jenis_aset',$jenis);
        }
        if(strlen($status)>0){
            $this->db->where('status_tanah',$status);
        }
        if(strlen($bukti)>0){
            $this->db->where('bukti_milik',$bukti);
        }
        if(strlen($pengelola)>0){
            $this->db->where('pengelola',$pengelola);
        }
        if(strlen($ranting)>0){
            $this->db->where('ranting',$ranting);
        }
        return $this->db->get()->num_rows();
    }
    
    function countRowByKecamatan($limit,$offset,$kecamatanID,$ranting,$jenis,$status,$bukti,$pengelola){
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('LEFT(id,6)',$kecamatanID);
        if(strlen($jenis)>0){
            $this->db->where('jenis_aset',$jenis);
        }
        if(strlen($status)>0){
            $this->db->where('status_tanah',$status);
        }
        if(strlen($bukti)>0){
            $this->db->where('bukti_milik',$bukti);
        }
        if(strlen($pengelola)>0){
            $this->db->where('pengelola',$pengelola);
        }
        if(strlen($ranting)>0){
            $this->db->where('ranting',$ranting);
        }
        $this->db->limit($limit,$offset);
        return $this->db->get()->num_rows();
    }
    
    function getAsetByKecamatan($kecamatanID){
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('LEFT(id,6)',$kecamatanID);
        $this->db->order_by('id','asc');
        return $this->db->get()->result();
    }
    
    function getAllByKecamatan($limit,$offset,$kecamatanID,$ranting,$jenis,$status,$bukti,$pengelola){
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('LEFT(id,6)',$kecamatanID);
        if(strlen($jenis)>0){
            $this->db->where('jenis_aset',$jenis);
        }
        if(strlen($status)>0){
            $this->db->where('status_tanah',$status);
        }
        if(strlen($bukti)>0){
            $this->db->where('bukti_milik',$bukti);
        }
        if(strlen($pengelola)>0){
            $this->db->where('pengelola',$pengelola);
        }
        if(strlen($ranting)>0){
            $this->db->where('ranting',$ranting);
        }
        $this->db->order_by('id','asc');
        $this->db->limit($limit,$offset);
        return $this->db->get()->result();
    }
        
    function countAsetByKota($kotaID){
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('LEFT(id,4)',$kotaID);
        return $this->db->get()->num_rows();
    } 
    
    function countAllByKota($kotaID,$ranting,$jenis,$status,$bukti,$pengelola){
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('LEFT(id,4)',$kotaID);
        if(strlen($jenis)>0){
            $this->db->where('jenis_aset',$jenis);
        }
        if(strlen($status)>0){
            $this->db->where('status_tanah',$status);
        }
        if(strlen($bukti)>0){
            $this->db->where('bukti_milik',$bukti);
        }
        if(strlen($pengelola)>0){
            $this->db->where('pengelola',$pengelola);
        }
        if(strlen($ranting)>0){
            $this->db->where('ranting',$ranting);
        }
        return $this->db->get()->num_rows();
    } 
    
    function countRowByKota($limit,$offset,$kotaID,$ranting,$jenis,$status,$bukti,$pengelola){
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('LEFT(id,4)',$kotaID);
        if(strlen($jenis)>0){
            $this->db->where('jenis_aset',$jenis);
        }
        if(strlen($status)>0){
            $this->db->where('status_tanah',$status);
        }
        if(strlen($bukti)>0){
            $this->db->where('bukti_milik',$bukti);
        }
        if(strlen($pengelola)>0){
            $this->db->where('pengelola',$pengelola);
        }
        if(strlen($ranting)>0){
            $this->db->where('ranting',$ranting);
        }
        $this->db->limit($limit,$offset);
        return $this->db->get()->num_rows();
    }
    
    function getAllByKota($limit,$offset,$kotaID,$ranting,$jenis,$status,$bukti,$pengelola){
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('LEFT(id,4)',$kotaID);
        if(strlen($jenis)>0){
            $this->db->where('jenis_aset',$jenis);
        }
        if(strlen($status)>0){
            $this->db->where('status_tanah',$status);
        }
        if(strlen($bukti)>0){
            $this->db->where('bukti_milik',$bukti);
        }
        if(strlen($pengelola)>0){
            $this->db->where('pengelola',$pengelola);
        }
        if(strlen($ranting)>0){
            $this->db->like('ranting',$ranting);
        }
        $this->db->order_by('id','asc');
        $this->db->limit($limit,$offset);
        return $this->db->get()->result();
    }
        
    function getAsetByKota($kotaID){
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('LEFT(id,4)',$kotaID);
        $this->db->order_by('id','asc');
        return $this->db->get()->result();
        }
        
    function countAsetByPropinsi($propinsiID){
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('LEFT(id,2)',$propinsiID);
        return $this->db->get()->num_rows();
    }
    
    function countAllByPropinsi($propinsiID,$ranting,$jenis,$status,$bukti,$pengelola){
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('LEFT(id,2)',$propinsiID);
        if(strlen($jenis)>0){
            $this->db->where('jenis_aset',$jenis);
        }
        if(strlen($status)>0){
            $this->db->where('status_tanah',$status);
        }
        if(strlen($bukti)>0){
            $this->db->where('bukti_milik',$bukti);
        }
        if(strlen($pengelola)>0){
            $this->db->where('pengelola',$pengelola);
        }
        if(strlen($ranting)>0){
            $this->db->where('ranting',$ranting);
        }
        return $this->db->get()->num_rows();
    }
    
    function countRowByPropinsi($limit,$offset,$propinsiID,$ranting,$jenis,$status,$bukti,$pengelola){
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('LEFT(id,2)',$propinsiID);
        if(strlen($jenis)>0){
            $this->db->where('jenis_aset',$jenis);
        }
        if(strlen($status)>0){
            $this->db->where('status_tanah',$status);
        }
        if(strlen($bukti)>0){
            $this->db->where('bukti_milik',$bukti);
        }
        if(strlen($pengelola)>0){
            $this->db->where('pengelola',$pengelola);
        }
        if(strlen($ranting)>0){
            $this->db->where('ranting',$ranting);
        }
        $this->db->limit($limit,$offset);
        return $this->db->get()->num_rows();
    }
    
    function getAllByPropinsi($limit,$offset,$propinsiID,$ranting,$jenis,$status,$bukti,$pengelola){
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('LEFT(id,2)',$propinsiID);
        if(strlen($jenis)>0){
            $this->db->where('jenis_aset',$jenis);
        }
        if(strlen($status)>0){
            $this->db->where('status_tanah',$status);
        }
        if(strlen($bukti)>0){
            $this->db->where('bukti_milik',$bukti);
        }
        if(strlen($pengelola)>0){
            $this->db->where('pengelola',$pengelola);
        }
        if(strlen($ranting)>0){
            $this->db->where('ranting',$ranting);
        }
        $this->db->order_by('id','asc');
        $this->db->limit($limit,$offset);
        return $this->db->get()->result();
    }
    
    function getAsetByPropinsi($propinsiID){
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('LEFT(id,2)',$propinsiID);
        $this->db->order_by('id','asc');
        return $this->db->get()->result();
    }
        
    function getAsetByID($id){
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('id',$id);
        return $this->db->get()->row();
        }
        
    function getAsetByJenis($jenis,$limit,$offset){
        $this->db->select('id,ket_jenis,nama_aset,lokasi,ranting');
        $this->db->from($this->table);
        $this->db->where('left(jenis_aset,1)',$jenis);
        $this->db->order_by('id','asc');
        $this->db->limit($limit,$offset);
        return $this->db->get();
    }
    
    function getAsetByCat($jenis,$id,$limit,$offset){
        $this->db->select('id,ket_jenis,nama_aset,lokasi,ranting');
        $this->db->from($this->table);
        $this->db->where('left(jenis_aset,1)',$jenis);
        switch (strlen($id)){
            case 2:
                $this->db->where('left(id,2)',$id);
                break;
            case 4:
                $this->db->where('left(id,4)',$id);
                break;
            case 6:
                $this->db->where('left(id,6)',$id);
                break;
            case 10:
                $this->db->where('left(id,10)',$id);
                break;
        }
        $this->db->order_by('id','asc');
        $this->db->limit($limit,$offset);
        return $this->db->get()->result();
    }
    
    function countAsetByCat($jenis,$id){
        $this->db->select('id');
        $this->db->from($this->table);
        $this->db->where('left(jenis_aset,1)',$jenis);
        switch (strlen($id)){
            case 2:
                $this->db->where('left(id,2)',$id);
                break;
            case 4:
                $this->db->where('left(id,4)',$id);
                break;
            case 6:
                $this->db->where('left(id,6)',$id);
                break;
            case 10:
                $this->db->where('left(id,10)',$id);
                break;
        }
        return $this->db->get()->num_rows();
    }
    
    function getAllAset($limit,$offset){
        $this->db->select('id,ket_jenis,nama_aset,lokasi,ranting');
        $this->db->from($this->table);
        $this->db->order_by('id','asc');
        $this->db->limit($limit,$offset);
        return $this->db->get();
    }
    
    function getAll($limit,$offset,$ranting,$jenis,$status,$bukti,$pengelola){
        $this->db->select('id,ket_jenis,nama_aset,lokasi,ranting');
        $this->db->from($this->table);
        if(strlen($jenis)>0){
            $this->db->where('jenis_aset',$jenis);
        }
        if(strlen($status)>0){
            $this->db->where('status_tanah',$status);
        }
        if(strlen($bukti)>0){
            $this->db->where('bukti_milik',$bukti);
        }
        if(strlen($pengelola)>0){
            $this->db->where('pengelola',$pengelola);
        }
        if(strlen($ranting)>0){
            $this->db->like('ranting',$ranting);
        }
        $this->db->order_by('id','asc');
        $this->db->limit($limit,$offset);
        return $this->db->get()->result();
    }
    
    function getAsetByKodeJenis($jenis,$limit,$offset){
        $this->db->select('id,ket_jenis,nama_aset,lokasi,ranting');
        $this->db->from($this->table);
        $this->db->where('jenis_aset',$jenis);
        $this->db->order_by('id','asc');
        $this->db->limit($limit,$offset);
        return $this->db->get();
    }
    
    function getLastAset(){
        $this->db->select('id,ranting,kprnu,tgl_survey,petugas');
        $this->db->from($this->table);
        $this->db->order_by('autoid','desc');
        $this->db->limit(1,0);
        return $this->db->get()->row();
    }
    
    function getRekapKel($limit,$offset,$KelID, $cat){
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('left(id,10)',$KelID);
        $this->db->where('left(jenis_aset,1)',$cat);
        $this->db->order_by('id','asc');
        $this->db->limit($limit,$offset);
        return $this->db->get()->result();
    }
    
    function countRekapKel($KelID, $cat){
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('left(id,10)',$KelID);
        $this->db->where('left(jenis_aset,1)',$cat);
        return $this->db->get()->num_rows();
    }
    
    function getRekapKec($limit,$offset,$KecID, $cat){
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('left(id,6)',$KecID);
        $this->db->where('left(jenis_aset,1)',$cat);
        $this->db->order_by('id','asc');
        $this->db->limit($limit,$offset);
        return $this->db->get()->result();
    }
    
    function countRekapKec($KecID, $cat){
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('left(id,6)',$KecID);
        $this->db->where('left(jenis_aset,1)',$cat);
        return $this->db->get()->num_rows();
    }
    
    function getRekapKota($limit,$offset,$KotaID, $cat){
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('left(id,4)',$KotaID);
        $this->db->where('left(jenis_aset,1)',$cat);
        $this->db->order_by('id','asc');
        $this->db->limit($limit,$offset);
        return $this->db->get()->result();
    }
    
    function countRekapKota($KotaID, $cat){
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('left(id,4)',$KotaID);
        $this->db->where('left(jenis_aset,1)',$cat);
        return $this->db->get()->num_rows();
    }
    
    function getRekapProp($limit,$offset,$PropID, $cat){
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('left(id,2)',$PropID);
        $this->db->where('left(jenis_aset,1)',$cat);
        $this->db->order_by('id','asc');
        $this->db->limit($limit,$offset);
        return $this->db->get()->result();
    }
    
    function countRekapProp($PropID, $cat){
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('left(id,2)',$PropID);
        $this->db->where('left(jenis_aset,1)',$cat);
        return $this->db->get()->num_rows();
    }
    
    function countRekapAll($cat){
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('left(jenis_aset,1)',$cat);
        return $this->db->get()->num_rows();
    }
    
    function cekAset($id,$jenis,$nama){
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('jenis_aset',$jenis);
        $this->db->where('nama_aset',$nama);
        $this->db->where('left(id,10)',$id);
        $row = $this->db->get()->num_rows();
        
        if($row > 0){
            return TRUE;
        }else{
            return FALSE;
        }
    }
    
    function rekapEntry($bulan,$tahun){
        $this->db->select('created,createdBy,count(*) as jumlah');
        $this->db->from($this->table);
        $this->db->where('month(created)',$bulan);
        $this->db->where('year(created)',$tahun);
        $this->db->group_by('created');
        $this->db->group_by('createdBy');
        return $this->db->get()->result();
    }
}

?>
