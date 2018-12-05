<?php
$fname = $lname = $password = $email = $tele = "";
$fnameE = $lnameE = $passwordE = $emailE = $teleE ="";

if($_SERVER["REQUEST_METHOD"] == "POST"){
     if(empty($_POST["firstName"])){
        $fnameE = "First Name is required";
    }else{
        $fname = sec($_POST["firstName"]);
        if (!preg_match("/^[a-zA-Z ]*$/",$firstName)){
            $fnameE = "Only letters and White spaces are allowed";
        }
    }
if(empty($_POST["lastName"])){
        $lnameE = "Last Name is required";
    }else{
        $lname = secf($_POST["lastName"]);
        if (!preg_match("/^[a-zA-Z ]*$/",$lastname)){
            $lnameErr = "Only letters and White spaces are allowed";
        }
    } 
if(empty($_POST["email"])){
        $emailE = "Email is required";
    }else{
        if(!filter_var($email,FILTER_VALIDATE_EMAIL))
            $emailE = "Invalid Email";
        }
    }

if(empty($_POST["password"])){
        $passwordE = "Password is required";
    }else{
        $password= secf($_POST["password"]);
        if (!preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[$@$!%*?&])[A-Za-z\d$@$!%*?&]{8,}/",$password)){
            $passErr = "Invalid password";
        }
    }
if (empty($_POST["telephone"])){
        $teleE = "Telephone number is required";
    }else{
        $tele = secf($_POST["telephone"]);
        if(!preg_match("/^[1-9][0-9]{11}$/",$tele)){
            $teleE = "Invalid Number";
        }
    }

    
function secf($info) {
  $info = trim($info);
  $info = stripslashes($info);
  $info = htmlspecialchars($info);
  return $info;
}
?>