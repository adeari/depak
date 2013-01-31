<?php
    echo !empty($h2_title) ? '<h2>' . $h2_title . '</h2>' : '';
     echo !empty($message) ? '<p>'.$message.'</p>' : '';
                    
    $flashmessage = $this->session->flashdata('message');
    echo !empty($flashmessage) ? '<p class="message">'.$flashmessage.'</p>' : '';
?>

<form name="user_form" action="<?php echo $form_action;?>" method="post">
    <div  align="center">
    <fieldset>
        <legend>UPDATE DATA USER</legend>
        <table width="600" cellpadding="0" cellspacing="0" border="0">
        <tr>
        <td width="150" height="25" align="right">Username</td>
        <td width="20">&nbsp;</td>
        <td><input type="hidden" name="id" size="10" 
                   value="<?php echo set_value('id',  isset($default['id']) ? $default['id'] : '');?>" />
            <input type="text" name="username" size="40" 
                   value="<?php echo set_value('username',  isset($default['username']) ? $default['username'] : '');?>" /></td>
        </tr>
        <tr>
            <td height="25" align="right">Nama</td>
            <td width="20">&nbsp;</td>
        <td><input type="text" name="nama" size="40" 
                   value="<?php echo set_value('nama',  isset($default['nama']) ? $default['nama'] : '');?>" /></td>
        </tr>
        <tr>
            <td height="25" align="right">Password</td>
            <td width="20">&nbsp;</td>
        <td><input type="password" name="nama" size="40" value="" /><td>
        </tr>
        <tr>
            <td height="25" align="right">Akses</td>
            <td width="20">&nbsp;</td>
            <td>
            <select name='akses' style="width:150px">
                <option value="Administrator">Administrator</option>
                <option value="Supervisor">Supervisor</option>
                <option value="Entry">Entry</option>
                <option value="User">User</option>
            </select>
            </td></tr>
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