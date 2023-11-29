<?php
session_start();
 
if(isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] == true) {
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css"> 
<link rel="stylesheet" href="styles.css"> 
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
   <div class="w3-panel w3-green center">
       <h1> Log in </h1>
       <span>Don't have an account yet? <a class="w3-text-white" href="register.php">Register</a></span>
   </div>
   <form class="w3-container w3-card-4 w3-light-grey w3-padding-16 center" action="DBlogin.php" method='post'>
        <label for ="username"> Username: </label>
        <input class="w3-input w3-border" type='text' name="username" id="username">
        <br>
        <label for ="password"> Password: </label>
        <input class="w3-input w3-border" type='password' name="password" id="password">
        <br>
        <input class="w3-button w3-round w3-green" type="submit" value ="Submit">
    </form>
</body>
</html>