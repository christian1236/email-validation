<?php
    include "./config.php";

    $fh = fopen('data.txt', 'w');

    $sql = "SELECT email,statut FROM emails WHERE statut = 'valide' ORDER BY codeRetour";  
    /* insert field values into data.txt */

    $result = mysqli_query($link, $sql);   
    while ($row = mysqli_fetch_array($result)) {          
        $num = mysqli_num_fields($result) ;    
        $last = $num - 1;
        for($i = 0; $i < $num; $i++) {            
            fwrite($fh, $row[$i]);                       
            if ($i != $last) {
                fwrite($fh, ",");
            }
        }                                                                 
        fwrite($fh, "\n");
    }
    fclose($fh);
?>