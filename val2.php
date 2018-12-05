<?php
if(isset($_POST['email'])) {
 
    function died($error) {
        // your error code can go here
        echo "We are very sorry, but there were error(s) found with the form you submitted. ";
        echo "These errors appear below.<br /><br />";
        echo $error."<br /><br />";
        echo "Please go back and fix these errors.<br /><br />";
        die();
    }
 
    // validation expected data exists
    if(!isset($_POST['firstname']) ||
        !isset($_POST['lastname']) ||
        !isset($_POST['email']) ||
        !isset($_POST['telephone']) ||
		    !isset($_POST['password'])) {
        died('We are sorry, but there appears to be a problem with the form you submitted.');       
    }
 
     
 
    $firstname = $_POST['firstname']; // required
    $lastname = $_POST['lastname']; // required
    $email = $_POST['email']; // required
    $telephone = $_POST['telephone']; // required
	  $password = $_POST['password']; // required
	  
	  $email = filter_var($email, FILTER_SANITIZE_EMAIL);
	  $firstname = filter_var($firstname, FILTER_SANITIZE_STRING);
	  $lastname = filter_var($lastname, FILTER_SANITIZE_STRING);

 
    $error_message = "";
    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
 
  if(!preg_match($email_exp,$email)) {
    $error_message .= 'The Email Address you entered does not appear to be valid.<br />';
  }
 
    $string_exp = "/^[a-zA-Z ]*$/s";
 
  if(!preg_match($string_exp,$firstname)) {
    $error_message .= 'The First Name you entered does not appear to be valid.<br />';
  }
 
  if(!preg_match($string_exp,$lastname)) {
    $error_message .= 'The Last Name you entered does not appear to be valid.<br />';
  }
  
  $password_exp = "/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(.{8,64})$/";
  if(!preg_match($password_exp,$password)){
    $error_message .= 'The password you entered does not appear to be valid. <br />';
  }
 
  if(strlen($error_message) > 0) {
    died($error_message);
  }
  $salt = mt_rand();
  $digest = md5($salt.$password);
  
$host ="localhost";
$usernamed = "root";
$passwordd = "";
$database = "HireMe";


$conn = new mysqli($host,$usernamed,$passwordd,$database);

if ($conn->connect_error){
	die("Connection failed: " . $conn->connect_error);
}
$sql = "INSERT INTO Users (firstname, lastname, email, telephone,password_digest,salt)
VALUES ('$firstname', '$lastname', '$email', '$telephone','$digest','$salt')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
$conn->close();
header("Location: adduser.php");

		
?>
 
<?php
 
}
?>