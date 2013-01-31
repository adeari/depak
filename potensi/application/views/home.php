<?php
$flashmessage = $this->session->flashdata('message');
    echo !empty($flashmessage) ? '<p>'.$flashmessage.'</p>' : '';?>
<table width="100%" cellpadding="0" cellspacing="0" border="0" >
    <tr>
        
        <td  colspan="3" >
            <h1><p class="logo-name">Selamat Datang di Aplikasi Pemetaan Potensi Nahdlatul Ulama</p></h1>
            <p>Aplikasi Pemetaan Potensi Nahdlatul Ulama merupakan suatu fasilitas yang digunakan untuk mencatat semua informasi mengenai obyek atau aset yang menjadi potensi
                bagi Warga Nahdlatul Ulama yang meliputi beberapa aspek, mulai dari aspek ekonomi, sosial dan budaya.</p>
            <p>Semoga informasi yang disajikan oleh Aplikasi ini dapat menjadi acuan dalam rangka menggali dan meningkatkan manfaat dari setiap aset yang berpotensi untuk meningkatkan kemaslahatan umat khususnya warga Nahdlatul Ulama.</p>
            <p>&nbsp;</p>
        </td>
        <td >
            <fieldset>
            <legend>Login</legend>    
            <form name="form_login" action="<?php echo base_url(); ?>index.php/home/login" method="post">
                <table width="100%" cellpadding="0" cellspacing="0" border="0">
                    <tr>
                        <td><br />Username<br />
                            <input type="text" name="username" size="20" /><br /><br />
                            Password</font><br />
                            <input type="password" name="password" size="20" /><br /><br />
                            <input type="submit" name="submit" value="Login" /></td>
                    </tr>
                </table>   
            </form>
            </fieldset>
        </td>
    </tr>
    <tr>
        <td colspan="4">&nbsp;</td>
    </tr>
    <tr>
        <td width="25%">
            <div align="center">
            <a href="<?php
                if($this->session->userdata('login')==TRUE){
                    echo base_url() . 'index.php/aset/cat/1';
                    }else{
                        echo '#';
                    }
                    ?>">
                    <img width="160" height="160" alt="" src="<?php echo base_url() . 'images/masjid.jpg';?>" />
            </a></div>
        </td>
        <td width="25%">
            <div align="center">
            <a href="<?php
                if($this->session->userdata('login')==TRUE){
                    echo base_url() . 'index.php/aset/cat/2';
                }else{
                    echo '#';
                }
                ?>">
                <img width="160" height="160" alt="" src="<?php echo base_url() . 'images/pendidikan.jpg';?>" />
            </a></div>
        </td>
        <td width="25%">
            <div align="center">
            <a href="<?php
                if($this->session->userdata('login')==TRUE){
                    echo base_url() . 'index.php/aset/cat/3';
                }else{
                    echo '#';
                }
                ?>">
                <img width="160" height="160" alt="" src="<?php echo base_url() . 'images/sosial.jpg';?>" />
            </a></div>
        </td>
        <td width="25%">
            <div align="center">
            <a href="<?php
                if($this->session->userdata('login')==TRUE){
                    echo base_url() . 'index.php/aset/cat/4';
                }else{
                    echo '#';
                }
                ?>">
                <img width="160" height="160" alt="" src="<?php echo base_url() . 'images/perkantoran.jpg';?>" />
            </a></div>
        </td>
    </tr>
    <tr>
        <td width="25%">
            <table width="160" cellpadding="0" cellspacing="0" align="center">
            <tr><td bgcolor="#2F89B6"><div class="noline"><a href="<?php
                if($this->session->userdata('login')==TRUE){
                    echo base_url() . 'index.php/aset/cat/1';
                }else{
                    echo '#';
                }
                ?>"><div class="kategori">
                Tempat Ibadah<br /><?php echo $cat1;?></div>
            </a></div></td></tr>
            </table>
        </td>
        <td width="25%">
            <table width="160" cellpadding="0" cellspacing="0" align="center">
            <tr><td bgcolor="#A04661"><div class="noline"><a href="<?php
                if($this->session->userdata('login')==TRUE){
                    echo base_url() . 'index.php/aset/cat/2';
                }else{
                    echo '#';
                }
                ?>"><div class="kategori">
                Pendidikan<br /><?php echo $cat2;?></div>
            </a></div></td></tr>
            </table>
        </td>
        <td width="25%" align="center">
            <table width="160" cellpadding="0" cellspacing="0" align="center">
            <tr><td bgcolor="#5B9121"><div class="noline"><a href="<?php
                if($this->session->userdata('login')==TRUE){
                    echo base_url() . 'index.php/aset/cat/3';
                }else{
                    echo '#';
                }
                ?>"><div class="kategori">
                Sosial<br /><?php echo $cat3;?></div>
            </a></div></td></tr>
            </table>
        </td>
        <td width="25%" align="center">
            <table width="160" cellpadding="0" cellspacing="0" align="center">
            <tr><td bgcolor="#EB9500"><div class="noline"><a href="<?php
                if($this->session->userdata('login')==TRUE){
                    echo base_url() . 'index.php/aset/cat/4';
                }else{
                    echo '#';
                }
                ?>"><div class="kategori">
                Perkantoran<br /><?php echo $cat4;?></div>
                    </a></div></td></tr>
            </table>
        </td>
    </tr>
    <tr>
        <td width="25%">
            <div align="center">
            <a href="<?php
                if($this->session->userdata('login')==TRUE){
                    echo base_url() . 'index.php/aset/cat/5';
                }else{
                    echo '#';
                }
                ?>">
                <img width="160" height="160" alt="" src="<?php echo base_url() . 'images/dokter.png';?>" />
            </a></div>
        </td>
        <td width="25%">
            <div align="center">
            <a href="<?php
                if($this->session->userdata('login')==TRUE){
                    echo base_url() . 'index.php/aset/cat/6';
                }else{
                    echo '#';
                }
                ?>">
                <img width="160" height="160" alt="" src="<?php echo base_url() . 'images/ekonomi.jpg';?>" />
            </a></div>
        </td>
        <td width="25%">
            <div align="center">
            <a href="<?php
                if($this->session->userdata('login')==TRUE){
                    echo base_url() . 'index.php/aset/cat/7';
                }else{
                    echo '#';
                }
                ?>">
                <img width="160" height="160" alt="" src="<?php echo base_url() . 'images/media.png';?>" />
            </a></div>
        </td>
        <td width="25%">
            <div align="center">
            <a href="<?php
                if($this->session->userdata('login')==TRUE){
                    echo base_url() . 'index.php/aset/cat/8';
                }else{
                    echo '#';
                }
                ?>">
                <img width="160" height="160" alt="" src="<?php echo base_url() . 'images/lain2.jpg';?>" />
            </a></div>
        </td>
    </tr>
    <tr>
        <td width="25%">
            <table width="160" cellpadding="0" cellspacing="0" align="center">
            <tr><td bgcolor="#2F89B6"><div class="noline"><a href="<?php
                if($this->session->userdata('login')==TRUE){
                    echo base_url() . 'index.php/aset/cat/5';
                }else{
                    echo '#';
                }
                ?>"><div class="kategori">Kesehatan<br />
                    <?php echo $cat5;?></div>
                    </a>
                    </div></td></tr>
            </table>
        </td>
        <td width="25%" align="center">
            <table width="160" cellpadding="0" cellspacing="0" align="center">
            <tr><td bgcolor="#A04661"><div class="noline"><a href="<?php
                if($this->session->userdata('login')==TRUE){
                    echo base_url() . 'index.php/aset/cat/6';
                }else{
                    echo '#';
                }
                ?>"><div class="kategori">Ekonomi<br />
                    <?php echo $cat6;?></div>
                    </a>
                    </div></td></tr>
            </table>
        </td>
        <td width="25%" align="center">
            <table width="160" cellpadding="0" cellspacing="0" align="center">
            <tr><td bgcolor="#5B9121"><div class="noline"><a href="<?php
                if($this->session->userdata('login')==TRUE){
                    echo base_url() . 'index.php/aset/cat/7';
                }else{
                    echo '#';
                }
                ?>"><div class="kategori">Media Dakwah<br />
                    <?php echo $cat7;?></div>
                    </a>
                    </div></td></tr>
            </table>
        </td>
        <td width="25%" align="center">
            <table width="160" cellpadding="0" cellspacing="0" align="center">
            <tr><td bgcolor="#EB9500"><div class="noline"><a href="<?php
                if($this->session->userdata('login')==TRUE){
                    echo base_url() . 'index.php/aset/cat/8';
                }else{
                    echo '#';
                }
                ?>"><div class="kategori">Lain-lain<br />
                    <?php echo $cat8;?></div>
                    </a>
                </div></td></tr>
            </table>
        </td>
    </tr>
</table>

<div class="cleared"></div>
<div class="cleared"></div>
<div class="cleared"></div>
        
