<table width="100%" cellpadding="0" cellspacing="0" border="0">
    <tr bgcolor="#487A26">
        <td width="60%">
            <?php
                if($this->session->userdata('login')==TRUE){
                    
                    echo '<ul id="simple-horizontal-menu">
                            <li>';
                    if($this->session->userdata('login')==TRUE){
                        echo anchor('rekap/','Home') ;
                    }else{
                        echo anchor('home/','Home') ;
                    }
                    echo '</li>';
                    if($this->session->userdata('level')=='Administrator' or $this->session->userdata('level')=='Supervisor'){
                       echo '<li><a href="#">Master Data</a>
                                <ul>
                                    <li>' .
                                        anchor('propinsi/','Master Propinsi') .
                                   '</li>
                                    <li>' . 
                                        anchor('kota/','Master Kota/Kabupaten') . 
                                   '</li>
                                    <li>' .
                                        anchor('kecamatan/','Master Kecamatan') . 
                                   '</li>
                                    <li>' .
                                        anchor('Kelurahan/','Master Kelurahan') . 
                                   '</li>
                                    <li>' .
                                        anchor('jenis/','Master Kategori Aset') .
                                   '</li>
                                    <li>' .
                                        anchor('bukti/','Master Bukti Kepemilikan') . 
                                   '</li>
                                    <li>' .
                                        anchor('status/','Master Status Tanah') . 
                                   '</li>
                                    <li>' .
                                        anchor('pengelola/','Master Pengelola') .
                                   '</li>
                                    <li>' .
                                        anchor('pengguna/','Master User') .
                                   '</li>
                               </ul>
                            </li>';
                       }
                       if($this->session->userdata('level')!='User'){
                           echo '<li><a href="#">Entry Data</a>
                                <ul>
                                    <li>' .
                                        anchor('aset/add','Entry Data Aset') . 
                                   '</li>
                                </ul>
                            </li>';
                       }
                       echo '<li>' .
                                anchor('search/','Pencarian') .
                           '</li>
                           <li><a href="#">Rekapitulasi</a>
                                <ul>
                                    <li>' .
                                        anchor('report/','Rekapitulasi Aset') .
                                    '</li>
                                    <li>' .
                                        anchor('rptentry/','Rekapitulasi Entry') .
                                    '</li>
                                    <li>' .
                                        anchor('rpaset/','Rekapitulasi Aset') .
                                    '</li>
                                    <li>' .
                                        anchor('rpentry/','Rekapitulasi Perolehan Entry') .
                                    '</li>
                                    		<li>' .
                                        anchor('rpjo/','Rekapitulasi Jumlah Obyek') .
                                    '</li>
                               </ul>
                           </li>
                        </ul>';
            }else{
                echo '&nbsp;';
            }
            ?>
        </td>
        <td width="40%" align="right" valign="center"><?php
            if($this->session->userdata('login') == TRUE){
                echo '<table width="100%" cellpadding="0" cellspacing="0" border="0">
                        <tr>
                            <td>
                            <div align="left">
                            <font color="#ddd">
                                User : ' . $this->session->userdata['username'] . '<br /> 
                                Level : ' . $this->session->userdata['level'] .
                            '</font>
                                </div></td>
                            <td>' . anchor('home/logout','Logout') .
                            '</td>
                        </tr>
                     </table>';
            }else{
                echo '&nbsp;';
            }
            ?>
        </td>
    </tr>
</table>
        