<?php
 session_start();
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>HireMe</title>
<link href="styles.css" rel="stylesheet" type="text/css">
<link href="home.css" rel="stylesheet" type="text/css">
<script src="jquery-3.3.1.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js" type="text/javascript"></script>
<script type = "text/Javascript">
  function jax(div_id) {
    document.getElementById("Dashboard").innerHTML=document.getElementById(div_id).innerHTML;
    
  }
  
  function swapContent (id) {
    const main = document.getElementById('Dashboard');
    const div = document.getElementById(id);
    const clone = div.cloneNode(true);

    while (main.firstChild) main.firstChild.remove();
    main.appendChild(clone);
}

function showJob(str) {
    if (str == "") {
        document.getElementById("Dashboard").innerHTML = "";
        return;
    } else { 
        if (window.XMLHttpRequest) {
           
           var xmlhttp = new XMLHttpRequest();
        } 
      
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("Dashboard").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET","getjob.php?q="+str,true);
        xmlhttp.send();
    }
}


</script>

</head>

<body>
<div class="eryting">
  <div class = "grid">
    <div class = "header">
      <div class = "hitem">
        <h1>HireMe</h1>
      </div>
    </div>
    <div class = "sidebar">
      <div class ="socialmedia">
        <img src="home.png"></img>
        <p onclick = "swapContent('main')">&#9 Home</p>
        <img src="adduser.png"></img>
        <p><a href ="adduser.php">&#9 Add User</a></p>
        <img src="newjob.png"                                                                                                                                                                                                                                      ></img>
        <p onclick ="swapContent('form')">&#9 New Job</p>
        <img src="logout.png"></img>
        <p> <a href="logout.php">&#9 Logout</a></p>
      </div>
    </div>
    
    <div id= "Dashboard">
      <h2>Dashboard</h2>
      <h3>Recent Jobs(Less than 24 Hours)</h3>
      <?php
      include('config.php');
      $table = "";
      $sql = "SELECT * FROM Jobs WHERE date_posted >= NOW() - INTERVAL 1 DAY";
       if ($result = mysqli_query($db,$sql)); {
           // create the table header row
           $fieldsInfo = $result->fetch_fields();
           $table .= "<table border='1'><tr><th>Company</th>
            <th>Job Title</th>
            <th>Category</th>
            <th>Date</th>
          
          </tr>";
           
           while ($row = $result->fetch_assoc()) {
               $table .= "<tr>";
               $table .= "<td>" . $row['company_name'] . "</td>";
               $table .= "<td onclick=showJob(" . $row['id'] . ")>" . $row['job_title'] . "</td>";
               $table .= "<td>" . $row['category'] . "</td>";
               $table .= "<td>" . $row['date_posted'] . "</td>";
               
               
               
               $table .= "</tr>";
               
              }
           $table .= "</table>";
            }
          
      ?>
      <?php echo $table ?>
      <br/>
      <h3>Older Jobs</h3>
      <?php
      include('config.php');
      $table2 = "";
      $sql = "SELECT * FROM Jobs WHERE date_posted <= NOW() + INTERVAL 1 DAY";
       if ($result = mysqli_query($db,$sql)); {
           // create the table header row
           $fieldsInfo = $result->fetch_fields();
           $table2 .= "<table border='1'><tr><th>Company</th>
            <th>Job Title</th>
            <th>Category</th>
            <th>Date</th>
          
          </tr>";
           
           while ($row = $result->fetch_assoc()) {
               $table2 .= "<tr>";
               $table2 .= "<td>" . $row['company_name'] . "</td>";
               $table2 .= "<td onclick=showJob(" . $row['id'] . ")>" . $row['job_title'] . "</td>";
               $table2 .= "<td>" . $row['category'] . "</td>";
               $table2 .= "<td>" . $row['date_posted'] . "</td>";
               
               
               
               $table2 .= "</tr>";
               
              }
           $table2 .= "</table>";
            }
          
      ?>
      <?php echo $table2 ?>
      <br/>
      
        <h3>Jobs Applied For</h3>
      <?php
      include('config.php');
      $ema = $_SESSION['email'];
      $hold = "SELECT id FROM Users WHERE email = '$ema'";
      if($result = mysqli_query($db,$hold));{
       while ($row = $result->fetch_assoc()) {
        $uid = $row['id'];
        }
       
      }
      $table3 = "";
      $sql = "SELECT * FROM Jobs_Applied_For where user_id = '$uid'";
       if ($result = mysqli_query($db,$sql)); {
           // create the table header row
           $fieldsInfo = $result->fetch_fields();
           $table3 .= "<table border='1'><tr><th>Job ID</th>
            <th>User ID</th>
            <th>Date Applied</th>
          
          </tr>";
           
           while ($row = $result->fetch_assoc()) {
               $table3 .= "<tr>";
               $table3 .= "<td>" . $row['job_id'] . "</td>";
               $table3 .= "<td>". $row['user_id'] . "</td>";
               $table3 .= "<td>" . $row['date_applied'] . "</td>";
               
               
               
               $table3 .= "</tr>";
               
              }
           $table3 .= "</table>";
            }
          
      ?>
      <?php echo $table3 ?>
    
    </div>
  <div id = "others" style ="display:none">
    <div id = "form" >
    <h2>New Job</h2>
    <form name= "jobform" id="jobform"  method="POST" action="valjob.php">
    <fieldset id="newfield">
    <p>* required field.</p>
    <label>Job Title<br/> <br><input  class="" type="text" size="35" name="newjob"/> *<br/> </label>
    <br>
    <label>Job Description<br/><br><textarea name ="desc" cols= "36" rows= "5" style="border-radius:5px;"></textarea>
    *<br/> </label>
    <br>
    <label>Category <br/> <br> <select name = "jfield" id="jselect">
  	<option value ="design" >Design</option>
  	<option value ="programming">Programming</option>
  	<option value ="devops">DevOps and SysAdmin</option>
  	<option value ="support">Customer Support</option>
  	<option value ="sales">Sales and Marketing</option>
    </select> *<br/> </label><br>
    <label>Company <br/> <br>  <input  class="" type="text" size="35" name="cname"/> *<br/>  </label>
    <br>
  	<label>Job Location: <br/> <br> <input  class="" type="text" size="35" name="loc"/> *<br/>  </label>
  	<br/>
  	
  	<input type="submit" value="Submit"/>
  	</fieldset>
  	</form>
  	</div>
    <div id ="main" >
      <h2>Dashboard</h2>
      <h3>Recent Jobs(Less than 24 Hours)</h3>
      <?php
      include('config.php');
      $table = "";
      $sql = "SELECT * FROM Jobs WHERE date_posted >= NOW() - INTERVAL 1 DAY";
       if ($result = mysqli_query($db,$sql)); {
           // create the table header row
           $fieldsInfo = $result->fetch_fields();
           $table .= "<table border='1'><tr><th>Company</th>
            <th>Job Title</th>
            <th>Category</th>
            <th>Date</th>
          
          </tr>";
           
           while ($row = $result->fetch_assoc()) {
               $table .= "<tr>";
               $table .= "<td>" . $row['company_name'] . "</td>";
               $table .= "<td onclick=showJob(" . $row['id'] . ")>" . $row['job_title'] . "</td>";
               $table .= "<td>" . $row['category'] . "</td>";
               $table .= "<td>" . $row['date_posted'] . "</td>";
               
               
               
               $table .= "</tr>";
               
              }
           $table .= "</table>";
            }
          
      ?>
      <?php echo $table ?>
      <br/>
      <h3>Older Jobs</h3>
      <?php
      include('config.php');
      $table2 = "";
      $sql = "SELECT * FROM Jobs WHERE date_posted <= NOW() + INTERVAL 1 DAY";
       if ($result = mysqli_query($db,$sql)); {
           // create the table header row
           $fieldsInfo = $result->fetch_fields();
           $table2 .= "<table border='1'><tr><th>Company</th>
            <th>Job Title</th>
            <th>Category</th>
            <th>Date</th>
          
          </tr>";
           
           while ($row = $result->fetch_assoc()) {
               $table2 .= "<tr>";
               $table2 .= "<td>" . $row['company_name'] . "</td>";
               $table2 .= "<td onclick=showJob(" . $row['id'] . ")>" . $row['job_title'] . "</td>";
               $table2 .= "<td>" . $row['category'] . "</td>";
               $table2 .= "<td>" . $row['date_posted'] . "</td>";
               
               
               
               $table2 .= "</tr>";
               
              }
           $table2 .= "</table>";
            }
          
      ?>
      <?php echo $table2 ?>
      <br/>
      
        <h3>Jobs Applied For</h3>
                 <?php
      include('config.php');
      $ema = $_SESSION['email'];
      $hold = "SELECT id FROM Users WHERE email = '$ema'";
      if($result = mysqli_query($db,$hold));{
       while ($row = $result->fetch_assoc()) {
        $uid = $row['id'];
        }
       
      }
      $table3 = "";
      $sql = "SELECT * FROM Jobs_Applied_For where user_id = '$uid'";
       if ($result = mysqli_query($db,$sql)); {
           // create the table header row
           $fieldsInfo = $result->fetch_fields();
           $table3 .= "<table border='1'><tr><th>Job ID</th>
            <th>User ID</th>
            <th>Date Applied</th>
          
          </tr>";
           
           while ($row = $result->fetch_assoc()) {
               $table3 .= "<tr>";
               $table3 .= "<td>" . $row['job_id'] . "</td>";
               $table3 .= "<td>". $row['user_id'] . "</td>";
               $table3 .= "<td>" . $row['date_applied'] . "</td>";
               
               
               
               $table3 .= "</tr>";
               
              }
           $table3 .= "</table>";
            }
          
      ?>
      <?php echo $table3 ?>
      
    </div>
    
  </div>
  </div>
</div>
</body>
</html>
