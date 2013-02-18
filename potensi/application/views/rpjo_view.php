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
			,'Report','width=200,height=100');
	myWindow.focus();
}
<?php } else if (strcmp($viewPage,"rincianKabupaten")==0) {  ?>
function createPDFRinciKabupaten(str){
	myWindow=window.open(
			'<?php echo $linkExport."/createpdf"; ?>'
			+'?jenis=rinciKabupaten'
			+'&kabupatenID='+str
			,'Report','width=200,height=100');
	myWindow.focus();
}
<?php } else if (strcmp($viewPage,"rincianKecamatan")==0) {  ?>
function createPDFRinciKecamatan(str){
	myWindow=window.open(
			'<?php echo $linkExport."/createpdf"; ?>'
			+'?jenis=rinciKecamatan'
			+'&kecamatanID='+str
			,'Report','width=200,height=100');
	myWindow.focus();
<?php } else if (strcmp($viewPage,"rincianDesa")==0) {  ?>
function createPDFRinciDesa(str){
		myWindow=window.open(
				'<?php echo $linkExport."/createpdf"; ?>'
				+'?jenis=rinciDesa'
				+'&desaID='+str
				,'Report','width=200,height=100');
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
         	Rincian Jumlah masing-masing obyek di Propinsi <?php echo $namaPropinsi;?>
         	<br>
	        <br>
	        <?php if (!empty($table)) { ?>
		        <input type="button" name="btn" onClick="createPDFRinciPropinsi(<?php echo $propinsiID;?>)" value="Export PDF" />
		        <div width="100%" align="center">
	        		<?php echo $table; ?>
	        	</div>
	        <?php } else echo !empty($message) ? $message : ''; ?>
        <?php } else if (strcmp($viewPage,"levelKabupaten")==0) {  ?>
         	Rekap jumlah obyek Per Kabupaten di Propinsi <?php echo $namaPropinsi;?>
         	<br>
	        <br>
	        <?php echo !empty($message) ? $message : ''; ?>
	        <div width="100%" align="center">
        		<?php echo !empty($table) ? $table : ''; ?>
        	</div>
        <?php } else if (strcmp($viewPage,"rincianKabupaten")==0) {  ?>
         	Rincian Jumlah masing-masing obyek di <?php echo $namaKabupaten;?>
         	<br>
	        <br>
	        <?php if (!empty($table)) { ?>
		        <input type="button" name="btn" onClick="createPDFRinciKabupaten(<?php echo $kabupatenID;?>)" value="Export PDF" />
		        <div width="100%" align="center">
	        		<?php echo $table; ?>
	        	</div>
	        <?php } else echo !empty($message) ? $message : ''; ?>
        <?php } else if (strcmp($viewPage,"levelKecamatan")==0) {  ?>
         	Rekap jumlah obyek Per Kecamatan di <?php echo $namaKabupaten;?>
         	<br>
	        <br>
	        <?php echo !empty($message) ? $message : ''; ?>
	        <div width="100%" align="center">
        		<?php echo !empty($table) ? $table : ''; ?>
        	</div>
        <?php } else if (strcmp($viewPage,"rincianKecamatan")==0) {  ?>
         	Rincian Jumlah masing-masing obyek di <?php echo $namaKecamatan;?>
         	<br>
	        <br>
	        <?php if (!empty($table)) { ?>
		        <input type="button" name="btn" onClick="createPDFRinciKecamatan(<?php echo $kecamatanID;?>)" value="Export PDF" />
		        <div width="100%" align="center">
	        		<?php echo $table; ?>
	        	</div>
	        <?php } else echo !empty($message) ? $message : ''; ?>
        <?php } else if (strcmp($viewPage,"levelDesa")==0) {  ?>
         	Rekap jumlah obyek Per Desa di <?php echo $namaKecamatan;?>
         	<br>
	        <br>
	        <?php echo !empty($message) ? $message : ''; ?>
	        <div width="100%" align="center">
        		<?php echo !empty($table) ? $table : ''; ?>
        	</div>
        <?php } else if (strcmp($viewPage,"rincianDesa")==0) {  ?>
         	Rincian Jumlah masing-masing obyek di Desa <?php echo $namaDesa;?>
         	<br>
	        <br>
	        <?php if (!empty($table)) { ?>
		        <input type="button" name="btn" onClick="createPDFRinciDesa(<?php echo $desaID;?>)" value="Export PDF" />
		        <div width="100%" align="center">
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
