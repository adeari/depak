<?php
    echo !empty($h2_title) ? '<h2>' . $h2_title . '</h2>' : '';
     echo !empty($message) ? '<p>'.$message.'</p>' : '';
                    
    $flashmessage = $this->session->flashdata('message');
    echo !empty($flashmessage) ? '<p class="message">'.$flashmessage.'</p>' : '';
?>

<form name="jenis_form" action="<?php echo $form_action;?>" method="post">
    <div  align="center">
    <fieldset>
        <legend>UPDATE DATA STATUS TANAH</legend>
        <table width="600" cellpadding="0" cellspacing="0" border="0">
        <tr>
        <td width="150" height="25" align="right">Status Tanah</td>
        <td width="20">&nbsp;</td>
        <td><input type="hidden" name="id" size="10" 
                   value="<?php echo set_value('id',  isset($default['id']) ? $default['id'] : '');?>" />
            <input type="text" name="status_tanah" size="10" 
                   value="<?php echo set_value('status_tanah',  isset($default['status_tanah']) ? $default['status_tanah'] : '');?>" /></td>
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