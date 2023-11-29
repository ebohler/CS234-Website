<?php
session_start();

include 'navbar.php';
 
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] != true) {
    header("Location: login.php");
    exit;
}

if($_SESSION["username"] == "admin") {
  header("Location: adminRegistration.php");
  exit;
}

header("Location: usermenu.php");
?>

<header class="w3-container w3-center" style="padding:128px 16px">
  <h1 class="w3-margin w3-jumbo">MENU PAGE</h1>
  <p class="w3-xlarge">This is the Menu redirect page. If you are seeing this then something has gone wrong.</p>
</header>

</html>