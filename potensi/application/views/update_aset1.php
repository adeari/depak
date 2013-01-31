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
                <td width="180" valign="top">
                    <table width="100%" cellpadding="0" cellspacing="0" border="0">
                        <tr>
                            <td >Propinsi<br />
                                <input type="text" name="propinsi" readonly="readonly" 
                value="<?php        
                $propID = substr($default['id'], 0, 2);
                $propinsi = $this->Propinsi_model->getProp($propID);
                echo $propinsi->namaPropinsi;?>" />
                            </td>
                        </tr>
                        <tr><td>Kota <br />
                            <input type="text" name="kota" readonly="readonly" 
                value="<?php        
                $kotaID = substr($default['id'], 0, 4);
                $kota = $this->Kota_model->getKotaByID($kotaID);
                echo $kota->namaKota;
                    ?>" />
                            </td>
                        </tr>
                        <tr>
                            <td>Kecamatan <br />
                            <input type="text" name="kecamatan" readonly="readonly" 
                value="<?php        
                $kecamatanID = substr($default['id'], 0, 6);
                $kecamatan = $this->Kecamatan_model->getKecamatanByID($kecamatanID);
                echo $kecamatan->namaKecamatan;
                    ?>" />
                            </td>
                        </tr>
                        <tr>
                            <td>Kelurahan <br />
                            <input type="text" name="kelurahan" readonly="readonly" 
                value="<?php 
                $kelID = substr($default['id'], 0, 10);
                $kelurahan = $this->Kelurahan_model->getKelurahanByID($kelID);
                echo $kelurahan->namaKelurahan;
                    ?>" />
                        </tr>
                        <tr>
                            <td>
                                Ketua Ranting NU <br />
                                <input type="text" name="kprnu" size="30" 
                                       value="<?php echo set_value('kprnu',  isset($default['kprnu']) ? $default['kprnu'] : '');?>" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Tanggal Survey (tgl/bln/tahun)</label>
                                <input name="tgl_survey" id="tgl_lahir" type="text" size="12"
                                       maxlength="10" 
                                       value="<?php echo set_value('tgl_survey',  isset($default['tgl_survey']) ? $default['tgl_survey'] : '');?>" 
                                       onFocus="this.setStyle({ background: 'yellow' });MaskedTextBox_NS_FocusMask(event, this.id, '99/99/9999');"
                                       onkeyup="date_entry_new(this,event);" onBlur="this.setStyle({ background: 'white' });"
                                       onkeypress="return date_input(this.id,this.name,event);"
                                       onChange="date_validation(this);"  />
                                
                            </td>
                        </tr>
                    </table>
                </td>
            
                <td width="420" valign="top">
                    <table width="100%" cellpadding="0" cellspacing="0" border="0">
                        <tr>
            <td height="25" align="right">No. Aset</td>
            <td width="20">&nbsp;</td>
            <td><?php
            if(!isset($default['id'])){
                echo '<span class="noaset"></span></td>';
            }else{
                echo '<input type="text" name="kelurahan" readonly="readonly" value="'. $default['id'] . '" />';
            }
            ?>
            
                <span class="noaset"></span></td>
        </tr>
        <tr>
            <td height="25" align="right">Jenis Aset</td>
            <td width="20">&nbsp;</td>
            <td><?php
                
                
                    echo '<select name="jenis_aset">';
                    echo '<option values="">-- pilih --</option>';
                        
                    $jenis = $this->Jenis_model->getJenisAset();
                        foreach($jenis as $data){
                            if($data->kode_klasifikasi == $default['jenis_aset']){
                                echo '<option value="' . $data->kode_klasifikasi . '" selected>' . $data->jenis . '</option>';
                            }else{
                                echo '<option value="' . $data->kode_klasifikasi . '">' . $data->jenis . '</option>';
                            }
                        }
                        ?>
                </select>
            </td>
        </tr>
        <tr>
            <td height="25" align="right">Nama Aset</td>
            <td width="20">&nbsp;</td>
        <td><input type="text" name="nama_aset" size="40" 
                   value="<?php echo set_value('nama_aset',  isset($default['nama_aset']) ? $default['nama_aset'] : '');?>" /></td>
        </tr>
        <tr>
            <td height="25" align="right">Alamat / Lokasi Aset</td>
            <td width="20">&nbsp;</td>
        <td><input type="text" name="lokasi" size="40" 
                   value="<?php echo set_value('lokasi',  isset($default['lokasi']) ? $default['lokasi'] : '');?>" /></td>
        </tr>
        <tr>
            <td height="25" align="right">Pendiri</td>
            <td width="20">&nbsp;</td>
            <td><input type="text" name="pendiri" size="40" 
                       value="<?php echo set_value('pendiri',  isset($default['pendiri']) ? $default['pendiri'] : '');?>" /></td>
        </tr>
        <tr>
            <td height="25" align="right">Tahun Berdiri</td>
            <td width="20">&nbsp;</td>
        <td><input type="text" name="th_berdiri" size="20" 
                   value="<?php echo set_value('th_berdiri',  isset($default['th_berdiri']) ? $default['th_berdiri'] : '');?>" /></td>
        </tr>
        <tr>
            <td height="25" align="right">Luas Tanah</td>
            <td width="20">&nbsp;</td>
        <td><input type="text" name="luas_tanah" size="20" 
                   value="<?php echo set_value('luas_tanah',  isset($default['luas_tanah']) ? $default['luas_tanah'] : '');?>" /></td>
        </tr>
        <tr>
            <td height="25" align="right">Luas Bangunan</td>
            <td width="20">&nbsp;</td>
            <td><input type="text" name="luas_bangunan" size="20" 
                       value="<?php echo set_value('luas_bangunan',  isset($default['luas_bangunan']) ? $default['luas_bangunan'] : '');?>" /></td>
        </tr>
        <tr>
            <td height="25" align="right">Status Tanah</td>
            <td width="20">&nbsp;</td>
            <td><?php
                
                
                    echo '<select name="status_tanah">';
                    echo '<option values="">-- pilih --</option>';
                        
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
            </td>
        </tr>
        <tr>
            <td height="25" align="right">Bukti Kepemilikan</td>
            <td width="20">&nbsp;</td>
            <td><?php
                
                
                    echo '<select name="bukti_milik">';
                    echo '<option values="">-- pilih --</option>';
                        
                    $jenis = $this->Bukti_model->getBuktiMilik();
                        foreach($jenis as $data){
                            if($data->id == $default['bukti_milik']){
                                echo '<option value="' . $data->id . '" selected>' . $data->bukti_milik . '</option>';
                            }else{
                                echo '<option value="' . $data->id . '">' . $data->bukti_milik . '</option>';
                            }
                        }
                        ?>
                </select>
            </td>
        </tr>
        <tr>
            <td height="25" align="right">Lembaga Pengelola</td>
            <td width="20">&nbsp;</td>
            <td><?php
                
                
                    echo '<select name="pengelola">';
                    echo '<option values="">-- pilih --</option>';
                        
                    $jenis = $this->Pengelola_model->getPengelola();
                        foreach($jenis as $data){
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
            <td><input type="text" name="penanggung_jawab" size="40" 
                       value="<?php echo set_value('penanggung_jawab',  isset($default['penanggung_jawab']) ? $default['penanggung_jawab'] : '');?>" /></td>
            </td>
        </tr>
        <tr>
            <td height="25" align="right">Telp</td>
            <td width="20">&nbsp;</td>
            <td><input type="text" name="telp" size="20" 
                       value="<?php echo set_value('telp',  isset($default['telp']) ? $default['telp'] : '');?>" /></td>
            </td>
        </tr>
        <tr>
                            <td height="25" align="right">Keterangan</td>
                            <td width="20">&nbsp;</td>
                            <td><input type="text" name="keterangan" size="40" 
                                       value="<?php echo set_value('keterangan',  isset($default['keterangan']) ? $default['keterangan'] : '');?>" />
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