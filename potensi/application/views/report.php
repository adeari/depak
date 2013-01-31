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

<form name="report_form" action="<?php echo $form_action;?>" method="post">
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
                <td><span class="kelurahan"></span></td>
            </tr>
            <tr>
                <td>Ranting <br /><input type="text" name="ranting" value="" size="32" /></td>
            </tr>
            <tr>
                <td align="center"><input type="submit" name="submit" value="Submit" /></td>
            </tr>
        </table>
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
