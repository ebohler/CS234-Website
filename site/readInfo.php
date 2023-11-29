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

if(isset($_GET["infoid"]) && !empty($_GET["infoid"])) {
    
    $sql = "SELECT * FROM info WHERE infoid = :infoid";
    
    if($stmt = $pdo->prepare($sql)){
        $stmt->bindParam(":infoid", $identifier);
        
        $identifier = $_GET["infoid"];
        
        if($stmt->execute()){
            if($stmt->rowCount() == 1){
                $row = $stmt->fetch();
                
                $weather = $row["weather"];
                $state = $row["state"];
                $id = $row["id"];
                $infoid = $row["infoid"];
            } 
        } 
        else {
            echo "Error while retrieving data.";
        }
    }
     
    $pdo=null;
}
?>

<header class="w3-container" style="padding:64px 16px 8px">
  <h1 class="w3-margin">VIEW INFO</h1>
</header>

<body>
    <div class="w3-panel w3-round-xlarge w3-border w3-brown w3-margin" style="padding:64px">
        <div class="w3-row">
            <div class="w3-col m4 l3">
                    <label><b>ID:</b></label>
                    <p><?php echo $row["id"]; ?></p>
            
                    <label><b>INFOID:</b></label>
                    <p><?php echo $row["infoid"]; ?></p>

                    <label><b>Weather:</b></label>
                    <p><?php echo $row["weather"]; ?></p>

                    <label><b>State:</b></label>
                    <p><?php echo $row["state"]; ?></p>

                <p><a href="adminInfo.php" class="w3-button w3-white w3-border">Return</a></p>
            </div>
        </div>        
    </div>
</body>
</html>