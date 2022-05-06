<?php
       
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                   
    function get_data() {
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $email = $_POST['email'];
        $adress = $_POST['adress'];
        $phone = $_POST['phone'];
        $file_name='searched'. '.json';
   
        if(file_exists("$file_name")) { 
            $current_data=file_get_contents("$file_name");
            $array_data=json_decode($current_data, true);
                               
            $extra=array(
                'nom' => $_POST['nom'],
                'prenom' => $_POST['prenom'],
                'email' => $_POST['email'],
                'adresse' => $_POST['adress'],
                'phone' => $_POST['phone'],
            );
            $array_data[]=$extra;
            echo "file exist<br/>";
            return json_encode($array_data);
        }
        else {
            $datae=array();
            $datae[]=array(
                'nom' => $_POST['nom'],
                'prenom' => $_POST['prenom'],
                'email' => $_POST['email'],
                'adresse' => $_POST['adress'],
                'phone' => $_POST['phone'],
            );
            echo "file not exist<br/>";
            return json_encode($datae);   
        }
    }
  
    $file_name='searched'. '.json';
      
    if(file_put_contents("$file_name", get_data())) {
        echo 'success';
    }                
    else {
        echo 'There is some error';                
    }
}
       
?>