<fieldset>
<?php
    echo !empty($h2_title) ? '<h2>' . $h2_title . '</h2>' : '';
     echo !empty($message) ? '<p>'.$message.'</p>' : '';
                    
    $flashmessage = $this->session->flashdata('message');
    echo !empty($flashmessage) ? '<p>'.$flashmessage.'</p>' : '';

    $this->load->view('category');
    
    $last = $this->Aset_model->getLastAset();
    $id = $last->id;
    $kprnu = $last->kprnu;
    $ranting = $last->ranting;
    $petugas = $last->petugas;
    $tgl_survey = $last->tgl_survey;
?>
</fieldset>

<form name="aset_form" action="<?php echo $form_action;?>" method="post" onSubmit="return validasiForm()">
    <div  align="center">
    <fieldset>
        <legend>INPUT DATA ASET</legend>
        <table width="600" cellpadding="0" cellspacing="0" border="0">
            <tr>
                <td width="180" valign="top">
                    <table width="100%" cellpadding="0" cellspacing="0" border="1">
                        <tr>
                            <td>
                                <table width="100%" cellpadding="0" cellspacing="0" border="0">
                                    <tr>
                                        <td ><span class="propinsi"></span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><span class="kota"></span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><span class="kecamatan"></span></td>
                                    </tr>
                                    <tr>
                                        <td><span class="kelurahan"></span></td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <table width="100%" cellpadding="0" cellspacing="0" border="0">
                                    <tr>
                                        <td>Ranting NU <br />
                                            <input type="text" name="ranting" size="30" 
                                                   value="<?php echo $ranting;?>" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Ketua Ranting NU <br />
                                            <input type="text" name="kprnu" size="30" value="<?php echo $kprnu;?>" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label>Tanggal Survey (tgl/bln/tahun)</label><br />
                                            <input name="tgl_survey" id="tgl_survey" type="text" size="12"
                                                   maxlength="10"
                                                   onFocus="this.setStyle({ background: 'yellow' });MaskedTextBox_NS_FocusMask(event, this.id, '99/99/9999');"
                                                   onkeyup="date_entry_new(this,event);" onBlur="this.setStyle({ background: 'white' });"
                                                   onkeypress="return date_input(this.id,this.name,event);"
                                                   onChange="date_validation(this);"
                                                   value="<?php $tgl = substr($tgl_survey,8,2) . "/" . 
                                                                   substr($tgl_survey,5,2) . "/" .
                                                                   substr($tgl_survey,0,4);
                                                       echo $tgl;?>"/>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Petugas Survey<br />
                                            <input type="text" name="petugas" size="30" value="<?php echo $petugas;?>"/>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </td>
            
                <td width="420" valign="top">
                    <table width="100%" cellpadding="0" cellspacing="0" border="1">
                        <tr>
                            <td>
                                <table width="100%" cellpadding="0" cellspacing="0" border="0">
                                    <tr>
                                        <td height="25" align="right">No. Aset</td>
                                        <td width="20">&nbsp;</td>
                                        <td><span class="noaset"></span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td height="25" align="right">Jenis Aset</td>
                                        <td width="20">&nbsp;</td>
                                        <td><input type="text" name="jenis_aset" id="jenis" value="" size="3" onChange="getJenis($(this).val())" />
                                            <span class="jenis"></span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td height="25" align="right">Nama Aset</td>
                                        <td width="20">&nbsp;</td>
                                        <td><input type="text" name="nama_aset" size="40" value="" onChange="isExist($(this).val())" />
                                        <span class="exist"></span></td>
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
                                        <td><input type="text" name="th_berdiri" size="10" value="" /></td>
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
                                        <td><select name='status_tanah' onchange="getStatus($(this).val())" style="width:150px">
                                                <option value="">-- pilih --</option>
                                                    <?php
                                                        $status = $this->Status_model->getStatusTanah();
                                                        foreach($status as $data){
                                                            echo '<option value="' . $data->id . '">' . $data->status_tanah. '</option>';
                                                        }
                                                    ?>
                                            </select><span class="status"></span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td height="25" align="right">Bukti Kepemilikan</td>
                                        <td width="20">&nbsp;</td>
                                        <td><select name='bukti_milik' onchange="getBukti($(this).val())" style="width:150px">
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
                                        <td><select name='pengelola' onchange="getPengelola($(this).val())" style="width:150px">
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
                                        <td><input type="text" name="penanggung_jawab" size="40" value="" /></td>
                                    </tr>
                                    <tr>
                                        <td height="25" align="right">Telp</td>
                                        <td width="20">&nbsp;</td>
                                        <td><input type="text" name="telp" size="20" value="" /></td>
                                    </tr>
                                    <tr>
                                        <td height="25" align="right">Keterangan</td>
                                        <td width="20">&nbsp;</td>
                                        <td><textarea cols="32" rows="5" name="keterangan"></textarea>
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