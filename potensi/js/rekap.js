/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

function rekap_prop(id){
    $.ajax({
       
       url: "http://localhost/potensi/index.php/propinsi/getRekapProp/"+id,
       success: function(msg){
           $('.rekapPropinsi').html(msg);
           hitung(id);
           rekap_kota(id);
           rekap_kec(id);
           rekap_kel(id);
           
       },
       dataType: "html"
    });
}

function rekap_kota(id){
    $.ajax({
        url: "http://localhost/potensi/index.php/kota/getRekapKota/"+id,
        success: function(msg){
            $('.rekapKota').html(msg);
            rekap_kec(id);
            rekap_kel(id);
            getRekap(id);
            hitung(id);
        },
        dataType: "html"
    });
}

function rekap_kec(id){
    $.ajax({
        url: "http://localhost/potensi/index.php/kecamatan/getRekapKec/"+id,
        success: function(msg){
            $('.rekapKecamatan').html(msg);
            rekap_kel(id);
            getRekap(id);
            hitung(id);
        },
        dataType: "html"
    });
}

function rekap_kel(id){
    $.ajax({
        url: "http://localhost/potensi/index.php/kelurahan/getRekapKel/"+id,
        success: function(msg){
            $('.rekapKelurahan').html(msg);
            getRekap(id);
            hitung(id);
        },
        dataType: "html"
    });
}

function hitung(id){
    $.ajax({
       url: "http://localhost/potensi/index.php/aset/hitung/"+id,
       success: function(msg){
           $('.hitung')
           
       },
       dataType: "html"
    });
}

function getRekap(id){
    $.ajax({
       url: "http://localhost/potensi/index.php/aset/countRekap/"+id,
       success: function(msg){
           $('.rekap').html(msg);
       },
       dataType: "html"
    });
}

