<?php
session_start();

include 'navbar.php';
 
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] != true) {
    header("Location: login.php");
    exit;
}
?>

<header class="w3-container w3-center" style="padding:128px 16px">
  <h1 class="w3-margin w3-jumbo">USER PAGE</h1>
  <p class="w3-xlarge">This is the User Menu page! Unfortunately you can't do anything here because you aren't an admin.</p>
</header>

</html>