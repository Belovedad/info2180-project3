<?php
   include("config.php");
   session_start();
   $error='';
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // email and password sent from form 
      
      $myemail = mysqli_real_escape_string($db,$_POST['email']);
      $mypassword = mysqli_real_escape_string($db,$_POST['password']);
      
      $t1 = "Select password_digest from Users where password_digest = '$mypassword'";
      $t2 = mysqli_query($db,$t1);
      if(mysqli_num_rows($t2)>0){
         $_SESSION['email'] = $myemail;
         header("location: adduser.php");
         
      }
      
	   $pql = "Select salt FROM Users WHERE email = '$myemail'";
	   $r1 = mysqli_query($db,$pql);
	  
	    $cpass = '';
   	  $i = 0; // init counter
   	  while ($row = mysqli_fetch_array($r1)) {
   	      $cpass .= $row[$i];
   	  }
   	  $cdpass = md5($cpass.$mypassword);
   	  $sql = "SELECT id FROM Users WHERE email = '$myemail' and password_digest = '$cdpass'";
   	  $result = mysqli_query($db,$sql);
   	  $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
   	  $count = mysqli_num_rows($result);
   	  $wcount = 0;
      
      // If result matched $myusername and $cdpass, table row must be 1 row
      if($count == 1) {
          $_SESSION['email'] = $myemail;
          header("location: home.php");
		  
      }
      else {
          $error = "Your Email or Password is invalid";
          
		    
          
      }
	      
       
   }
   
?>
<html>
   
   <head>
      <title>Login Page</title>
      
      <style type = "text/css">
         body {
            font-family:Arial, Helvetica, sans-serif;
            font-size:14px;
         }
         
         label {
            font-weight:bold;
            width:100px;
            font-size:14px;
         }
         
         .box {
            border:#666666 solid 1px;
         }
      </style>
      
   </head>
   
   <body bgcolor = "#FFFFFF">
	
      <div align = "center">
         <div style = "width:350px; border: solid 1px #333333; " align = "left">
            <div style = "background-color:#333333; color:#FFFFFF; padding:3px;"><b>Login</b></div>
				
            <div style = "margin:30px">
               
               <form action = "" method = "post">
                  <label>Email </label>
                  <br><br>
                  <input type = "text" name = "email" size="35" class = "box"/><br /><br />
                  <label>Password  </label>
                  <br><br>
                  <input type = "password" name = "password" size="35" class = "box" /><br/><br />
                  <input type = "submit" value = " Submit "/><br />
               </form>
               
               <div style = "font-size:11px; color:#cc0000; margin-top:10px"><?php echo $error; ?></div>
					
            </div>
				
         </div>
			
      </div>

   </body>
</html>