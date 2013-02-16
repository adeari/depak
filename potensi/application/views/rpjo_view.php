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
function PrintDataHere(){
	myWindow=window.open(
			'<?php echo "http://".$_SERVER['SERVER_NAME']. $_SERVER['REQUEST_URI']."/printDataHere"; ?>'
			+'?propinsi='+document.report_form.propinsi.value
			+'&kota='+document.report_form.kota.value
			+'&kecamatan='+document.report_form.kecamatan.value
			,'Report','width=200,height=100');
	myWindow.focus();
}
function createPDF(){
	myWindow=window.open(
			'<?php echo "http://".$_SERVER['SERVER_NAME']. $_SERVER['REQUEST_URI']."/createpdf"; ?>'
			+'?propinsi='+document.report_form.propinsi.value
			+'&kota='+document.report_form.kota.value
			+'&kecamatan='+document.report_form.kecamatan.value
			,'Report','width=200,height=100');
	myWindow.focus();
}
</script>
    <div>
    
    <fieldset>
        <legend>Rekapitulkasi jumlah object</legend>
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
	        <?php echo !empty($message) ? $message : ''; ?>
        	<?php echo !empty($table) ? $table : ''; ?>
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
