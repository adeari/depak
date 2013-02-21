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
function createPDF(){
	myWindow=window.open(
			<?php  if (strcmp($jenisReport,"1")==0) { ?> 
				'<?php echo "http://".$_SERVER['SERVER_NAME']. $_SERVER['REQUEST_URI']."/createpdf"; ?>'
			<?php } else if (strcmp($jenisReport,"person")==0) { ?>
				'<?php echo $linkExport."/createpdf"; ?>'
			<?php } ?>
			+'?jenis=<?php echo $jenisReport; ?>'
			+'&id=<?php echo $idPerson; ?>'
			,'Report','width=200,height=100');
	myWindow.focus();
}
</script>
    <div>
    <fieldset>
        <legend>REKAPITULASI PEROLEHAN ENTRY DATA</legend>
        <?php  if (strcmp($jenisReport,"1")==0) { ?> 
        	<button onClick="createPDF()" style="vertical-align:middle"><img src="<?php echo base_url(); ?>images/pdfIcon.jpg" style="height:18px;width:18px"> Export PDF</button>
        <?php } ?>
        <?php  if (!empty($person)) { ?> 
	        <fieldset>
	        	<table>
	        		<tr><td>Petugas</td><td>:</td><td><?php echo $person?></td>
	        		<td rowspan="2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	        		<button onClick="createPDF()" style="vertical-align:middle"><img src="<?php echo base_url(); ?>images/pdfIcon.jpg" style="height:18px;width:18px"> Export PDF</button></td></tr>
	        		<tr><td>Total</td><td>:</td><td><?php echo $total?></td></tr>
	        	</table>
	        </fieldset>
        <?php }?>
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
