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

if(isset($_GET["id"]) && !empty($_GET["id"])){
    
    $sql = "SELECT * FROM registration WHERE id = :id";
    
    if($stmt = $pdo->prepare($sql)){
        $stmt->bindParam(":id", $identifier);
        
        $identifier = $_GET["id"];
        
        if($stmt->execute()){
            if($stmt->rowCount() == 1){
                $row = $stmt->fetch();
                
                $username = $row["username"];
                $password = $row["password"];
                $id = $row["id"];
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
  <h1 class="w3-margin">VIEW ACCOUNT</h1>
</header>

<body>
    <div class="wrapper">
        <div class="w3-panel w3-round-xlarge w3-border w3-blue-gray w3-margin" style="padding:64px">
            <div class="w3-row">
                <div class="w3-col m4 l3">
                        <label><b>ID:</b></label>
                        <p><?php echo $row["id"]; ?></p>
                
                        <label><b>Username:</b></label>
                        <p><?php echo $row["username"]; ?></p>

                        <label><b>Password:</b></label>
                        <p><?php echo $row["password"]; ?></p>

                    <p><a href="adminRegistration.php" class="w3-button w3-white w3-border">Return</a></p>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>