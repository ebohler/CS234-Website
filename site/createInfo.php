<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

session_start();

include 'navbar.php';
require_once "sqlConfig.php";
 
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] != true) {
    header("Location: login.php");
    exit;
}

if($_SESSION["username"] != "admin") {
  header("Location: usermenu.php");
  exit;
}

if($_SERVER["REQUEST_METHOD"]=="POST"){
    $weather=$_POST['weather'];
    $state=$_POST['state'];
    $id=$_POST['id'];
    $infoid=$_POST['infoid'];

    $sql="INSERT INTO info(weather,state,id,infoid) VALUES(:weather,:state,:id,:infoid)";
    $stmt=$pdo->prepare($sql);

    $stmt->bindParam(':weather',$weather);
    $stmt->bindParam(':state',$state);
    $stmt->bindParam(':id',$id);
    $stmt->bindParam(':infoid',$infoid);

    $stmt->execute();

    $pdo=null;

    header("location: adminInfo.php");
}
?>
 
<header class="w3-container" style="padding:32px 16px 8px">
  <h1 class="w3-margin">CREATE INFO</h1>
</header>

<body class="w3-panel" >
<div class="w3-panel w3-round-xlarge w3-border w3-brown w3-margin" style="padding:64px">
    <main class="w3-container">
        <form action="" method="POST">
            <p>
                <label>Weather: </label>
                <input class="w3-radio" type="radio" name='weather' value="Sunny">
                <label>Sunny</label>

                <input class="w3-radio" type="radio" name='weather' value="Cloudy">
                <label>Cloudy</label>
            </p>

            <p>
                <label>State: </label>
                <select class="w3-input" name="state">
                    <option selected disabled>Select state</option>
                    <option value="IL">Illinois</option>
                    <option value="MO">Missouri</option>
                    <option value="AZ">Arizona</option>
                    <option value="AR">Arkansas</option>
                    <option value="CA">California</option>
                </select>
            </p>

            <p>
                <label>User ID:</label>
                <input class="w3-input w3-border w3-light-gray" type="text" name="id" placeholder="Must be an existing User ID">
            </p>

            <p>
                <label>Info ID:</label>
                <input class="w3-input w3-border w3-light-gray" type="text" name="infoid" placeholder="INFOID">
            </p>

            <button class="w3-button w3-green w3-block w3-round">Submit</button>
            <p><a href="adminInfo.php" class="w3-button w3-white w3-border">Return</a></p>
        </form>
    </main>
</div>
</body>
</html>