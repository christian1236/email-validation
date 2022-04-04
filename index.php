<?php
    //On démarre une nouvelle session
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Accueil</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <style>
        .wrapper{
            width: 600px;
            margin: 0 auto;
        }
        table tr td:last-child{
            width: 120px;
        }
    </style>
    <script>
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();   
        });
    </script>
</head>
<body>
    <?php
        include './View/navbar.php';
    ?>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="mt-5 mb-3 clearfix">
                            <h2 class="pull-left">Valider un email</h2>
                    <form action="./Model/validate-one-mail.php" method="post" enctype="multipart/form-data">
                        <div class="form-group mx-sm-3 mb-2">
                            <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" placeholder="Enter email">
                            <small id="emailHelp" class="form-text text-muted">Nous ne partagerons jamais vos information à qui que ce soit.</small>
                            <button type="submit" class="btn btn-primary mb-2 pull-right">Vérifier</button>
                        </div>

                        <br/>
                        <br/>
                    </form>
                    <?php
                    echo '<table class="table table-bordered table-striped bg-light border shadow mb-5 bg-white rounded">';
                                echo "<thead>";
                                    echo "<tr>";
                                        echo "<th>email</th>";
                                        echo "<th>domaine</th>";
                                        echo "<th>code de retour</th>";
                                        echo "<th>statut</th>";
                                        echo "<th>date de vérification</th>";
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                
                                    echo "<tr>";
                                        echo "<td>" . $_SESSION['email'] . "</td>";
                                        echo "<td>" . $_SESSION['domaine'] . "</td>";
                                        echo "<td>" . $_SESSION['code'] . "</td>";
                                        echo "<td>" . $_SESSION['statut'] . "</td>";
                                        echo "<td>" . $_SESSION['date'] . "</td>";
                                    echo "</tr>";
                        
                                echo "</tbody>";                            
                            echo "</table>";
                            ?>
                        <h2 class="pull-left">Valider un fichier d'emails</h2>
                        <form action="./Model/upload.php" method="post" enctype="multipart/form-data">
                            <input type="file" name="fileToUpload" id="fileToUpload" class="btn btn-primary pull-right">
                            <br/>
                            <br/>
                            <br/>
                            <input type="submit" value="Upload TXT" name="submit" class="btn btn-primary pull-right">
                        </form>
                       
                    </div>
                    <?php
                    // Include config file
                    require_once "./Model/config.php";
                    
                    // Attempt select query execution
                    $sql = "SELECT * FROM files";
                    if($result = mysqli_query($link, $sql)){
                        if(mysqli_num_rows($result) > 0){
                            echo '<table class="table table-bordered table-striped bg-light border shadow mb-5 bg-white rounded">';
                                echo "<thead>";
                                    echo "<tr>";
                                        echo "<th>#</th>";
                                        echo "<th>Nom</th>";
                                        echo "<th>Date Ajout</th>";
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                while($row = mysqli_fetch_array($result)){
                                    echo "<tr>";
                                        echo "<td>" . $row['id'] . "</td>";
                                        echo "<td>" . $row['nom'] . "</td>";
                                        echo "<td>" . $row['dateAjout'] . "</td>";
                                        echo "<td>";
                                            echo '<a href="./View/read.php?id='. $row['id'] .'" class="mr-3" title="Voir les détails" data-toggle="tooltip"><span class="fa fa-eye"></span></a>';
                                            echo '<a href="./View/update.php?id='. $row['id'] .'" class="mr-3" title="Valider les emails Record" data-toggle="tooltip"><span class="fa fa-refresh"></span></a>';
                                            echo '<a href="./View/delete.php?id='. $row['id'] .'" title="Supprimer le fichiers" data-toggle="tooltip"><span class="fa fa-trash"></span></a>';
                                        echo "</td>";
                                    echo "</tr>";
                                }
                                echo "</tbody>";                            
                            echo "</table>";
                            // Free result set
                            mysqli_free_result($result);
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
</body>
<footer>
    <?php
        include './View/footer.php';
    ?>                
</footer>
</html>