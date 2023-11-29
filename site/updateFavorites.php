<?php
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

if(isset($_GET["favid"]) && !empty($_GET["favid"])) {
    $sql = "SELECT * FROM favorites WHERE favid = :favid";
    
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(":favid", $identifier);
    
    $identifier = $_GET["favid"];
    
    if($stmt->execute()) {
        if($stmt->rowCount() == 1) {
            $row = $stmt->fetch();
            
            $song = $row["song"];
            $genre = $row["genre"];
            $id = $row["id"];
            $favid = $row["favid"];
        } 
    } 
    else {
        echo "Error while retrieving data.";
    }
}

if($_SERVER["REQUEST_METHOD"]=="POST"){
    $song=$_POST['song'];
    $genre=$_POST['genre'];
    $id=$_POST['id'];
    $newfavid=$_POST["favid"];

    $sql = "UPDATE favorites SET song=:song, genre = :genre, id = :id, favid = :newfavid WHERE favid = :favid";
    $stmt=$pdo->prepare($sql);

    $stmt->bindParam(':song',$song);
    $stmt->bindParam(':genre',$genre);
    $stmt->bindParam(':id',$id);
    $stmt->bindParam(':favid',$favid);
    $stmt->bindParam(':newfavid',$newfavid);

    $stmt->execute();

    $pdo=null;

    header("location: adminFavorites.php");
}

?>

<header class="w3-container" style="padding:64px 16px 0px">
  <h1 class="w3-margin">EDIT FAVORITE</h1>
</header>

<body>
    <div class="w3-panel w3-round-xlarge w3-border w3-dark-gray w3-margin" style="padding:64px">
        <main class="w3-container">
            <form action="" method="POST">
                <p>
                    <label>Song Title:</label>
                    <input class="w3-input w3-border w3-light-gray" type="text" name="song" value="<?php echo $row["song"]; ?>" placeholder="Enter song title:">
                </p>

                <p>
                    <label>Genre: </label>
                    <input class="w3-radio" type="radio" name='genre' value="Pop" <?php if($row["genre"] == "Pop") {echo 'checked="checked"';} ?>>
                    <label>Pop</label>

                    <input class="w3-radio" type="radio" name='genre' value="Rock" <?php if($row["genre"] == "Rock") {echo 'checked="checked"';} ?>>
                    <label>Rock</label>

                    <input class="w3-radio" type="radio" name='genre' value="Rap" <?php if($row["genre"] == "Rap") {echo 'checked="checked"';} ?>>
                    <label>Rap</label>
                </p>

                <p>
                    <label>User ID:</label>
                    <input class="w3-input w3-border w3-light-gray" type="text" name="id" value="<?php echo $row["id"]; ?>" placeholder="Must be an existing User ID!">
                </p>

                <p>
                    <label>Favorite ID:</label>
                    <input class="w3-input w3-border w3-light-gray" type="text" name="favid" value="<?php echo $row["favid"]; ?>" placeholder="FAVID">
                </p>

                <button class="w3-button w3-green w3-block w3-round">Submit</button>
                <p><a href="adminFavorites.php" class="w3-button w3-white w3-border">Return</a></p>
            </form>
        </main>
    </div>
</body>
</html>