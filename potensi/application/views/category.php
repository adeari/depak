<table width="850" cellpadding="0" cellspacing="0" border="0" align="center">
    <tr>
        <td width="25%">
            <table width="100%" cellpadding="0" cellspacing="0" align="center">
            <tr><td bgcolor="#2F89B6"><div class="noline"><a href="<?php
                if($this->session->userdata('login')==TRUE){
                    echo base_url() . 'index.php/aset/cat/1';
                }else{
                    echo '#';
                }
                ?>"><div class="kategori">
                Tempat Ibadah<br /><?php echo $this->Aset_model->countAsetByJenis(1);?>
                    </div></a></td></tr>
            </table>
        </td>
        <td width="25%">
            <table width="100%" cellpadding="0" cellspacing="0" align="center">
            <tr><td bgcolor="#A04661"><div class="noline"><a href="<?php
                if($this->session->userdata('login')==TRUE){
                    echo base_url() . 'index.php/aset/cat/2';
                }else{
                    echo '#';
                }
                ?>"><div class="kategori">
                Pendidikan<br /><?php echo $this->Aset_model->countAsetByJenis(2);?></div>
                    </div></a></td></tr>
            </table>
        </td>
        <td width="25%">
            <table width="100%" cellpadding="0" cellspacing="0" align="center">
            <tr><td bgcolor="#5B9121"><div class="noline"><a href="<?php
                if($this->session->userdata('login')==TRUE){
                    echo base_url() . 'index.php/aset/cat/3';
                }else{
                    echo '#';
                }
                ?>"><div class="kategori">
                Sosial<br /><?php echo $this->Aset_model->countAsetByJenis(3);?></div>
                    </div></a></td></tr>
            </table>
        </td>
        <td width="25%"><table width="100%" cellpadding="0" cellspacing="0" align="center">
            <tr><td bgcolor="#EB9500"><div class="noline"><a href="<?php
                if($this->session->userdata('login')==TRUE){
                    echo base_url() . 'index.php/aset/cat/4';
                }else{
                    echo '#';
                }
                ?>"><div class="kategori">
                Perkantoran<br /><?php echo $this->Aset_model->countAsetByJenis(4);?></div>
                    </div></a></td></tr>
            </table></td>
    </tr>
    <tr>
        <td width="25%">
            <table width="100%" cellpadding="0" cellspacing="0" align="center">
            <tr><td bgcolor="#2F89B6"><div class="noline"><a href="<?php
                if($this->session->userdata('login')==TRUE){
                    echo base_url() . 'index.php/aset/cat/5';
                }else{
                    echo '#';
                }
                ?>"><div class="kategori">Kesehatan<br />
                    <?php echo $this->Aset_model->countAsetByJenis(5);?></div>
                    </div></a>
                </td></tr>
            </table>
        </td>
        <td width="25%">
            <table width="100%" cellpadding="0" cellspacing="0" align="center">
            <tr><td bgcolor="#A04661"><div class="noline"><a href="<?php
                if($this->session->userdata('login')==TRUE){
                    echo base_url() . 'index.php/aset/cat/6';
                }else{
                    echo '#';
                }
                ?>"><div class="kategori">Ekonomi<br />
                    <?php echo $this->Aset_model->countAsetByJenis(6);?></div>
                    </div></a>
                </td></tr>
            </table>
        </td>
        <td width="25%">
            <table width="100%" cellpadding="0" cellspacing="0" align="center">
            <tr><td bgcolor="#5B9121"><div class="noline"><a href="<?php
                if($this->session->userdata('login')==TRUE){
                    echo base_url() . 'index.php/aset/cat/7';
                }else{
                    echo '#';
                }
                ?>"><div class="kategori">Media Dakwah<br />
                    <?php echo $this->Aset_model->countAsetByJenis(7);?></div>
                    </div></a>
                </td></tr>
            </table>
        </td>
        <td width="25%">
            <table width="100%" cellpadding="0" cellspacing="0" align="center">
            <tr><td bgcolor="#EB9500"><div class="noline"><a href="<?php
                if($this->session->userdata('login')==TRUE){
                    echo base_url() . 'index.php/aset/cat/8';
                }else{
                    echo '#';
                }
                ?>"><div class="kategori">Lain-lain<br />
                    <?php echo $this->Aset_model->countAsetByJenis(8);?></div>
                    </div></a>
                </td></tr>
            </table>
        </td>
    </tr>
</table>