<?php
    require_once "../Model/read.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Record</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .wrapper{
            width: 600px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="mt-5 mb-3">Détails du fichier TXT</h1>
                    <div class="form-group">
                        <label>Nom</label>
                        <p><b><?php echo $row["nom"]; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>Date Ajout</label>
                        <p><b><?php echo $row["dateAjout"]; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>Contenu : </label>
                        <?php
                        $fichier = '../Files/'.$row["nom"];
                        $text = file_get_contents($fichier); 
                        echo $text; 
                        ?> 
                    </div>
                    <p><a href="../index.php" class="btn btn-primary">Back</a></p>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>