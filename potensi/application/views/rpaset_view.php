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
			'<?php echo "http://".$_SERVER['SERVER_NAME']. $_SERVER['REQUEST_URI']."/createpdf"; ?>'
			+'?propinsi='+document.report_form.propinsi.value
			+'&kota='+document.report_form.kota.value
			+'&kecamatan='+document.report_form.kecamatan.value
			,'Report','width=200,height=100');
	myWindow.focus();
}
</script>
<form name="report_form"  method="post">
    <div>
    <fieldset>
        <legend>REKAPITULASI ENTRY DATA ASET</legend>
        <table width="600" cellpadding="0" cellspacing="0" border="0">
            <tr>        
                <td><span class="propinsi"></span></td>
            </tr>
            <tr>
                <td><span class="kota"></span></td>
            </tr>
            <tr>
                <td><span class="kecamatan"></span></td>
            </tr>
            <tr>
                <td align="center"><input type="button" name="btn" onClick="createPDF()" value="Export PDF" /></td>
            </tr>
        </table>
        <br>
        <br>
        <?php echo !empty($table) ? $table : ''; ?>
        <?php  echo !empty($pagination) ? '<p id="pagination">'.$pagination.'</p>' : ''; ?> 
    </fieldset>
    </div>
</form>
        
<?php
    if(!empty ($link)){
        echo '<p id="bottom_link">';
        foreach($link as $links){
            echo $links . ' ';
        }
        echo '</p>';
    }

?>
