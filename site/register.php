<?php
$userStatus = "";
$pwdEntered = "";
$pwdHashed = "";

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
    <title>Registration</title>
</head>
<body>
   <div class="w3-panel w3-green center">
       <h1> Register </h1>
       <span>Already have an account? <a class="w3-text-white" href="login.php">Log in</a></span>
   </div>
    <form class="w3-container w3-card-4 w3-light-grey w3-padding-16 center" action ="DBregister.php" method="POST" >
        <label for="user">Username:</label>
        <input class="w3-input w3-border" type="text" id="user" name="username">
        <br>
        <label for="pass">Password:</label>
        <input class="w3-input w3-border" type="password" id="pass" name="password">
        <ul>
            <li> Must be between 7-12 characters </li>
            <li> Must contain a capital letter </li>
        </ul>
        <input class="w3-button w3-round w3-green" type="submit" value="Submit">
    </form>
</body>
</html>