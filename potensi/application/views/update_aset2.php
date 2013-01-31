<?php
    echo !empty($h2_title) ? '<h2>' . $h2_title . '</h2>' : '';
     echo !empty($message) ? '<p>'.$message.'</p>' : '';
                    
    $flashmessage = $this->session->flashdata('message');
    echo !empty($flashmessage) ? '<p>'.$flashmessage.'</p>' : '';
?>

<form name="aset_form" action="<?php echo $form_action;?>" method="post">
    <div  align="center">
    <fieldset>
        <legend>UPDATE DATA ASET</legend>
        <table width="600" cellpadding="0" cellspacing="0" border="0">
        <tr>
        <td width="150" height="25" align="right">Propinsi</td>
        <td width="20">&nbsp;</td>
        <td><input type="text" name="propinsi" readonly="readonly" 
                value="<?php        
                $propID = substr($kelID, 0, 2);
                $propinsi = $this->Propinsi_model->getProp($propID);
                echo $propinsi->namaPropinsi;?>" />
        </td>
        </tr>
            
        <tr>
            <td height="25" align="right">Kota</td>
            <td width="20">&nbsp;</td>
        <td><input type="text" name="kota" readonly="readonly" 
                value="<?php        
                $kotaID = substr($kelID, 0, 4);
                $kota = $this->Kota_model->getKotaByID($kotaID);
                echo $kota->namaKota;
                    ?>" />
        </tr>
        <tr>
            <td height="25" align="right">Kecamatan</td>
            <td width="20">&nbsp;</td>
        <td><input type="text" name="kecamatan" readonly="readonly" 
                value="<?php        
                $kecamatanID = substr($kelID, 0, 6);
                $kecamatan = $this->Kecamatan_model->getKecamatanByID($kecamatanID);
                echo $kecamatan->namaKecamatan;
                    ?>" />
        </tr>
        <tr>
            <td height="25" align="right">Kelurahan</td>
            <td width="20">&nbsp;</td>
        <td><input type="text" name="kelurahan" readonly="readonly" 
                value="<?php        
                $kelurahan = $this->Kelurahan_model->getKelurahanByID($kelID);
                echo $kelurahan->namaKelurahan;
                    ?>" />
        </tr>
        <tr>
            <td height="25" align="right">No. Aset</td>
            <td width="20">&nbsp;</td>
            <td><input type="text" name="id" readonly="readonly" 
                value="<?php echo set_value('id',  isset($default['id']) ? $default['id'] : '');?>" /></td>
        </tr>
        <tr>
            <td height="25" align="right">Jenis Aset</td>
            <td width="20">&nbsp;</td>
            <td><input type="text" name="jenis_aset" value="" size="3" 
                       value="<?php echo set_value('jenis_aset',  isset($default['jenis_aset']) ? $default['jenis_aset'] : '');?>"
                       onChange="getJenis($(this).val())" />
                <span class="jenis"></span>
            </td>
        </tr>
        <tr>
            <td height="25" align="right">Nama Aset</td>
            <td width="20">&nbsp;</td>
        <td><input type="text" name="nama_aset" size="40" 
                   value="<?php echo set_value('nama_aset',  isset($default['nama_aset']) ? $default['nama_aset'] : '');?>"/>
        </td>
        </tr>
        <tr>
            <td height="25" align="right">Alamat / Lokasi Aset</td>
            <td width="20">&nbsp;</td>
        <td><input type="text" name="lokasi" size="40" 
                   value="<?php echo set_value('lokasi',  isset($default['lokasi']) ? $default['lokasi'] : '');?>" />
        <td>
        </tr>
        <tr>
            <td height="25" align="right">Pendiri</td>
            <td width="20">&nbsp;</td>
            <td><input type="text" name="pendiri" size="40" 
                       value="<?php echo set_value('pendiri',  isset($default['pendiri']) ? $default['pendiri'] : '');?>" />
            </td>
        </tr>
        <tr>
            <td height="25" align="right">Tahun Berdiri</td>
            <td width="20">&nbsp;</td>
        <td><input type="text" name="th_berdiri" size="20" 
                   value="<?php echo set_value('th_berdiri',  isset($default['th_berdiri']) ? $default['th_berdiri'] : '');?>" />
        </td>
        </tr>
        <tr>
            <td height="25" align="right">Luas Tanah</td>
            <td width="20">&nbsp;</td>
        <td><input type="text" name="luas_tanah" size="20" 
                   value="<?php echo set_value('luas_tanah',  isset($default['luas_tanah']) ? $default['luas_tanah'] : '');?>" />
        </td>
        </tr>
        <tr>
            <td height="25" align="right">Luas Bangunan</td>
            <td width="20">&nbsp;</td>
            <td><input type="text" name="luas_bangunan" size="20" 
                       value="<?php echo set_value('luas_bangunan',  isset($default['luas_bangunan']) ? $default['luas_bangunan'] : '');?>" />
            </td>
        </tr>
        <tr>
            <td height="25" align="right">Status Tanah</td>
            <td width="20">&nbsp;</td>
            <td><select name='status_tanah' onchange="getStatus($(this).val())">
                                    <option value="">-- pilih --</option>
                                        <?php
                                            $status = $this->Status_model->getStatusTanah();
                        foreach($status as $data){
                            if($data->id == $default['status_tanah']){
                                echo '<option value="' . $data->id . '" selected>' . $data->status_tanah . '</option>';
                            }else{
                                echo '<option value="' . $data->id . '">' . $data->status_tanah . '</option>';
                            }
                        }
                        ?>
                                </select>
                                <span class="status"></span>
            </td>
        </tr>
        <tr>
            <td height="25" align="right">Bukti Kepemilikan</td>
            <td width="20">&nbsp;</td>
            <td><select name='bukti_milik' onchange="getBukti($(this).val())">
                                    <option value="">-- pilih --</option>
                                        <?php
                                            $bukti = $this->Bukti_model->getBuktiMilik();
                                            foreach($bukti as $data){
                                                if($data->id == $default['bukti_milik']){
                                echo '<option value="' . $data->id . '" selected>' . $data->bukti_milik . '</option>';
                            }else{
                                echo '<option value="' . $data->id . '">' . $data->bukti_milik . '</option>';
                            }
                                            }
                                        ?>
                                </select><span class="bukti"></span>
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
                            if($data->id == $default['pengelola']){
                                echo '<option value="' . $data->id . '" selected>' . $data->pengelola . '</option>';
                            }else{
                                echo '<option value="' . $data->id . '">' . $data->pengelola . '</option>';
                            }
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