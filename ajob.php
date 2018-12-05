<?php
session_start();
include('session.php');




$jid = $_POST['jid'];
$ema = $_SESSION['email'];



$con = mysqli_connect('localhost','root','','HireMe');
if (!$con) {
    die('Could not connect: ' . mysqli_error($con));
}

mysqli_select_db($con,"HireMe");
$hold = "SELECT id FROM Users WHERE email = '$ema'";
if($result = mysqli_query($con,$hold));{
    while ($row = $result->fetch_assoc()) {
        $uid = $row['id'];
    }
}

$_SESSION["usid"] = $uid;


$sql = "INSERT INTO Jobs_Applied_For (job_id, user_id, date_applied)
VALUES ('$jid', '$uid', NOW())";


if ($con->query($sql) === TRUE) {
    echo "New Job applied for successfully";
    
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
$con->close();
header("location:home.php")

		
?>

