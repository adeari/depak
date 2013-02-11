/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

function ambil_prop(id){
    $.ajax({
       url: "http://localhost/potensi/index.php/propinsi/getPropinsi/"+id,
       success: function(msg){
           $('.propinsi').html(msg);
           ambil_kota(id);
           ambil_kec(id);
           ambil_kel(id);
       },
       dataType: "html"
    });
}

function ambil_propInRPaset(id,posting,kotaID,kecID){
    $.ajax({
       url: "http://localhost/potensi/index.php/propinsi/getPropinsiInRPaset/"+id,
       success: function(msg){
           $('.propinsi').html(msg);
           ambil_kotaInRPaset(id,posting,kotaID,kecID);
       },
       dataType: "html"
    });
}

function ambil_kotaInRPaset(id,posting,kotaID,kecID){
    $.ajax({
        url: "http://localhost/potensi/index.php/kota/getKotaRPaset/"+id+"/"+kotaID,
        success: function(msg){
            $('.kota').html(msg);
            ambil_kecInRPaset(kotaID,posting,kecID);
        },
        dataType: "html"
    });
}

function ambil_kota(id){
    $.ajax({
        url: "http://localhost/potensi/index.php/kota/getKota/"+id,
        success: function(msg){
            $('.kota').html(msg);
            ambil_kec(id);
            ambil_kel(id);
        },
        dataType: "html"
    });
}

function ambil_kecInRPaset(id,posting,kecID){
    $.ajax({
        
        url: "http://localhost/potensi/index.php/kecamatan/getKecamatanRPaset/"+id+"/"+kecID,
        success: function(msg){
            $('.kecamatan').html(msg);
            if (posting) {
            	document.report_form.submit();
            }
        },
        dataType: "html"
    });
}
            
function ambil_kec(id){
    $.ajax({
        
        url: "http://localhost/potensi/index.php/kecamatan/getKecamatan/"+id,
        success: function(msg){
            $('.kecamatan').html(msg);
            ambil_kel(id);
        },
        dataType: "html"
    });
}

            
function ambil_kel(id){
    $.ajax({
        url: "http://localhost/potensi/index.php/kelurahan/getKelurahan/"+id,
        success: function(msg){
            $('.kelurahan').html(msg);
            getNewAsetID(id)
        },
        dataType: "html"
    });
}
            
function getNewAsetID(id){
    $.ajax({
        url: "http://localhost/potensi/index.php/aset/getNewAsetID/"+id,
        success: function(msg){
            $('.noaset').html(msg);
        },
        dataType: "html"
    });
}

function getJenis(kode_jenis){
    $.ajax({
        url: "http://localhost/potensi/index.php/jenis/getJenis/"+kode_jenis,
        success: function(msg){
            $('.jenis').html(msg);
        },
        dataType: "html"
    });
}

function getStatus(id_status){
    $.ajax({
        url: "http://localhost/potensi/index.php/status/getStatus/"+id_status,
        success: function(msg){
            $('.status').html(msg);
        },
        dataType: "html"
    });
}

function getBukti(id_bukti){
    $.ajax({
        url: "http://localhost/potensi/index.php/bukti/getBukti/"+id_bukti,
        success: function(msg){
            $('.bukti').html(msg);
        },
        dataType: "html"
    });
}

function getPengelola(id_pengelola){
    $.ajax({
        url: "http://localhost/potensi/index.php/pengelola/getPengelola/"+id_pengelola,
        success: function(msg){
            $('.pengelola').html(msg);
        },
        dataType: "html"
    });
}

function getPropID(propID){
    $.ajax({
       url: "http://localhost/potensi/index.php/propinsi/BgetPropID/"+propID,
        success: function(msg){
            $('.propID').html(msg);
        },
        dataType: "html"
    });
}

function showDetail(){
    var id = document.getElementById("id").value 
    $.ajax({
       
       url: "http://localhost/potensi/index.php/search/detail/"+id,
        success: function(msg){
            $('.detail').html(msg);
        },
        dataType: "html"
    });
}

function hideDetail(){
    $.ajax({
        url: "http://localhost/potensi/index.php/search/hide/"+id,
        success: function(msg){
            $('.detail').html(msg);
        },
        dataType: "html"
    })
}

function isExist(nama){
    var id = document.getElementById("id").value
    var jenis= document.getElementById("jenis").value
    
    $.ajax({
        url: "http://localhost/potensi/index.php/aset/cekAset/"+jenis+"/"+id+"/"+nama,
        success: function(msg){
            $('.exist').html(msg);
            
        },
        dataType: "html"
    })
}

