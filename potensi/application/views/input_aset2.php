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
                $propID = substr($kelID, 0, 2);
                $propinsi = $this->Propinsi_model->getProp($propID);
                echo $propinsi->namaPropinsi;?>" />
                            </td>
                        </tr>
                        <tr><td>Kota <br />
                            <input type="text" name="kota" readonly="readonly" 
                value="<?php        
                $kotaID = substr($kelID, 0, 4);
                $kota = $this->Kota_model->getKotaByID($kotaID);
                echo $kota->namaKota;
                    ?>" />
                            </td>
                        </tr>
                        <tr>
                            <td>Kecamatan <br />
                            <input type="text" name="kecamatan" readonly="readonly" 
                value="<?php        
                $kecamatanID = substr($kelID, 0, 6);
                $kecamatan = $this->Kecamatan_model->getKecamatanByID($kecamatanID);
                echo $kecamatan->namaKecamatan;
                    ?>" />
                            </td>
                        </tr>
                        <tr>
                            <td>Kelurahan <br />
                            <input type="text" name="kelurahan" readonly="readonly" 
                value="<?php        
                $kelurahan = $this->Kelurahan_model->getKelurahanByID($kelID);
                echo $kelurahan->namaKelurahan;
                    ?>" />
                        </tr>
                        <tr>
                            <td>
                                Ketua Ranting NU <br />
                                <input type="text" name="kprnu" size="30" value="<?php echo set_value('kprnu',  isset($default['kprnu']) ? $default['kprnu'] : '');?>" />
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
                            <td><input type="text" name="id" readonly="readonly" 
                value="<?php 
                    $th = date('Y');
                    echo $kelID . "." . $th . "." . $this->Aset_model->getNewAsetID($kelID);?>" /></td>
                        </tr>
                        <tr>
                            <td height="25" align="right">Jenis Aset</td>
                            <td width="20">&nbsp;</td>
                            <td><input type="text" name="jenis_aset" value="" size="3" onChange="getJenis($(this).val())" />
                                <span class="jenis"></span></td>
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
                            <td><input type="text" name="luas_tanah" size="10" value="" /> M&sup2;</td>
                        </tr>
                        <tr>
                            <td height="25" align="right">Luas Bangunan</td>
                            <td width="20">&nbsp;</td>
                            <td><input type="text" name="luas_bangunan" size="10" value="" /> M&sup2;</td>
                        </tr>
                        <tr>
                            <td height="25" align="right">Status Tanah</td>
                            <td width="20">&nbsp;</td>
                            <td>
                                <select name='status_tanah' onchange="getStatus($(this).val())">
                                    <option value="">-- pilih --</option>
                                        <?php
                                            $status = $this->Status_model->getStatusTanah();
                                            foreach($status as $data){
                                                echo '<option value="' . $data->id . '">' . $data->status_tanah. '</option>';
                                            }
                                        ?>
                                </select>
                                <span class="status"></span>
                            </td>
                        </tr>
                        <tr>
                            <td height="25" align="right">Bukti Kepemilikan</td>
                            <td width="20">&nbsp;</td>
                            <td>
                                <select name='bukti_milik' onchange="getBukti($(this).val())">
                                    <option value="">-- pilih --</option>
                                        <?php
                                            $bukti = $this->Bukti_model->getBuktiMilik();
                                            foreach($bukti as $data){
                                                echo '<option value="' . $data->id . '">' . $data->bukti_milik . '</option>';
                                            }
                                        ?>
                                </select><span class="bukti"></span>
                            </td>
                        </tr>
                        <tr>
                            <td height="25" align="right">Lembaga Pengelola</td>
                            <td width="20">&nbsp;</td>
                            <td>
                                <select name='pengelola' onchange="getPengelola($(this).val())">
                                    <option value="">-- pilih --</option>
                                        <?php
                                            $pengelola = $this->Pengelola_model->getPengelola();
                                            foreach($pengelola as $data){
                                                echo '<option value="' . $data->id . '">' . $data->pengelola . '</option>';
                                            }
                                        ?>
                                </select><span class="pengelola"></span>
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
                            <td height="25" align="right">Keterangan</td>
                            <td width="20">&nbsp;</td>
                            <td><input type="text" name="telp" size="40" value="" />
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