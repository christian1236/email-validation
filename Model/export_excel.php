<?php  
    include "./config.php";

    $sql = "SELECT email,fichierSource,domaine,codeRetour,statut,dateVerif FROM emails WHERE fichierSource = 'emails3.txt' ORDER BY codeRetour";  
    $setRec = mysqli_query($link, $sql);  
    $columnHeader = '';  
    $columnHeader = "email" . "\t" . "fichierSource" . "\t" . "domaine" . "\t". "codeRetour" . "\t". "statut" . "\t". "dateVerif" . "\t";  
    $setData = '';  
    while ($rec = mysqli_fetch_row($setRec)) {  
        $rowData = '';  
        foreach ($rec as $value) {  
            $value = '"' . $value . '"' . "\t";  
            $rowData .= $value;  
        }  
        $setData .= trim($rowData) . "\n";  
    }  
    
    header("Content-type: application/octet-stream");  
    header("Content-Disposition: attachment; filename=Rapport.xls");  
    header("Pragma: no-cache");  
    header("Expires: 0");  

    echo ucwords($columnHeader) . "\n" . $setData . "\n";  
?> 
 