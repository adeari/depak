<?php
    echo !empty($h2_title) ? '<h2>' . $h2_title . '</h2>' : '';
     echo !empty($message) ? '<p>'.$message.'</p>' : '';
                    
    $flashmessage = $this->session->flashdata('message');
    echo !empty($flashmessage) ? '<p>'.$flashmessage.'</p>' : '';
?>

<form name="aset_form" action="<?php echo $form_action;?>" method="post">
    <div>
    <fieldset>
        <legend>PENCARIAN DATA ASET</legend>
        <table width="600" cellpadding="0" cellspacing="0" border="0">
        <tr>        
        <td width="200" valign="top">
            <table width="100%" cellpadding="0" cellspacing="0" border="0">
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
            </table>
        </td>
        <td width="200" valign="top">
            <table width="100%" cellpadding="0" cellspacing="0" border="0">
            <tr>
                <td>Jenis <br />
                    <select name="jenis" style="width:150px">
                    <option value="">-- pilih --</option>
                    <?php
                    $jenis = $this->Jenis_model->getJenisAset();
                    foreach($jenis as $data){
                        $gol = $this->Golongan_model->getGolonganByID($data->golongan);
                        if (strcmp($data->kode_klasifikasi,$jenisAset)==0)
                        	echo '<option value="' . $data->kode_klasifikasi . '" selected>' .$gol->golongan . ' - ' . $data->jenis . '</option>';
                        else
                        	echo '<option value="' . $data->kode_klasifikasi . '">' .$gol->golongan . ' - ' . $data->jenis . '</option>';
                    }
                    ?>
                    </select>
                </td>
            </tr>

            <tr>
                <td>Status Tanah <br />
                <select name='status' style="width:150px">
                    <option value="">-- pilih --</option>
                        <?php
                        $status = $this->Status_model->getStatusTanah();
                        foreach($status as $data){
							if (strcmp($data->id,$statusAset)==0)
								echo '<option value="' . $data->id . '" selected>' . $data->status_tanah. '</option>';
							else
                            	echo '<option value="' . $data->id . '">' . $data->status_tanah. '</option>';
                        }?>
                </select>
                </td>
            </tr>
            <tr>
                <td>Bukti Kepemilikan<br />
                <select name='bukti' style="width:150px">
                    <option value="">-- pilih --</option>
                        <?php
                        $bukti = $this->Bukti_model->getBuktiMilik();
                        foreach($bukti as $data){
							if (strcmp($data->id,$buktiAset)==0)
								echo '<option value="' . $data->id . '" selected>' . $data->bukti_milik . '</option>';
							else
                            	echo '<option value="' . $data->id . '">' . $data->bukti_milik . '</option>';
                        }
                        ?>
                </select>
                </td>
            </tr>
            <tr>
                <td>Pengelola <br />
                <select name='pengelola' style="width:150px">
                    <option value="">-- pilih --</option>
                        <?php
                        $pengelola = $this->Pengelola_model->getPengelola();
                        foreach($pengelola as $data){
							if (strcmp($data->id,$pengelolaAset)==0)
								echo '<option value="' . $data->id . '" selected>' . $data->pengelola . '</option>';
							else
                            	echo '<option value="' . $data->id . '">' . $data->pengelola . '</option>';
                        }
                        ?>
                </select>
                </td>
            </tr>
            <td>
            <tr>
                <td align="center"><input type="submit" name="submit" value="Submit" /></td>
            </tr>
            </td>
            </table>
        </td>
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