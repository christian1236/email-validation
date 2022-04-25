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
        include './navbar.php';
    ?>
    
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="mt-5 mb-3 clearfix">
                            <h2 class="pull-left">Faire une recherche</h2>
                    <form action="../Model/searchClient.php" method="post" enctype="multipart/form-data">
                        <div class="form-group mx-sm-3 mb-2">
                            <input type="text" class="form-control" id="nom" name="nom" aria-describedby="nameHelp" placeholder="Nom">
                            </br>
                            <input type="text" class="form-control" id="prenom" name="prenom" aria-describedby="nameHelp" placeholder="Prénom">
                            </br>
                            <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" placeholder="Email">
                            <!-- <small id="emailHelp" class="form-text text-muted">Nous ne partagerons jamais vos information à qui que ce soit.</small> -->
                            </br>
                            <input type="phone" class="form-control" id="phone" name="phone" aria-describedby="phoneHelp" placeholder="Numéro de téléphone">
                            </br>
                            <button type="submit" class="btn btn-primary mb-2 pull-right">Lancer</button>
                        </div>
                    </form> 
                    </div>
                </div>
            </div>        
        </div>
    </div>
</body>
<footer>
    <?php
        include './footer.php';
    ?>                
</footer>
</html>