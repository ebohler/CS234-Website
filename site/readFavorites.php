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
     
    $pdo=null;
}
?>

<header class="w3-container" style="padding:64px 16px 8px">
  <h1 class="w3-margin">VIEW FAVORITE</h1>
</header>

<body>
    <div class="w3-panel w3-round-xlarge w3-border w3-dark-gray w3-margin" style="padding:64px">
        <div class="w3-row">
            <div class="w3-col m4 l3">
                    <label><b>ID:</b></label>
                    <p><?php echo $row["id"]; ?></p>
            
                    <label><b>FAVID:</b></label>
                    <p><?php echo $row["favid"]; ?></p>

                    <label><b>Song:</b></label>
                    <p><?php echo $row["song"]; ?></p>

                    <label><b>Genre:</b></label>
                    <p><?php echo $row["genre"]; ?></p>

                <p><a href="adminFavorites.php" class="w3-button w3-white w3-border">Return</a></p>
            </div>
        </div>        
    </div>
</body>
</html>