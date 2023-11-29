<?php
session_start();

include 'navbar.php';
 
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] != true) {
    header("Location: login.php");
    exit;
}
?>

<header class="w3-container w3-center" style="padding:128px 0px 64px 0px">
  <h1 class="w3-margin w3-jumbo">HOME PAGE</h1>
  <p class="w3-xlarge">Hello, <?php echo $_SESSION["username"]; ?>.</p>
</header>


<div class="w3-container w3-card-4 w3-light-grey center" action="DBlogin.php" method='post'>
  <div class="w3-bar">
    <a href="favorites.php" class="w3-bar-item w3-button w3-green w3-border" style="width:50%">Add New Favorite Song</a>
    <a href="info.php" class="w3-bar-item w3-button w3-green w3-border" style="width:50%">Add New Weather Info</a>
  </div>
</div>

</html>