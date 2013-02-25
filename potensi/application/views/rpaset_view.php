<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


    echo !empty($h2_title) ? '<h2>' . $h2_title . '</h2>' : '';
                    
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
			,'Report','width='+screen.width+',height='+screen.height);
	myWindow.focus();
}
function createPDF(){
	myWindow=window.open(
			'<?php echo "http://".$_SERVER['SERVER_NAME']. $_SERVER['REQUEST_URI']."/createpdf"; ?>'
			+'?propinsi='+document.report_form.propinsi.value
			+'&kota='+document.report_form.kota.value
			+'&kecamatan='+document.report_form.kecamatan.value
			,'Report','width='+screen.width+',height='+screen.height);
	myWindow.focus();
}
</script>
<form name="report_form" action="<?php echo $form_action;?>" method="post">
    <div>
    <fieldset>
        <legend>REKAPITULASI ENTRY DATA ASET</legend>
	        <div style="float:left;margin-right:5px;"><span class="propinsi"></span></div>
	        <div style="float:left;margin-right:5px;"><span class="kota"></span></div>
	        <div style="float:left;margin-right:10px;"><span class="kecamatan"></span></div>
	        <div style='margin-bottom:15px;'><button onClick="createPDF()" style="vertical-align:middle"><img src="<?php echo base_url(); ?>images/pdfIcon.jpg" style="height:18px;width:18px"> Export PDF</button></div>	        
        
        <?php echo !empty($message) ? $message : ''; ?>
        <?php echo !empty($table) ? $table : ''; ?>  
        <div style='margin-top:5px;width:100%;'>
        <?php  echo !empty($pagination) ? '<div style="float:left">  <p id="pagination">'.$pagination.'</p></div>' : ''; ?>
        <?php if (!empty($table)) { ?>
        <div style="float:right"> 
	    </div>
        <?php } ?> 
        </div>
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
