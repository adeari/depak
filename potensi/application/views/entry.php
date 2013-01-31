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

<form name="rptentry_form" action="<?php echo $form_action;?>" method="post">
    <div>
    <fieldset>
        <legend>REKAPITULASI ENTRY DATA ASET PER USER</legend>
        <table width="600" cellpadding="0" cellspacing="0" border="0">
            <tr>        
                <td>Bulan</td>
                <td>
                    <select name="bulan" style="width:120px">
                        <option value="1">Januari</option>
                        <option value="2">Pebruari</option>
                        <option value="3">Maret</option>
                        <option value="4">April</option>
                        <option value="5">Mei</option>
                        <option value="6">Juni</option>
                        <option value="7">Juli</option>
                        <option value="8">Agustus</option>
                        <option value="9">September</option>
                        <option value="10">Oktober</option>
                        <option value="11">Nopember</option>
                        <option value="12">Desember</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Tahun </td>
                <td><input type="text" name="tahun" size="15"></td>
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
