<?php
if(isset($_POST['newjob'])) {
 
    function died($error) {
        // your error code can go here
        echo "We are very sorry, but there were error(s) found with the form you submitted. ";
        echo "These errors appear below.<br /><br />";
        echo $error."<br /><br />";
        echo "Please go back and fix these errors.<br /><br />";
        die();
    }
 
    // validation expected data exists
    if(!isset($_POST['newjob']) ||
        !isset($_POST['desc']) ||
        !isset($_POST['cname']) ||
        !isset($_POST['loc'])){
        died('We are sorry, but there appears to be a problem with the form you submitted.');       
    }
 
     
 
    $newjob = $_POST['newjob']; // required
    $desc = $_POST['desc']; // required
	$jobf = $_POST['jfield']; // required
	$cname= $_POST['cname'];
    $loc = $_POST['loc']; // required
  
    $newjob = filter_var($newjob, FILTER_SANITIZE_STRING);
    $desc = filter_var($desc, FILTER_SANITIZE_STRING);
    $cname = filter_var($cname, FILTER_SANITIZE_STRING);
    $loc = filter_var($loc, FILTER_SANITIZE_STRING);
    $error_message = "";
 
  
 
    $string_exp = "/^[a-zA-Z ]*$/s";
 
  if(!preg_match($string_exp,$newjob)) {
    $error_message .= 'Enter a valid Job.<br />';
  }
 
  if(!preg_match($string_exp,$loc)) {
    $error_message .= 'Enter a valid location.<br />';
  }
   if(!preg_match($string_exp,$desc)) {
    $error_message .= 'Enter a valid description.<br />';
  }
  if(!preg_match($string_exp,$cname)) {
    $error_message .= 'Enter a valid company name.<br />';
  }
  
  
  if(strlen($error_message) > 0) {
    died($error_message);
  }
  
$host ="localhost";
$usernamed = "root";
$passwordd = "";
$database = "HireMe";


$conn = new mysqli($host,$usernamed,$passwordd,$database);

if ($conn->connect_error){
	die("Connection failed: " . $conn->connect_error);
}
$sql = "INSERT INTO Jobs (job_title, job_description, category, company_name,company_location,date_posted)
VALUES ('$newjob', '$desc', '$jobf', '$cname','$loc',NOW())";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
$conn->close();
header("Location: home.php");
		
?>

 
<?php
 
}
?>