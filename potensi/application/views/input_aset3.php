<?php
    echo !empty($h2_title) ? '<h2>' . $h2_title . '</h2>' : '';
     echo !empty($message) ? '<p>'.$message.'</p>' : '';
                    
    $flashmessage = $this->session->flashdata('message');
    echo !empty($flashmessage) ? '<p>'.$flashmessage.'</p>' : '';
?>

<form name="aset_form" action="<?php echo $form_action;?>" method="post">
    <div  align="center">
    <fieldset>
        <legend>INPUT DATA ASET</legend>
        <table width="600" cellpadding="0" cellspacing="0" border="0">
        <tr>
        <td width="150" height="25" align="right">Propinsi</td>
        <td width="20">&nbsp;</td>
        <td><select name="propinsi" onchange="ambil_kota($(this).val())" >
                <option value="">-- pilih --</option>
            <?php        
                $propinsi = $this->Propinsi_model->getPropinsi();
                    foreach($propinsi as $data){
                        if(isset($default['propinsiID'])){
                            echo '<option value="' . $data->propinsiID . '">' . $data->namaPropinsi . ' selected</option>';
                        }else{
                            echo '<option value="' . $data->propinsiID . '">' . $data->namaPropinsi . '</option>';
                        }
                    }
                    ?>
                </select>
        </td>
        </tr>
            
        <tr>
            <td height="25" align="right">Kota</td>
            <td width="20">&nbsp;</td>
        <td><span class="kota"></span></td>
        </tr>
        <tr>
            <td height="25" align="right">Kecamatan</td>
            <td width="20">&nbsp;</td>
        <td><span class="kecamatan"></span></td>
        </tr>
        <tr>
            <td height="25" align="right">Kelurahan</td>
            <td width="20">&nbsp;</td>
        <td><span class="kelurahan"></span></td>
        </tr>
        <tr>
            <td height="25" align="right">No. Aset</td>
            <td width="20">&nbsp;</td>
            <td><span class="noaset"></span></td>
        </tr>
        <tr>
            <td height="25" align="right">Jenis Aset</td>
            <td width="20">&nbsp;</td>
            <td><select name="jenis_aset">
                    <option values="">-- pilih --</option>
                    <?php    
                    $jenis = $this->Jenis_model->getJenisAset();
                        foreach($jenis as $data){
                            echo '<option value="' . $data->kode_klasifikasi . '">' . $data->jenis . '</option>';
                        }
                    ?>
                </select>
            </td>
        </tr>
        <tr>
            <td height="25" align="right">Nama Aset</td>
            <td width="20">&nbsp;</td>
        <td><input type="text" name="nama_aset" size="40" value="" /></td>
        </tr>
        <tr>
            <td height="25" align="right">Alamat / Lokasi Aset</td>
            <td width="20">&nbsp;</td>
        <td><input type="text" name="lokasi" size="40" value="" /><td>
        </tr>
        <tr>
            <td height="25" align="right">Pendiri</td>
            <td width="20">&nbsp;</td>
            <td><input type="text" name="pendiri" size="40" value="" /></td>
        </tr>
        <tr>
            <td height="25" align="right">Tahun Berdiri</td>
            <td width="20">&nbsp;</td>
        <td><input type="text" name="th_berdiri" size="20" value="" /></td>
        </tr>
        <tr>
            <td height="25" align="right">Luas Tanah</td>
            <td width="20">&nbsp;</td>
        <td><input type="text" name="luas_tanah" size="20" value="" /></td>
        </tr>
        <tr>
            <td height="25" align="right">Luas Bangunan</td>
            <td width="20">&nbsp;</td>
            <td><input type="text" name="luas_bangunan" size="20" value="" /></td>
        </tr>
        <tr>
            <td height="25" align="right">Status Tanah</td>
            <td width="20">&nbsp;</td>
            <td>
            <select name='status_tanah'>
                    <option value="">-- pilih --</option>
                        <?php
                        $status = $this->Status_model->getStatusTanah();
                        foreach($status as $data){
                            echo '<option value="' . $data->id . '">' . $data->status_tanah. '</option>';
                        }
                        ?>
                </select>
            </td>
        </tr>
        <tr>
            <td height="25" align="right">Bukti Kepemilikan</td>
            <td width="20">&nbsp;</td>
            <td>
            <select name='bukti_milik'>
                    <option value="">-- pilih --</option>
                        <?php
                        $bukti = $this->Bukti_model->getBuktiMilik();
                        foreach($bukti as $data){
                            echo '<option value="' . $data->id . '">' . $data->bukti_milik . '</option>';
                        }
                        ?>
                </select>
            </td>
        </tr>
        <tr>
            <td height="25" align="right">Lembaga Pengelola</td>
            <td width="20">&nbsp;</td>
            <td>
            <select name='pengelola'>
                    <option value="">-- pilih --</option>
                        <?php
                        $pengelola = $this->Pengelola_model->getPengelola();
                        foreach($pengelola as $data){
                            echo '<option value="' . $data->id . '">' . $data->pengelola . '</option>';
                        }
                        ?>
                </select>
            </td>
        </tr>
        <tr>
            <td height="25" align="right">Penanggung Jawab</td>
            <td width="20">&nbsp;</td>
            <td><input type="text" name="penanggung_jawab" size="40" value="" />
            </td>
        </tr>
        <tr>
            <td height="25" align="right">Telp</td>
            <td width="20">&nbsp;</td>
            <td><input type="text" name="telp" size="20" value="" />
            </td>
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