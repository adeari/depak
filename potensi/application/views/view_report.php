
<?php
    
    echo !empty($h2_title) ? '<h2>'.$h2_title.'</h2>' : '';
    echo !empty($message) ? '<p>'.$message.'</p>' : '';
                    
    $flashmessage = $this->session->flashdata('message');
    echo !empty($flashmessage) ? '<p>'.$flashmessage.'</p>' : '';
    
    echo '<p>&nbsp;</p>';
                    
    echo !empty($table) ? $table : '';
    
    echo !empty($pagination) ? '<p id="pagination">'.$pagination.'</p>' : '';
    
    echo '<p>&nbsp;</p>';
    
    
    if(!empty ($link)){
        echo '<div id="bottom_link">';
        foreach($link as $links){
            echo $links . ' ';
        }
        echo '</div>';
    }
    //echo '<a href="' . base_url() . 'index.php/report/topdf">
        //<span style="color:green;">Export to Pdf</span></a>';
    
?>