<?php
   include('config.php');
   session_start();
   $email_check = $_SESSION['email'];
   
   $ses_sql = mysqli_query($db,"select email from Users where email = '$email_check' ");
   
   
   $row = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);
 
   $login_session = $row['email'];
  
   if(!isset($_SESSION['email'])){
      header("location:login2.php");
   }
?>