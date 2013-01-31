<?php
$flashmessage = $this->session->flashdata('message');
    echo !empty($flashmessage) ? '<p>'.$flashmessage.'</p>' : '';?>
<table width="100%" cellpadding="0" cellspacing="0" border="0">
    <tr>
        <td><form name="formRekap" id="formRekap" method="post" action="">
                <table width="890" cellpadding="0" cellspacing="0" border="0">
                <tr>
                    <td>
                        <?php
                        $propinsi = $this->Propinsi_model->getPropinsi();
                            echo 'Propinsi<br />';
                            echo '<SELECT name="propinsi" id="propinsi" onchange="rekap_kota($(this).val())" style="width:180px">';
                            echo '<option value="">-- pilih --</option>';
                            foreach($propinsi as $row){
                                echo '<option value="' . $row->propinsiID . '">' . $row->namaPropinsi. '</option>';
                            }
                            echo '</select>';
                        ?>
                    
                    </td>
                    <td>
            <span class="rekapKota">Kota <br />
                <SELECT name="kota" onchange="rekap_kec($(this).val())" style="width:180px">
                    <option value="">-- pilih --</option>
                </select>
            </span>
                    </td>
                    <td>
            <span class="rekapKecamatan">Kecamatan <br />
                <SELECT name="kecamatan" onchange="rekap_kel($(this).val())" style="width:180px">
                    <option value="">-- pilih --</option>
                </select>
            </span>
                    </td>
                    <td>
            <span class="rekapKelurahan">Kelurahan <br />
                <SELECT name="kelurahan" onchange="getRekap($(this).val())" style="width:180px">
                    <option value="">-- pilih --</option>
                </select>
            </span><br />
                    </td>
                </tr>
                </table>
            </form>
        </td>
    </tr>
    <tr>
        <td>
                    <span class="rekap">
                        <?php
                        $cetak = '
        <table width="100%" cellpadding="0" and cellspacing="0">
            <tr>
                <td width="25%"><div align="center">
                    <a href="' ;
                    if($this->session->userdata('login')==TRUE){
                        $cetak .= base_url() . 'index.php/aset/cat/1/';
                    }else{
                        $cetak .= '#';
                    }
        $cetak .= '"><img width="160" height="160" src="' . base_url() . 'images/masjid.jpg" />
                    </a></div>
                </td>
                <td width="25"><div align="center">
                    <a href="';
                    if($this->session->userdata('login')==TRUE){
                        $cetak .= base_url() . 'index.php/aset/cat/2/';
                    }else{
                        $cetak .= '#';
                    }
        $cetak .= '"><img width="160" height="160" alt="" src="' . base_url() . 'images/pendidikan.jpg" />
                    </a></div>
                </td>
                <td width="25%"><div align="center">
                    <a href="';
                    if($this->session->userdata('login')==TRUE){
                        $cetak .= base_url() . 'index.php/aset/cat/3/';
                    }else{
                        $cetak .= '#';
                    }
        $cetak .= '"><img width="160" height="160" alt="" src="' . base_url() . 'images/sosial.jpg" />
                    </a></div>
                </td>
                <td width="25%"><div align="center">
                    <a href="';
                    if($this->session->userdata('login')==TRUE){
                        $cetak .= base_url() . 'index.php/aset/cat/4/';
                    }else{
                        $cetak .= '#';
                    }
        $cetak .= '"><img width="160" height="160" alt="" src="' . base_url() . 'images/perkantoran.jpg" />
                    </a></div>
                </td>
            </tr>
            <tr>
                <td width="25%">
                    <table width="160" cellpadding="0" cellspacing="0" align="center">
                        <tr><td bgcolor="#2F89B6"><div class="noline">
                            <a href="';
                            if($this->session->userdata('login')==TRUE){
                                $cetak .= base_url() . 'index.php/aset/cat/1/';
                            }else{
                                $cetak .= '#';
                            }
        $cetak .= '"><div class="kategori">
                            Tempat Ibadah1<br />'. $cat1 . '</div>
                            </a></div></td></tr>
                    </table>
                </td>
                <td width="25%">
                    <table width="160" cellpadding="0" cellspacing="0" align="center">
                        <tr><td bgcolor="#A04661"><div class="noline">
                            <a href="';
                            if($this->session->userdata('login')==TRUE){
                                $cetak .= base_url() . 'index.php/aset/cat/2/';
                            }else{
                                $cetak .= '#';
                            }
        $cetak .= '"><div class="kategori">
                            Pendidikan<br />' . $cat2 . '</div>
                            </a></div></td></tr>
                    </table>
                </td>
                <td width="25%" align="center">
                    <table width="160" cellpadding="0" cellspacing="0" align="center">
                        <tr><td bgcolor="#5B9121"><div class="noline">
                        <a href="';
                        if($this->session->userdata('login')==TRUE){
                            $cetak .= base_url() . 'index.php/aset/cat/3/';
                        }else{
                            $cetak .= '#';
                        }
        $cetak .= '"><div class="kategori">
                            Sosial<br />' . $cat3 . '</div>
                            </a></div></td></tr>
                    </table>
                </td>
                <td width="25%" align="center">
                    <table width="160" cellpadding="0" cellspacing="0" align="center">
                        <tr><td bgcolor="#EB9500"><div class="noline">
                        <a href="';
                        if($this->session->userdata('login')==TRUE){
                            $cetak .= base_url() . 'index.php/aset/cat/4/';
                        }else{
                            $cetak .= '#';
                        }
        $cetak .= '"><div class="kategori">
                            Perkantoran<br />' . $cat4 . '</div>
                            </a></div></td></tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td width="25%">
                    <div align="center"><a href="';
                    if($this->session->userdata('login')==TRUE){
                        $cetak .= base_url() . 'index.php/aset/cat/5/';
                    }else{
                        $cetak .= '#';
                    }
                
        $cetak .= '"><img width="160" height="160" src="' . base_url() . 'images/dokter.png" />
                    </a></div>
                </td>
                <td width="25%"><div align="center">
                    <a href="' ;
                    if($this->session->userdata('login')==TRUE){
                        $cetak .= base_url() . 'index.php/aset/cat/6/';
                    }else{
                        $cetak .= '#';
                    }
        $cetak .= '"><img width="160" height="160" src="'. base_url() . 'images/ekonomi.jpg" />
                    </a></div>
                </td>
                <td width="25%"><div align="center">
                    <a href="' ;
                    if($this->session->userdata('login')==TRUE){
                        $cetak .= base_url() . 'index.php/aset/cat/7/';
                    }else{
                        $cetak .= '#';
                    }
        $cetak .= '"><img width="160" height="160" src="' . base_url() . 'images/media.png" />
                    </a></div>
                </td>
                <td width="25%"><div align="center">
                    <a href="';
                    if($this->session->userdata('login')==TRUE){
                        $cetak .= base_url() . 'index.php/aset/cat/8/';
                    }else{
                        $cetak .= '#';
                    }
        $cetak .= '"><img width="160" height="160" src="' . base_url() . 'images/lain2.jpg" />
                    </a></div>
                </td>
            </tr>
            <tr>
                <td width="25%">
                <table width="160" cellpadding="0" cellspacing="0" align="center">
                    <tr>
                        <td bgcolor="#2F89B6">
                            <div class="noline">
                                <a href="';
                                if($this->session->userdata('login')==TRUE){
                                    $cetak .= base_url() . 'index.php/aset/cat/5/';
                                }else{
                                    $cetak .= '#';
                                }
        $cetak .= '"><div class="kategori">Kesehatan<br />' . $cat5 . '</div>
                    </a>
                    </div></td></tr>
                </table>
                </td>
                <td width="25%" align="center">
                <table width="160" cellpadding="0" cellspacing="0" align="center">
                    <tr><td bgcolor="#A04661"><div class="noline">
                    <a href="';
                    if($this->session->userdata('login')==TRUE){
                        $cetak .= base_url() . 'index.php/aset/cat/6/';
                    }else{
                        $cetak .= '#';
                    }
        $cetak .= '"><div class="kategori">Ekonomi<br />' . $cat6 . '</div>
                    </a>
                    </div></td></tr>
                </table>
                </td>
                <td width="25%" align="center">
                <table width="160" cellpadding="0" cellspacing="0" align="center">
                    <tr><td bgcolor="#5B9121"><div class="noline">
                    <a href="';
                    if($this->session->userdata('login')==TRUE){
                        $cetak .= base_url() . 'index.php/aset/cat/7/';
                    }else{
                        echo '#';
                    }
        $cetak .= '"><div class="kategori">Media Dakwah<br />' . $cat7 . '</div>
                    </a>
                    </div></td></tr>
                </table>
                </td>
                <td width="25%" align="center">
                <table width="160" cellpadding="0" cellspacing="0" align="center">
                    <tr><td bgcolor="#EB9500"><div class="noline">
                    <a href="';
                    if($this->session->userdata('login')==TRUE){
                        $cetak .= base_url() . 'index.php/aset/cat/8/';
                    }else{
                        $cetak .= '#';
                    }
        $cetak .= '"><div class="kategori">Lain-lain<br />' . $cat8 . '</div>
                    </a>
                    </div></td></tr>
                </table>
                </td></tr></table>';
        echo $cetak ;
                        ?>
                    </span>
        </td>
    </tr>
</table>
<p>
    <div class="hitung"></div>
</p>
<div class="cleared"></div>
<div class="cleared"></div>
<div class="cleared"></div>
        
