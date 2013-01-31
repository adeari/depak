
<?php
    
    echo !empty($h2_title) ? '<h2>'.$h2_title.'</h2>' : '';
    echo !empty($message) ? '<p>'.$message.'</p>' : '';
                    
    $flashmessage = $this->session->flashdata('message');
    echo !empty($flashmessage) ? '<p>'.$flashmessage.'</p>' : '';
    
    echo !empty($pagination) ? '<p id="pagination">'.$pagination.'</p>' : '';
                    
    echo !empty($table) ? $table : '';
     
    echo $link['link_add'];
?>
                    