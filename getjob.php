
<!DOCTYPE html>
<html>
<head>
<style>
table {
    width: 100%;
    border-collapse: collapse;
}

table, td, th {
    border: 1px solid black;
    padding: 5px;
}

th {text-align: left;}
</style>
</head>
<body>
<form id ="send" action ="ajob.php" method ="post">
<h3 style ="display:inline-block">Job Information</h3> 
<?php
$q = intval($_GET['q']);

$con = mysqli_connect('localhost','root','','HireMe');
if (!$con) {
    die('Could not connect: ' . mysqli_error($con));
}

mysqli_select_db($con,"HireMe");
$sql="SELECT * FROM Jobs WHERE id = '".$q."'";
$result = mysqli_query($con,$sql);

echo "<table>
<tr>
<th>Job Title</th>
<th>Job Description</th>
<th>Category</th>
<th>Company</th>
<th>Location</th>
<th>Date Posted</th>
</tr>";
while($row = mysqli_fetch_array($result)) {
    echo "<tr>";
    echo "<td>" . $row['job_title'] . "</td>";
    echo "<td>" . $row['job_description'] . "</td>";
    echo "<td>" . $row['category'] . "</td>";
    echo "<td>" . $row['company_name'] . "</td>";
    echo "<td>" . $row['company_location'] . "</td>";
    echo "<td>" . $row['date_posted'] . "</td>";
    echo "<input type = ". "'text'" .  "name =". "'jid'" . "value =". $row['id'] . " style = ". "'display:none'". "><br>";
    
    echo "</tr>";
}
echo "</table>";


mysqli_close($con);
?>
<br><br>
<input id="submit" type="submit" value="Apply Now" class="button">
</form>
</body>
</html>
