/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

function validasiForm(){
    var prop=document.aset_form.propinsi.value;
    if(prop==""){
        alert("Harap pilih propinsi");
        statProp = false;
    }
    
    var kota=document.aset_form.kota.value;
    if(kota==""){
        alert("Harap pilih kota");
        statKota = false;
    }
    
    var kec=document.aset_form.kecamatan.value;
    if(kec==""){
        alert("Harap pilih kecamatan");
        stakKec = false;
    }
    
    var kel=document.aset_form.kelurahan.value;
    if(kel==""){
        alert("Harap pilih keluarahan");
        statKel = false;
    }
    
    var ranting = document.aset_form.ranting.value;
    if(ranting==""){
        alert("Field Ranting harus diisi");
        statRanting = false;
    }
    
    var kprnu = document.aset_form.kprnu.value;
    if(kprnu==""){
        alert("Field Ketua Ranting harus diisi");
        statKprnu = false;
    }
    
    var survey = document.aset_form.tgl_survey.value;
    if(survey==""){
        alert("Field Tgl. Survey harus diisi");
        statSurvey = false;
    }
    
    var petugas = document.aset_form.petugas.value;
    if(petugas==""){
        alert("Field Petugas Survey harus diisi");
        statPetugas = false;
    }
    
    var jenis = document.aset_form.jenis_aset.value;
    if(jenis==""){
        alert("Field Jenis Aset harus diisi");
        statJenis= false;
    }
    
    var nama = document.aset_form.nama_aset.value;
    if(nama==""){
        alert("Field Nama Aset harus diisi");
        statNama= false;
    }
    
    var alamat = document.aset_form.lokasi.value;
    if(alamat==""){
        alert("Field Alamat/Lokasi Aset harus diisi");
        statAlamat= false;
    }
    
    var status = document.aset_form.status_tanah.value;
    if(status==""){
        alert("Harap pilih Status tanah");
        statStatus= false;
    }
    
    var bukti = document.aset_form.bukti_milik.value;
    if(bukti==""){
        alert("Harap pilih Bukti Kepemilikan");
        statBukti = false;
    }
    
    var pengelola = document.aset_form.pengelola.value;
    if(pengelola==""){
        alert("Harap pilih Pengelola");
        statPengelola = false;
    }
    
    if(statProp == false || statKota == false || statKec == false || 
        statKel == false || statRanting == false || statKprnu == false ||
        statSurvey == false || statPetugas == false || statJenis == false ||
        statNama == false || statAlamat == false || statStatus == false ||
        statBukti == false || statPengelola){
        return false
    }else{
        return true;
    }
}
