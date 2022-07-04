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

    </style>
    <script>
  
  /* Code for changing active 
  link on clicking */
  var btns = 
      $("#navbarSupportedContent .navbar-nav .nav-link");

  for (var i = 0; i < btns.length; i++) {
      btns[i].addEventListener("click",
                            function () {
          var current = document
              .getElementsByClassName("active");

          current[0].className = current[0]
              .className.replace(" active", "");

          this.className += " active";
      });
  }
</script>

</head>
<body>
<nav class="navbar sticky-top navbar-expand-lg navbar-white" style="background-color:#F90B0B;">
  <a class="navbar-brand" href="./home.php"> <img src="../inc/PPP2022.png" width="150" alt="" class="d-inline-block align-middle mr-2"></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="nav nav-pills nav-fill mr-auto">
      <li class="nav-item">
        <a class="nav-link text-light" href="./home.php">Mail Tester<span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-light" href="#">HLR Tester</a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-light" href="./codesDesc.php">Codes SMTP</a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-light" href="./searchClient.php">Finder</a>
      </li>
      <li class="nav-item">
        <!-- <a class="nav-link disabled" href="#">A propos</a> -->
        <a class="nav-link text-light" href="#">A propos</a>
      </li>
    </ul>
    <!-- <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-primary my-2 my-sm-0" type="submit">Search</button>
    </form> -->
  </div>
</nav>
</body>