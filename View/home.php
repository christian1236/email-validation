<?php
    //On démarre une nouvelle session
    session_start();
    if(isset($_POST['records-limit'])){
        $_SESSION['records-limit'] = $_POST['records-limit'];
    }
    
    $limit = isset($_SESSION['records-limit']) ? $_SESSION['records-limit'] : 5;
    $page = (isset($_GET['page']) && is_numeric($_GET['page']) ) ? $_GET['page'] : 1;
    $paginationStart = ($page - 1) * $limit;
    $sql0 = "SELECT * FROM files LIMIT $paginationStart, $limit";
    $files = mysqli_query($link, $sql0);
    // Get total records
    // Attempt select query execution
    $sql1 = "SELECT count(id) AS id FROM files";
    $result = mysqli_query($link, $sql1);
    $allRecrods = $result[0]['id'];
    
    // Calculate total pages 
    $totoalPages = ceil($allRecrods / $limit);
    // Prev + Next
    $prev = $page - 1;
    $next = $page + 1;
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
        include './navbar.php';
    ?>
    
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="mt-5 mb-3 clearfix">
                            <h2 class="pull-left">Valider un email</h2>
                    <form action="../Model/validate-one-mail.php" method="post" enctype="multipart/form-data">
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
                        <form action="../Model/upload.php" method="post" enctype="multipart/form-data">
                            <input type="file" name="fileToUpload" id="fileToUpload" class="btn btn-primary pull-right">
                            <br/>
                            <br/>
                            <br/>
                            <input type="submit" value="Upload TXT" name="submit" class="btn btn-primary pull-right">
                        </form>
                        <!-- Select dropdown -->
                        <div class="d-flex flex-row-reverse bd-highlight mb-3">
                                <form action="home.php" method="post">
                                    <select name="records-limit" id="records-limit" class="custom-select">
                                        <option disabled selected>Records Limit</option>
                                        <?php foreach([5,7,10,12] as $limit) : ?>
                                        <option
                                            <?php if(isset($_SESSION['records-limit']) && $_SESSION['records-limit'] == $limit) echo 'selected'; ?>
                                            value="<?= $limit; ?>">
                                            <?= $limit; ?>
                                        </option>
                                        <?php endforeach; ?>
                                    </select>
                                </form>
                            </div>
                       
                    </div>
                    <?php
                    // Include config file
                    require_once "../Model/config.php";
                    
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
                                            echo '<a href="./read.php?id='. $row['id'] .'" class="mr-3" title="Voir les détails" data-toggle="tooltip"><span class="fa fa-eye"></span></a>';
                                            echo '<a href="../Model/export_excel.php" class="mr-3" title="Voir les détails" data-toggle="tooltip"><span class="fa fa-download"></span></a>';
                                            echo '<a href="../Model/delete.php?id='. $row['id'] .'" title="Supprimer le fichiers" data-toggle="tooltip"><span class="fa fa-trash"></span></a>';
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
                    // mysqli_close($link);
                    ?>
                </div>
            </div>        
        </div>
    </div>
    
     <!-- Pagination -->
     <nav aria-label="Page navigation example mt-5">
            <ul class="pagination justify-content-center">
                <li class="page-item <?php if($page <= 1){ echo 'disabled'; } ?>">
                    <a class="page-link"
                        href="<?php if($page <= 1){ echo '#'; } else { echo "?page=" . $prev; } ?>">Previous</a>
                </li>
                <?php for($i = 1; $i <= $totoalPages; $i++ ): ?>
                <li class="page-item <?php if($page == $i) {echo 'active'; } ?>">
                    <a class="page-link" href="home.php?page=<?= $i; ?>"> <?= $i; ?> </a>
                </li>
                <?php endfor; ?>
                <li class="page-item <?php if($page >= $totoalPages) { echo 'disabled'; } ?>">
                    <a class="page-link"
                        href="<?php if($page >= $totoalPages){ echo '#'; } else {echo "?page=". $next; } ?>">Next</a>
                </li>
            </ul>
        </nav>
    </div>
    <!-- jQuery + Bootstrap JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#records-limit').change(function () {
                $('form').submit();
            })
        });
    </script>
</body>
<footer>
    <?php
        include './footer.php';
    ?>                
</footer>
</html>