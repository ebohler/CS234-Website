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

if(isset($_POST["favid"]) && !empty($_POST["favid"])){
    
    $sql = "DELETE FROM favorites WHERE favid = :favid";
    
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(":favid", $id);
    
    $id = $_POST["favid"];
    
    if($stmt->execute()){
        header("location: adminFavorites.php");
        exit();
    } 
    else {
        echo "Error while trying to delete.";
    }
    
     
    $pdo = null;
}
?>

<header class="w3-container" style="padding:64px 16px 8px">
  <h1 class="w3-margin">DELETE FAVORITE</h1>
</header>

<body>
    <div class="w3-container">
        <div class="w3-row">
            <div class="w3-col m4 l3">
                <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
                    <div class="alert">
                        <input type="hidden" name="favid" value="<?php echo $_GET["favid"]; ?>"/>
                        <p>Are you sure you want to delete this favorite entry?</p>
                        <p>
                            <input type="submit" value="Yes" class="w3-button w3-light-green w3-border">
                            <a href="adminFavorites.php" class="w3-button w3-red w3-border">No</a>
                        </p>
                    </div>
                </form>
            </div>
        </div>        
    </div>
</body>
</html>
