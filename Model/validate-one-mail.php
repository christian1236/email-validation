<?php
/*
 * This function checks an email is really exists or not by performing 3 tests
     
 * DESCRIPTION 
    * Basic check for email format using reqular expression
    * mxrecord check to validate whether user's domain handles emails
    * incase given email passes above tests then it sends a smtp query with
      given email to verify whether it really exists or not    

 **/


//On démarre une nouvelle session
session_start();



function isValidEmail($email){
   // Include config file
 require_once "config.php";
   $result=false;
   
   
   $dateVerif = date("l jS \of F Y h:i:s A");

   # BASIC CHECK FOR EMAIL PATTERN WITH REGULAR EXPRESSION
   if(!preg_match('/^[_A-z0-9-]+((\.|\+)[_A-z0-9-]+)*@[A-z0-9-]+(\.[A-z0-9-]+)*(\.[A-z]{2,4})$/',$email))
	   return $result;

   # MX RECORD CHECK
	 list($name, $domain)=explode('@',$email);
	
   if(!checkdnsrr($domain,'MX')){
    return $result;
   }
	  
	
   # SMTP QUERY CHECK
   $max_conn_time = 15;
   $sock='';
   $port = 25;
   $max_read_time = 5;
   $users=$name;
   
   # retrieve SMTP Server via MX query on domain
   $hosts = array();
   $mxweights = array();
   getmxrr($domain, $hosts, $mxweights);
   $mxs = array_combine($hosts, $mxweights);
   asort($mxs, SORT_NUMERIC);
   
   #last fallback is the original domain
   $mxs[$domain] = 100;
   $timeout = $max_conn_time / count($mxs);
   
   # try each host
   while(list($host) = each($mxs)) {
    #connect to SMTP server
    if($sock = fsockopen($host, $port, $errno, $errstr, (float) $timeout)){
      stream_set_timeout($sock, $max_read_time);
      break;
    }
   } 
   
   # did we get a TCP socket
   if($sock) {
      $reply = fread($sock, 2082);
      preg_match('/^([0-9]{3}) /ims', $reply, $matches);
      $code = isset($matches[1]) ? $matches[1] : '';
      
      if($code != '220') {
        # MTA gave an error...
        return $result;
      }

      # initiate smtp conversation
      $msg="HELO ".$domain;
      fwrite($sock, $msg."\r\n");
      $reply = fread($sock, 2082);
      
      # tell of sender
      $msg="MAIL FROM: <".$name.'@'.$domain.">";
      fwrite($sock, $msg."\r\n");
      $reply = fread($sock, 2082);
      
             
      #ask of recepient
      $msg="RCPT TO: <".$name.'@'.$domain.">";
      fwrite($sock, $msg."\r\n");
      $reply = fread($sock, 2082);
        
      #get code and msg from response
      preg_match('/^([0-9]{3}) /ims', $reply, $matches);
      $code = isset($matches[1]) ? $matches[1] : '';

      if($code == '250') {
        #you received 250 so the email address was accepted
        $statut="valide";
        $result=true;
      }elseif($code == '451' || $code == '452') {
        #you received 451 so the email address was greylisted
        #_(or some temporary error occured on the MTA) - so assume is ok
        $statut="valide";
        $result=true;
      }else{
        
        $statut="non valide";
        $result=false;
        $_SESSION['email'] = $email;
        $_SESSION['domaine'] = $domain;
        $_SESSION['code'] = $code;
        $_SESSION['statut'] = $statut;
        $_SESSION['date'] = $dateVerif;
      }

      

      // Prepare an insert statement
      $sql = "INSERT INTO emails (email, fichierSource, domaine, codeRetour, statut, dateVerif) VALUES (?, ?, ?, ?, ?, ?)";
         
      if($stmt = mysqli_prepare($link, $sql)){
          // Bind variables to the prepared statement as parameters
          mysqli_stmt_bind_param($stmt, "ssssss", $param_email, $param_fichier, $param_domaine, $param_code, $param_statut, $param_date);
          
          // Set parameters
          $param_email = $email;
          $param_fichier = "LONELY";
          $param_domaine = $domain;
          $param_code = $code;
          $param_statut = $statut;  
          $param_date = $dateVerif;
          // Attempt to execute the prepared statement
          if(mysqli_stmt_execute($stmt)){
              // Records created successfully. Redirect to landing page
              //On définit des variables de session
              $_SESSION['email'] = $email;
              $_SESSION['domaine'] = $domain;
              $_SESSION['code'] = $code;
              $_SESSION['statut'] = $statut;
              $_SESSION['date'] = $dateVerif;
              header("location: ../View/home.php");
              exit();
          } else{
              echo "Oops! Something went wrong. Please try again later.";
          }
      }


      // Close statement
      mysqli_stmt_close($stmt);
      // Close connection
      mysqli_close($link);

      #quit smtp connection
      $msg="quit";
      fwrite($sock, $msg."\r\n");
      
      # close socket
      fclose($sock);

   }
  
   return $result;

	 
}

$email = $_POST['email'];
  
  if(isValidEmail($email))
    header("location: ../View/home.php");
  else
    header("location: ../View/home.php");


  




?>
