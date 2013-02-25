<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


    echo !empty($h2_title) ? '<h2>' . $h2_title . '</h2>' : '';
     echo !empty($message) ? '<p>'.$message.'</p>' : '';
                    
    $flashmessage = $this->session->flashdata('message');
    echo !empty($flashmessage) ? '<p>'.$flashmessage.'</p>' : '';
?>
<script>
<?php  if (strcmp($viewPage,"rincianPropinsi")==0) {  ?>
function createPDFRinciPropinsi(str){
	myWindow=window.open(
			'<?php echo $linkExport."/createpdf"; ?>'
			+'?jenis=rinciPropinsi'
			+'&propinsiID='+str
			,'Report','width='+screen.width+',height='+screen.height);
	myWindow.focus();
}
<?php } else if (strcmp($viewPage,"rincianKabupaten")==0) {  ?>
function createPDFRinciKabupaten(str){
	myWindow=window.open(
			'<?php echo $linkExport."/createpdf"; ?>'
			+'?jenis=rinciKabupaten'
			+'&kabupatenID='+str
			,'Report','width='+screen.width+',height='+screen.height);
	myWindow.focus();
}
<?php } else if (strcmp($viewPage,"rincianKecamatan")==0) {  ?>
function createPDFRinciKecamatan(str){
	myWindow=window.open(
			'<?php echo $linkExport."/createpdf"; ?>'
			+'?jenis=rinciKecamatan'
			+'&kecamatanID='+str
			,'Report','width='+screen.width+',height='+screen.height);
	myWindow.focus();
}
<?php } else if (strcmp($viewPage,"rincianDesa")==0) {  ?>
function createPDFRinciDesa(str){
		myWindow=window.open(
				'<?php echo $linkExport."/createpdf"; ?>'
				+'?jenis=rinciDesa'
				+'&desaID='+str
				,'Report','width='+screen.width+',height='+screen.height);
		myWindow.focus();	
}
<?php } else if (strcmp($viewPage,"levelKabupaten")==0) {  ?>
function perKabupaten(str){
		myWindow=window.open(
				'<?php echo $linkExport."/createpdf"; ?>'
				+'?jenis=diKabupaten'
				+'&propinsiID='+str
				,'Report','width='+screen.width+',height='+screen.height);
		myWindow.focus();	
}
<?php } else if (strcmp($viewPage,"levelKecamatan")==0) {  ?>
function perKecamatan(str){
		myWindow=window.open(
				'<?php echo $linkExport."/createpdf"; ?>'
				+'?jenis=diKecamatan'
				+'&kabupatenID='+str
				,'Report','width='+screen.width+',height='+screen.height);
		myWindow.focus();	
}
<?php } else if (strcmp($viewPage,"levelDesa")==0) {  ?>
function perDesa(str){
		myWindow=window.open(
				'<?php echo $linkExport."/createpdf"; ?>'
				+'?jenis=diDesa'
				+'&kecamatanID='+str
				,'Report','width='+screen.width+',height='+screen.height);
		myWindow.focus();	
}
<?php }  ?>
</script>
    <div>
    
    <fieldset>
        <legend>Rekapitulasi jumlah object</legend>
        <br>
        <?php  if (strcmp($viewPage,"propinsi")==0) { ?>
	        Total Jumlah Obyek di <?php echo $namaPropinsi;?> terhitung sampai tanggal (<?php echo $tglSkr;?>) adalah <?php echo $totalOFF;?>
	        <br>
	        <br>
	        <?php echo $rincianObject;?>
	        <br>
        	<?php echo $jmlObjekPerkabupaten;?>  
        <?php } else if (strcmp($viewPage,"rincianPropinsi")==0) {  ?>
         	<div style="float:left;margin-right:25px;">Rincian Jumlah masing-masing obyek di Propinsi <?php echo $namaPropinsi;?></div>
         	<?php if (!empty($table)) { ?>
         	<div style="float:left;margin-bottom:5px;"><button onClick="createPDFRinciPropinsi(<?php echo $propinsiID;?>)" style="vertical-align:middle"><img src="<?php echo base_url(); ?>images/pdfIcon.jpg" style="height:18px;width:18px"> Export PDF</button></div>
         	<?php } ?>
	        <?php if (!empty($table)) { ?>		        
		        <div style="float:left;width:100%;text-align:center">
	        		<?php echo $table; ?>
	        	</div>
	        <?php } else echo !empty($message) ? $message : ''; ?>
        <?php } else if (strcmp($viewPage,"levelKabupaten")==0) {  ?>
        <div style='margin-bottom:5px;width:100%;vertical-align:middle'>
         	<div style="float:left;margin-right:5px">Rekap jumlah obyek Per Kabupaten di Propinsi <?php echo $namaPropinsi;?></div>
         	<?php if (!empty($table)) { ?>
         	<div><button onClick="perKabupaten(<?php echo $propinsiID?>)" style="vertical-align:middle"><img src="<?php echo base_url(); ?>images/pdfIcon.jpg" style="height:18px;width:18px"> Export PDF</button></div>
         	<?php } ?>
        </div>
	        <?php echo !empty($message) ? $message : ''; ?>
	        <div style="width:40%;margin-left: auto ;margin-right: auto ;text-align:center">
        		<?php echo !empty($table) ? $table : ''; ?>
        	</div>
        <?php } else if (strcmp($viewPage,"rincianKabupaten")==0) {  ?>
         	<div style="float:left;margin-right:5px;">Rincian Jumlah masing-masing obyek di <?php echo $namaKabupaten;?></div>
         	<?php if (!empty($table)) { ?>
         	<div style="margin-bottom:5px;"><button onClick="createPDFRinciKabupaten(<?php echo $kabupatenID;?>)" style="vertical-align:middle"><img src="<?php echo base_url(); ?>images/pdfIcon.jpg" style="height:18px;width:18px"> Export PDF</button></div>
         	<?php } ?>
	        <?php if (!empty($table)) { ?>
		        <div style="width:70%;margin-left: auto ;margin-right: auto ;text-align:center">
	        		<?php echo $table; ?>
	        	</div>
	        <?php } else echo !empty($message) ? $message : ''; ?>
        <?php } else if (strcmp($viewPage,"levelKecamatan")==0) {  ?>
         	<div style="float:left;margin-right:5px">Rekap jumlah obyek Per Kecamatan di <?php echo $namaKabupaten;?></div>
         	<?php if (!empty($table)) { ?>
         	<div style="margin-bottom:5px;"><button onClick="perKecamatan(<?php echo $kabupatenID?>)" style="vertical-align:middle"><img src="<?php echo base_url(); ?>images/pdfIcon.jpg" style="height:18px;width:18px"> Export PDF</button></div>
         	<?php } ?>
	        <?php echo !empty($message) ? $message : ''; ?>
	        <div style="width:40%;margin-left: auto ;margin-right: auto ;text-align:center">
        		<?php echo !empty($table) ? $table : ''; ?>
        	</div>
        <?php } else if (strcmp($viewPage,"rincianKecamatan")==0) {  ?>
         	<div style="float:left;margin-right:5px">Rincian Jumlah masing-masing obyek di <?php echo $namaKecamatan;?></div>
         	<?php if (!empty($table)) { ?>
         	<div style="margin-bottom:5px;"><button onClick="createPDFRinciKecamatan(<?php echo $kecamatanID;?>)" style="vertical-align:middle"><img src="<?php echo base_url(); ?>images/pdfIcon.jpg" style="height:18px;width:18px"> Export PDF</button></div>
         	<?php } ?>
	        <?php if (!empty($table)) { ?>
		        <div style="width:70%;margin-left: auto ;margin-right: auto ;text-align:center">
	        		<?php echo $table; ?>
	        	</div>
	        <?php } else echo !empty($message) ? $message : ''; ?>
        <?php } else if (strcmp($viewPage,"levelDesa")==0) {  ?>
         	<div style="float:left;margin-right:5px">Rekap jumlah obyek Per Desa di <?php echo $namaKecamatan;?></div>
         	<?php if (!empty($table)) { ?>
         	<div style="margin-bottom:5px;"><button onClick="perDesa(<?php echo $kecamatanID?>)" style="vertical-align:middle"><img src="<?php echo base_url(); ?>images/pdfIcon.jpg" style="height:18px;width:18px"> Export PDF</button></div>
         	<?php } ?>
	        <?php echo !empty($message) ? $message : ''; ?>
	        <div style="width:70%;margin-left: auto ;margin-right: auto ;text-align:center">
        		<?php echo !empty($table) ? $table : ''; ?>
        	</div>
        <?php } else if (strcmp($viewPage,"rincianDesa")==0) {  ?>
         	<div style="float:left;margin-right:5px">Rincian Jumlah masing-masing obyek di Desa <?php echo $namaDesa;?></div>
         	<?php if (!empty($table)) { ?>
         	<div style="margin-bottom:5px;"><button onClick="createPDFRinciDesa(<?php echo $desaID;?>)" style="vertical-align:middle"><img src="<?php echo base_url(); ?>images/pdfIcon.jpg" style="height:18px;width:18px"> Export PDF</button></div>
         	<?php } ?>
	        <?php if (!empty($table)) { ?>
		        <div style="width:70%;margin-left: auto ;margin-right: auto ;text-align:center">
	        		<?php echo $table; ?>
	        	</div>
	        <?php } else echo !empty($message) ? $message : ''; ?>
        <?php } ?>
    </fieldset>
    
    </div>
        
<?php
    if(!empty ($link)){
        echo '<p id="bottom_link">';
        foreach($link as $links){
            echo $links . ' ';
        }
        echo '</p>';
    }

?>
