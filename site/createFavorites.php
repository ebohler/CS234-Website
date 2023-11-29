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
    $song=$_POST['song'];
    $genre=$_POST['genre'];
    $id=$_POST['id'];
    $favid=$_POST['favid'];

    $sql="INSERT INTO favorites(song,genre,id,favid) VALUES(:song,:genre,:id,:favid)";
    $stmt=$pdo->prepare($sql);

    $stmt->bindParam(':song',$song);
    $stmt->bindParam(':genre',$genre);
    $stmt->bindParam(':id',$id);
    $stmt->bindParam(':favid',$favid);

    $stmt->execute();

    $pdo=null;

    header("location: adminFavorites.php");
}
?>
 
<header class="w3-container" style="padding:32px 16px 8px">
  <h1 class="w3-margin">CREATE FAVORITE</h1>
</header>

<body class="w3-panel" >
<div class="w3-panel w3-round-xlarge w3-border w3-dark-gray w3-margin" style="padding:64px">
    <main class="w3-container">
        <form action="" method="POST">

            <p>
                <label>Song Title:</label>
                <input class="w3-input w3-border w3-light-gray" type="text" name="song" placeholder="Enter song title:">
            </p>

            <p>
                <label>Genre: </label>
                <input class="w3-radio" type="radio" name='genre' value="Pop">
                <label>Pop</label>

                <input class="w3-radio" type="radio" name='genre' value="Rock">
                <label>Rock</label>

                <input class="w3-radio" type="radio" name='genre' value="Rap">
                <label>Rap</label>
            </p>

            <p>
                <label>User ID:</label>
                <input class="w3-input w3-border w3-light-gray" type="text" name="id" placeholder="Must be an existing User ID!">
            </p>

            <p>
                <label>Favorite ID:</label>
                <input class="w3-input w3-border w3-light-gray" type="text" name="favid" placeholder="FAVID">
            </p>

            <button class="w3-button w3-green w3-block w3-round">Submit</button>
            <p><a href="adminFavorites.php" class="w3-button w3-white w3-border">Return</a></p>
        </form>
    </main>
</div>
</body>
</html>