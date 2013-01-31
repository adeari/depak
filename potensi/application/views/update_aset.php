<fieldset>
<?php
    echo !empty($h2_title) ? '<h2>' . $h2_title . '</h2>' : '';
     echo !empty($message) ? '<p>'.$message.'</p>' : '';
                    
    $flashmessage = $this->session->flashdata('message');
    echo !empty($flashmessage) ? '<p>'.$flashmessage.'</p>' : '';

    $this->load->view('category');
?>
    </fieldset>

<form name="aset_form" action="<?php echo $form_action;?>" method="post" onSubmit="return validasiForm()">
    <div  align="center">
    <fieldset>
        <legend>UPDATE DATA ASET</legend>
        <table width="600" cellpadding="0" cellspacing="0" border="0">
            <tr>
                <td width="180" valign="top">
                    <table width="100%" cellpadding="0" cellspacing="0" border="1">
                        <tr>
                            <td>
                                <table width="100%" cellpadding="0" cellspacing="0" border="0">
                                    <tr>
                                        <td >Propinsi<br />
                                            <input type="text" name="propinsi" readonly="readonly" 
                                                    value="<?php
                                                        $kelID = $default['id'];
                                                        $kelID = substr($kelID, 0,10);
                                                        $propID = substr($kelID, 0, 2);
                                                        $propinsi = $this->Propinsi_model->getProp($propID);
                                                        echo $propinsi->namaPropinsi;?>" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Kota <br />
                                            <input type="text" name="kota" readonly="readonly" 
                                                    value="<?php        
                                                        $kotaID = substr($kelID, 0, 4);
                                                        $kota = $this->Kota_model->getKotaByID($kotaID);
                                                        echo $kota->namaKota;?>" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Kecamatan <br />
                                            <input type="text" name="kecamatan" readonly="readonly" 
                                                    value="<?php        
                                                        $kecamatanID = substr($kelID, 0, 6);
                                                        $kecamatan = $this->Kecamatan_model->getKecamatanByID($kecamatanID);
                                                        echo $kecamatan->namaKecamatan;?>" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Kelurahan <br />
                                            <input type="text" name="kelurahan" readonly="readonly" 
                                                    value="<?php        
                                                        $kelurahan = $this->Kelurahan_model->getKelurahanByID($kelID);
                                                        echo $kelurahan->namaKelurahan;
                                                        ?>" />
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <table width="100%" cellpadding="0" cellspacing="0" border="0">
                                    <tr>
                                        <td>Ranting NU <br />
                                            <input type="text" name="ranting" size="30" value="<?php echo set_value('ranting',  isset($default['ranting']) ? $default['ranting'] : '');?>" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Ketua Ranting NU <br />
                                            <input type="text" name="kprnu" size="30" value="<?php echo set_value('kprnu',  isset($default['kprnu']) ? $default['kprnu'] : '');?>" />
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
                                                   value="<?php echo set_value('tgl_survey',  isset($default['tgl_survey']) ? $default['tgl_survey'] : '');?>"/>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Petugas Survey<br />
                                            <input type="text" name="petugas" size="30" value="<?php echo set_value('petugas',  isset($default['petugas']) ? $default['petugas'] : '');?>"/>
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
                                        <td><input type="text" name="id" readonly="readonly" value="<?php 
                                            echo set_value('id',  isset($default['id']) ? $default['id'] : '');?>" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td height="25" align="right">Jenis Aset</td>
                                        <td width="20">&nbsp;</td>
                                        <td><input type="text" name="jenis_aset" value="<?php
                                            echo set_value('jenis_aset',  isset($default['jenis_aset']) ? $default['jenis_aset'] : '');
                                        ?>" size="3" onChange="getJenis($(this).val())" />
                                            <span class="jenis">
                                            <input type="text" name="golongan" value="<?php
                                            $gol = substr($default['jenis_aset'], 0, 1);
                                            $golongan = $this->Golongan_model->getGolonganByID($gol);
                                            echo set_value('golongan',  isset($default['jenis_aset']) ? $golongan->golongan : '');
                                        ?>" size="15" />
                                            <input type="text" name="ket_jenis" value="<?php
                                            $jenis = $this->Jenis_model->getJenis($default['jenis_aset'])->row();
                                            echo set_value('golongan',  isset($default['jenis_aset']) ? $jenis->jenis : '');
                                        ?>" size="40" /></span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td height="25" align="right">Nama Aset</td>
                                        <td width="20">&nbsp;</td>
                                        <td><input type="text" name="nama_aset" size="40" value="<?php 
                                            echo set_value('nama_aset',  isset($default['nama_aset']) ? $default['nama_aset'] : '');?>" /></td>
                                    </tr>
                                    <tr>
                                        <td height="25" align="right">Alamat / Lokasi Aset</td>
                                        <td width="20">&nbsp;</td>
                                        <td><input type="text" name="lokasi" size="40" value="<?php 
                                        echo set_value('lokasi',  isset($default['lokasi']) ? $default['lokasi'] : '');?>" /><td>
                                    </tr>
                                    <tr>
                                        <td height="25" align="right">Pendiri</td>
                                        <td width="20">&nbsp;</td>
                                        <td><input type="text" name="pendiri" size="40" value="<?php 
                                        echo set_value('pendiri',  isset($default['pendiri']) ? $default['pendiri'] : '');?>" /></td>
                                    </tr>
                                    <tr>
                                        <td height="25" align="right">Tahun Berdiri</td>
                                        <td width="20">&nbsp;</td>
                                        <td><input type="text" name="th_berdiri" size="20" value="<?php 
                                        echo set_value('th_berdiri',  isset($default['th_berdiri']) ? $default['th_berdiri'] : '');?>" /></td>
                                    </tr>
                                    <tr>
                                        <td height="25" align="right">Luas Tanah</td>
                                        <td width="20">&nbsp;</td>
                                        <td><input type="text" name="luas_tanah" size="10" value="<?php 
                                        echo set_value('luas_tanah',  isset($default['luas_tanah']) ? $default['luas_tanah'] : '');?>" /> M&sup2;</td>
                                    </tr>
                                    <tr>
                                        <td height="25" align="right">Luas Bangunan</td>
                                        <td width="20">&nbsp;</td>
                                        <td><input type="text" name="luas_bangunan" size="10" value="<?php 
                                        echo set_value('luas_bangunan',  isset($default['luas_bangunan']) ? $default['luas_bangunan'] : '');?>" /> M&sup2;</td>
                                    </tr>
                                    <tr>
                                        <td height="25" align="right">Status Tanah</td>
                                        <td width="20">&nbsp;</td>
                                        <td><?php
                                                $id = $this->uri->segment(3);
                                                $aset = $this->Aset_model->getAsetByID($id); 
                                                
                                                ?>
                                            <select name='status_tanah' onchange="getStatus($(this).val())" style="width:150px">
                                                <option values="">-- pilih --</option>
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
                                            </select><span class="status">
                                            <?php
                                            $status = $this->Status_model->getStatusTanahByID($aset->status_tanah)->row();
                                            if($status->status_tanah=='Lainnya'){
                                                echo '<input type="text" name="ket_status" value="' . $aset->ket_status . '" size="10"/>';
                                                
                                                }
                                                    ?></span>
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
                                                            if($data->id == $default['bukti_milik']){
                                                                echo '<option value="' . $data->id . '" selected>' . $data->bukti_milik . '</option>';
                                                            }else{
                                                                echo '<option value="' . $data->id . '">' . $data->bukti_milik . '</option>';
                                                            }
                                                        }
                                                    ?>
                                            </select><span class="bukti">
                                                <?php
                                                    $bukti = $this->Bukti_model->getBuktiMilikByID($aset->bukti_milik)->row();
                                                    if($bukti->bukti_milik=='Lainnya'){
                                                echo '<input type="text" name="ket_bukti" value="' . $aset->ket_bukti . '" size="10"/>';
                                                
                                                }
                                                ?>
                                            </span>
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
                                                            if($data->id == $default['pengelola']){
                                                                echo '<option value="' . $data->id . '" selected>' . $data->pengelola . '</option>';
                                                            }else{
                                                                echo '<option value="' . $data->id . '">' . $data->pengelola . '</option>';
                                                            }
                                                        }
                                                    ?>
                                            </select><span class="pengelola">
                                                <?php
                                                $pengelola = $this->Pengelola_model->getPengelolaByID($aset->pengelola)->row();
                                                if($pengelola->pengelola=='Lainnya'){
                                                echo '<input type="text" name="ket_pengelola" value="' . $aset->ket_pengelola . '" size="10"/>';
                                                
                                                }
                                                ?>
                                            </span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td height="25" align="right">Penanggung Jawab</td>
                                        <td width="20">&nbsp;</td>
                                        <td><input type="text" name="penanggung_jawab" size="40" value="<?php 
                                            echo set_value('penanggung_jawab',  isset($default['penanggung_jawab']) ? $default['penanggung_jawab'] : '');?>" /></td>
                                    </tr>
                                    <tr>
                                        <td height="25" align="right">Telp</td>
                                        <td width="20">&nbsp;</td>
                                        <td><input type="text" name="telp" size="20" value="<?php 
                                            echo set_value('telp',  isset($default['telp']) ? $default['telp'] : '');?>" /></td>
                                    </tr>
                                    <tr>
                                        <td height="25" align="right">Keterangan</td>
                                        <td width="20">&nbsp;</td>
                                        <td><textarea cols="32" rows="5" name="keterangan">
                                            <?php echo set_value('keterangan',  isset($default['keterangan']) ? $default['keterangan'] : '');?>
                                            </textarea>
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