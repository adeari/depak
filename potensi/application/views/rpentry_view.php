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
        <legend>REKAPITULASI PEROLEHAN ENTRY DATA</legend>
        <?php  if (!empty($person)) { ?> 
        <fieldset>
        	<table>
        		<tr><td>Petugas</td><td>:</td><td><?php echo $person?></td></tr>
        		<tr><td>Total</td><td>:</td><td><?php echo $total?></td></tr>
        	</table>
        </fieldset>
        <?php }?>
        <br>
        <br>
        <?php echo !empty($message) ? $message : ''; ?>
        <div width="100%" align="center">
        	<?php echo !empty($table) ? $table : ''; ?>
        </div>
        <?php  echo !empty($pagination) ? '<p id="pagination">'.$pagination.'</p>' : ''; ?> 
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
