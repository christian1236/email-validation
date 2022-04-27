<?php

session_start();

$target_dir = "../Files/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

// // Check if image file is a actual image or fake image
// if(isset($_POST["submit"])) {
//   $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
//   if($check !== false) {
//     echo "File is an image - " . $check["mime"] . ".";
//     $uploadOk = 1;
//   } else {
//     echo "File is not an image.";
//     $uploadOk = 0;
//   }
// }

// Check if file already exists
if (file_exists($target_file)) {
  header("location: ../View/errorFileExist.php");
  $uploadOk = 0;
}

// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
  echo "Sorry, your file is too large.";
  $uploadOk = 0;
}

// Allow certain file formats
if($imageFileType != "txt") {
  header("location: ../View/errorFileType.php");
  $uploadOk = 0;
}


// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
  echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
  if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
    echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
    if($_SERVER["REQUEST_METHOD"] == "POST"){
    $name = htmlspecialchars( basename( $_FILES["fileToUpload"]["name"]));
    $_SESSION['filename'] = $name;
    $dateAjout = date("l jS \of F Y h:i:s A");
    // Include config file
    require_once "config.php";
    require_once "validate-mails.php";
    // Processing form data when form is submitted
    

        // Prepare an insert statement
        $sql = "INSERT INTO files (nom, dateAjout, nbre, nbreVal, nbreInv) VALUES (?, ?, ?, ?, ?)";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sssss", $param_name, $param_date, $param_nbre, $param_nbreVal, $param_nbreInv);
            
            // Set parameters
            $param_name = $name;
            $param_date = $dateAjout;
            $param_nbre = $_SESSION['nbre'];
            $param_nbreVal = $_SESSION['nbreVal'];
            $param_nbreInv = $_SESSION['nbreInv'];
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records created successfully. Redirect to landing page
                header("location: ./home.php");
                exit();
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
        // Close connection
        mysqli_close($link);
    }



  } else {
    echo "Sorry, there was an error uploading your file.";
  }
}
?>