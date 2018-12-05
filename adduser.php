<?php 
session_start();
if($_SESSION['email'] != 'admin@hireme.com'){
       header('location: login2.php');
     exit;
}
?>
<!DOCTYPE html>
<html>
    

<head>
    <title>
        HireMe
    </title>
    <link rel="stylesheet" href="adduser.css" type="text/css">
    <script type="text/javascript" src="validate.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script>
    /*global $*/
    $( "#userinfo" ).submit(function( event ) {
        event.preventDefault();
    });
    </script>
</head>

<body>
    <div class="header">
        <h1>Welcome <?php echo $email; ?></h1>
        <div class="logout"><h2><a href = "home.php">Home</a></h2></div></p>
        <div class="logout"><h2><a href = "logout.php">Sign Out</a></h2></div></p>
    </div>
    
    <div class="addition">
        <form id="userinfo" action="val2.php"  method="post">
            <fieldset id="fieldset">
                <h1>New User</h1>
                <strong>Firstname</strong>
                <br><br>
                <input id="firstname" type="text" name="firstname" size="35" required>
                <br><br>
                <strong>Lastname</strong>
                <br><br>
                <input id="lastname" type="text" name="lastname" size="35" required>
                <br><br>
                <strong>Password</strong>
                <br><br>
                <input id="password" type="password" name="password" size="35" required>
                <br><br>
                <strong>Email</strong>
                <br><br>
                <input id="email" type="email" name="email" size="35" placeholder="e.g. mary.jane@example.com" required>
                <br><br>
                <strong>Telephone</strong>
                <br><br>
                <input id ="telephone" type="tel" name="telephone" size="35" placeholder="e.g. 876-999-8969" required>
                <br><br>
                <input id="submit" type="submit" value="Submit" class="button">
            </fieldset>
        </form>
    </div>
    <div>

    </div>
</body>
</html>

