<html>
    <head>
    <title>Aplikasi Pemetaan Potensi NU</title>
    <link rel="stylesheet" href="<?php echo base_url() . 'css/cssku.css';?>" type="text/css" media="screen" />
    <link rel="stylesheet" href="<?php echo base_url() . 'css/style.css';?>" type="text/css" media="screen" />
    <link rel="stylesheet" href="<?php echo base_url() . 'css/home.css';?>" type="text/css" media="screen" />
    <link rel="stylesheet" href="<?php echo base_url() . 'js/ui/themes/base/jquery.ui.all.css';?>" type="text/css" />
    <link rel="icon" href="<?php echo base_url() . 'images/favicon.ico';?>" type="image/x-icon"/>
    <link rel="shortcut icon" href="<?php echo base_url() . 'images/favicon.ico';?>" type="image/x-icon"/>
    <?php
    echo '<script type="text/javascript" src="' . base_url() . 'js/ui/jquery-1.7.2.js"></script>';
    if($this->uri->segment(1)=='rekap'){
        echo '<script type="text/javascript" src="' . base_url() . 'js/rekap.js"></script>';
    }else{
        echo '<script type="text/javascript" src="' . base_url() . 'js/dropdown.js"></script>';
    }
    
    echo '<link href="' . base_url() . 'css/menu.css" rel="stylesheet" />';
    echo '<script src="' . base_url() . 'js/ext-core-debug.js"></script>';
    echo '<script src="' . base_url() . 'js/menu.js"></script>';
    echo '<script src="' . base_url() . 'js/validasi.js"></script>';
    echo '<script src="' . base_url() . 'js/ui/ui.core.js"></script>';
    echo '<script src="' . base_url() . 'js/ui/ui/jquery.ui.datepicker.js"></script>';
    echo '<link href="' . base_url() . 'css/val.css" rel="stylesheet" />';
    $propID = $this->uri->segment(3);
    ?>
    
    <script type="text/javascript">
        Ext.onReady(function() {
            new Ext.ux.Menu('simple-horizontal-menu', {
                transitionType: 'slide',
                direction: 'horizontal', // default
                delay: 0.2,              // default
                autoWidth: true,         // default
                transitionDuration: 0.3, // default
                animate: true,           // default
                currentClass: 'current'  // default
            });
        });
    </script>
    
    <script type="text/javascript" src="<?php echo base_url() . 'js/control_input.js';?>"></script>
   
    <script type="text/javascript">
        function get_check_value(){
        
            if (document.detilform.detil.checked){
                showDetail();
            }else{
                hideDetail();
            }
        }
        
        
    </script>
    <style type="text/css">
        .ux-menu a.current {
            background-image: <?php echo "url('" . base_url() . "images/menuitem.png')"; ?>;
            border-color: #0D512A;
        }
        
        div.item {
            padding: 20px;
        }
    </style>
        
    <body
        background="<?php echo base_url() . 'images/bg_main.jpg'; ?>"
        
                onload="<?php
          if($this->uri->segment(1)=='rekap'){
            echo 'rekap_prop('. $propID .');';
          } else if(strcmp($this->uri->segment(1),'rpaset')==0){
			$propinsiID = '\'\'';
			$kotaID = '\'\'';
			$kecamatanID = '\'\'';
			
			if (strlen($this->uri->segment(3))>1&&strcmp(substr($this->uri->segment(3),0,1),"a")==0) {
				$propinsiID = substr($this->uri->segment(3),1);
			}
			
			if (strlen($this->uri->segment(4))>1&&strcmp(substr($this->uri->segment(4),0,1),"b")==0) {
				$kotaID = substr($this->uri->segment(4),1);
			}
			
			if (strlen($this->uri->segment(5))>1&&strcmp(substr($this->uri->segment(5),0,1),"c")==0) {
				$kecamatanID = substr($this->uri->segment(5),1);
			}
			
			
			if (strlen($this->input->post('propinsi')>0)) {
				$propinsiID = $this->input->post('propinsi');
			}
			
			if (strlen($this->input->post('kota')>0)) {
				$kotaID = $this->input->post('kota');
			}
			
			if (strlen($this->input->post('kecamatan')>0)) {
				$kecamatanID = $this->input->post('kecamatan');
			}
			echo "ambil_propInRPaset(".$propinsiID.",false,".$kotaID.",".$kecamatanID.");";
		  } else if(strcmp($this->uri->segment(1),'rpentry')==0){
			$kosong ="";
          }else if(strcmp($this->uri->segment(1),'search')==0){
              echo 'ambil_propSearch('.$propinsiID.','.$kotaID.','.$kecamatanID.','.$kelID.');';
          }else{
              echo 'ambil_prop('. $propID .');';
          }
          ?>" >
        <table width="900" cellpadding="0" cellspacing="0" border="0" align="center" background="<?php echo base_url() . 'images/c8d0ba-40PERSEN.png'; ?>">
            <tr>
                <td><img width="910" src="<?php echo base_url() . 'images/HeaderV2.jpg' ?>"></td>
            </tr>
            <tr>
                <td colspan="2"><?php $this->load->view('navigation'); ?></td>
            </tr>
            <tr>
                <td colspan="2"><?php $this->load->view($main_view);?></td>
            </tr>
        </table>
        
        
        <div class="cleared"></div>
            
        <div class="art-footer">
            <div class="art-footer-body">
                <div class="art-footer-text">
                    <p>Copyright &copy 2012 Garuda Edwin'n'Hatta Alfian. All Rights Reserved. Support : 64rud43dw10@gmail.com<br />
                    </p>
                </div>
                
                <div class="cleared"></div>
            </div>
        </div>
            
        <div class="cleared"></div>

        <div class="cleared"></div>
            <p class="art-page-footer">Lisenced to PWNU Jawa Timur - Jl. Masjid Al Akbar Surabaya - Indonesia.</p>
        <div class="cleared"></div>
    
</body>
</html>
