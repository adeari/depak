<?php
    echo !empty($h2_title) ? '<h2>' . $h2_title . '</h2>' : '';
     echo !empty($message) ? '<p>'.$message.'</p>' : '';
                    
    $flashmessage = $this->session->flashdata('message');
    echo !empty($flashmessage) ? '<p class="message">'.$flashmessage.'</p>' : '';
?>

<form name="kota_form" action="<?php echo $form_action;?>" method="post">
    <div  align="center">
    <fieldset>
        <legend>INPUT DATA KOTA</legend>
        <table width="600" cellpadding="0" cellspacing="0" border="0">
            <tr>
        <td width="150" height="25" align="right">Propinsi</td>
        <td width="20">&nbsp;</td>
        <td><input type="text" name="propinsi" readonly="readonly" 
                   value="<?php
                        $propID = $this->uri->segment(3);
                        $propinsi = $this->Propinsi_model->getProp($propID);
                        echo $propinsi->namaPropinsi;
                   ?>" />
        </td>
        </tr>
            <tr>
        <td width="150" height="25" align="right">ID Kota</td>
        <td width="20">&nbsp;</td>
        <td><input type="text" name="kotaID" 
                   value="<?php
                        echo $this->uri->segment(3);
                        ?>" />
        </td>
        </tr>
        <tr>
            <td height="25" align="right">Nama Kota</td>
            <td width="20">&nbsp;</td>
        <td><input type="text" name="namaKota" size="40" value="" /><td>
        </tr>
        <tr>
            <td colspan="3">&nbsp;</td>
        </tr>
        <tr>
            <td colspan="2">&nbsp;</td>
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