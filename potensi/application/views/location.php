<?php
    $cat = $this->uri->segment(3);
?>

<table width="900" cellpadding="0" cellspacing="0" border="1" bgcolor="#ffffff">
    <tr>
        <td>
            <form name="aset_form" action="<?php echo $form_action;?>" method="post">
                <input type="hidden" name="cat" value="<?php echo $cat;?>" />
            <table width="600" cellpadding="0" cellspacing="0">
                <tr>
                    <td><span class="propinsi"</td>
                </tr>
                <tr>
                    <td><span class="kota"</td>
                </tr>
                <tr>
                    <td><span class="kecamatan"</td>
                </tr>
                <tr>
                    <td><span class="kelurahan"</td>
                </tr>
                <tr>
                    <td>
                        <input type="submit" name="submit" value="View" />
                    </td>
                </tr>
            </table>
            </form>
        </td>
    </tr>
</table>