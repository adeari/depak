<?php
    $aset = $this->Aset_model->getAsetByID($id);
    if($this->session->userdata('level')=='Entry' || $this->session->userdata('level')=='Supervisor' || $this->session->userdata('level')=='Administrator'){
        $cetak = '<table width="600" cellpadding="0" cellspacing="0" border="0" align="center">
                <tr><td><div align="right">';

        $cetak .= anchor('aset/update/'.$id,'Update') .'&nbsp;'. 
             anchor('aset/delete/'.$id,'hapus',array('onclick'=>"return confirm('Data akan dihapus?')")) ;
        $cetak .= '&nbsp;
            </div></td></tr></table>';
    }else{
        $cetak = '<table width="600" cellpadding="0" cellspacing="0" border="0" align="center">
                <tr><td>&nbsp;</td></tr></table>';
    }
    
?>

<h2><font color="#487a26">DETIL DATA ASET</font></h2>
<table width="600" cellpadding="0" cellspacing="0" border="1" align="center" bgcolor="#ffffff">
    <tr>
        <td>
            <table width="600" cellpadding="0" cellspacing="0" border="0">
                <tr class="zebra">
                    <td colspan="3">
                        <?php echo $cetak;?>
                    </td>
                </tr>
                <tr>
                    <td width="150">ID</td>
                    <td width="25">:</td>
                    <td><input type="hidden" name="id" id="id" value="<?php echo $aset->id;?>" /><?php echo $aset->id;?></td>
                </tr>
                <tr class="zebra">
                    <td width="150">Nama Aset</td>
                    <td width="25">:</td>
                    <td><?php echo $aset->nama_aset;?></td>
                </tr>
                <tr>
                    <td width="150">Jenis</td>
                    <td width="25">:</td>
                    <td><?php echo $aset->ket_jenis;?></td>
                </tr>
                <tr class="zebra">
                    <td width="150">Lokasi</td>
                    <td width="25">:</td>
                    <td><?php echo $aset->lokasi;?></td>
                </tr>
                <tr>
                    <td width="150">Pendiri</td>
                    <td width="25">:</td>
                    <td><?php echo $aset->pendiri;?></td>
                </tr>
                <tr class="zebra">
                    <td width="150">Th. Berdiri</td>
                    <td width="25">:</td>
                    <td><?php echo $aset->th_berdiri;?></td>
                </tr>
                <tr>
                    <td width="150">Luas Tanah</td>
                    <td width="25">:</td>
                    <td><?php echo $aset->luas_tanah;?> M&sup2;</td>
                </tr>
                <tr class="zebra">
                    <td width="150">Luas Bangunan</td>
                    <td width="25">:</td>
                    <td><?php echo $aset->luas_bangunan;?> M&sup2;</td>
                </tr>
                <tr>
                    <td width="150">Status Tanah</td>
                    <td width="25">:</td>
                    <td><?php echo $aset->ket_status;?></td>
                </tr>
                <tr class="zebra">
                    <td width="150">Bukti Milik</td>
                    <td width="25">:</td>
                    <td><?php echo $aset->ket_bukti;?></td>
                </tr>
                <tr>
                    <td width="150">Pengelola</td>
                    <td width="25">:</td>
                    <td><?php echo $aset->ket_pengelola;?></td>
                </tr>
                <tr class="zebra">
                    <td width="150">Penanggung Jawab</td>
                    <td width="25">:</td>
                    <td><?php echo $aset->penanggung_jawab;?></td>
                </tr>
                <tr>
                    <td width="150">Telp</td>
                    <td width="25">:</td>
                    <td><?php echo $aset->telp;?></td>
                </tr>
                <tr class="zebra">
                    <td width="150">Keterangan</td>
                    <td width="25">:</td>
                    <td><?php
                            if(!$aset->keterangan=='0'){
                                echo $aset->keterangan;}?>
                    </td>
                </tr>
                <tr>
                    <td colspan="3"><div align="right">
                        <?php
                            if($this->session->userdata('login')==TRUE && $this->session->userdata('level')!='User' ){
                                echo '<form name="detilform"><input type="checkbox" name="detil" value="Detil" onChange="get_check_value()" />Detil</form>';
                            }
                        ?>
                        </div></td>
                </tr>
            </table>
        </td>
    </tr>
</table>



<span class="detail"></span>