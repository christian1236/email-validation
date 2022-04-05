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
            width: 1000px;
            margin: 5%;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
        <p><a href="../index.php" class="btn btn-primary">Back</a></p>
            <div class="row mx-md-n5">
            <div class="col px-md-12">
                <div class="p-3 bg-light border shadow mb-5 bg-white rounded">
                    <h2>Détails du fichier TXT</h2>
                    <div class="form-group">
                        <label>Nom</label>
                        <p><b><?php echo $row["nom"]; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>Date Ajout</label>
                        <p><b><?php echo $row["dateAjout"]; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>Contenu : </label></br>
                        <div class="overflow-auto border border-dark" style="height: 100px;">
                        <?php
                        $fichier = '../Files/'.$row["nom"];
                        $text = file_get_contents($fichier); 
                        echo $text; 
                        ?> 
                        </div>
                    </div>
                    <div class="form-group">
                    <a href="./indexOneFile.php" class="btn btn-primary" type="button">
                        emails </br>
                        <h2><span class="badge">5</span></h2>
                    </a>
                    <button class="btn btn-success" type="button">
                        valides </br>
                        <h2><span class="badge">5</span></h2>
                    </button>
                    <button class="btn btn-danger" type="button">
                        Non valides </br>
                        <h2><span class="badge">5</span></h2>
                    </button>
                    <button class="btn btn-warning" type="button">
                        Inconnus </br>
                        <h2><span class="badge">5</span></h2>
                    </button>
                
                    </div>
                </div>
            </div>
            <div class="col px-md-5">
                <div class="p-3 bg-light border shadow mb-5 bg-white rounded">
                <h2>Détails des emails</h2>
                <?php
                    // Include config file
                    require_once "../Model/config.php";
                    
                    // Attempt select query execution
                    $sql2 = "SELECT * FROM emails";
                    if($result2 = mysqli_query($link, $sql2)){
                        if(mysqli_num_rows($result2) > 0){
                            echo '<table class="table table-bordered table-striped">';
                                echo "<thead>";
                                    echo "<tr>";
                                        echo "<th>#</th>";
                                        echo "<th>email</th>";
                                        echo "<th>fichier source</th>";
                                        echo "<th>domaine</th>";
                                        echo "<th>code de retour</th>";
                                        echo "<th>statut</th>";
                                        echo "<th>date de vérification</th>";
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                while($row = mysqli_fetch_array($result2)){
                                    echo "<tr>";
                                        echo "<td>" . $row['id'] . "</td>";
                                        echo "<td>" . $row['email'] . "</td>";
                                        echo "<td>" . $row['fichierSource'] . "</td>";
                                        echo "<td>" . $row['domaine'] . "</td>";
                                        echo "<td>" . $row['codeRetour'] . "</td>";
                                        echo "<td>" . $row['statut'] . "</td>";
                                        echo "<td>" . $row['dateVerif'] . "</td>";
                                    echo "</tr>";
                                }
                                echo "</tbody>";                            
                            echo "</table>";
                            // Free result set
                            mysqli_free_result($result2);
                        } else{
                            echo '<div class="alert alert-danger"><em>No records were found.</em></div>';
                        }
                    } else{
                        echo "Oops! Something went wrong. Please try again later.";
                    }
 
                    // Close connection
                    mysqli_close($link);
                    ?>
                </div>
    </div>  
            </div>  
        </div>
    </div>
</body>
<?php
        include './footer.php';
    ?>
</html>