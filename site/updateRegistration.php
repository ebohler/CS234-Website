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

if(isset($_GET["id"]) && !empty($_GET["id"])) {
    $sql = "SELECT * FROM registration WHERE id = :id";
    
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(":id", $identifier);
    
    $identifier = $_GET["id"];
    
    if($stmt->execute()) {
        if($stmt->rowCount() == 1) {
            $row = $stmt->fetch();
            
            $username = $row["username"];
            $password = $row["password"];
            $id = $row["id"];
        } 
    } 
    else {
        echo "<br><br><br>Error while retrieving data.";
        echo '<a href="adminRegistration.php" class="w3-button w3-red w3-round w3-border">Return</a>';
        exit();
    }
}

if($_SERVER["REQUEST_METHOD"]=="POST"){
    $username=$_POST['username'];
    $password=$_POST['password'];
    $id=$row['id'];
    $newid=$_POST["id"];

    if(!isset($_POST['password']) || empty($_POST['password'])) {
        $sql = "UPDATE registration SET username=:username, id = :newid WHERE id = :id";
        $stmt=$pdo->prepare($sql);
        
        $stmt->bindParam(':username',$username);
        $stmt->bindParam(':id',$id);
        $stmt->bindParam(':newid',$newid);
        
        $stmt->execute();

        $pdo=null;

        header("location: adminRegistration.php");
    }
    else {
        $sql = "UPDATE registration SET username=:username, password = :password, id = :newid WHERE id = :id";
        $stmt=$pdo->prepare($sql);
        
        $pwdHashed=password_hash($password,PASSWORD_BCRYPT);
        
        $stmt->bindParam(':username',$username);
        $stmt->bindParam(':password',$pwdHashed);
        $stmt->bindParam(':id',$id);
        $stmt->bindParam(':newid',$newid);
        
        $stmt->execute();

        $pdo=null;

        header("location: adminRegistration.php");
    }

    $pdo=null;
}

?>

<header class="w3-container" style="padding:64px 16px 0px">
  <h1 class="w3-margin">EDIT ACCOUNT</h1>
</header>

<body>
    <div class="w3-panel w3-round-xlarge w3-border w3-blue-gray w3-margin" style="padding:64px">
        <main class="w3-container">
                <form action="" method="POST">
                <label for="user">Username:</label>
                <input class="w3-input w3-border" type="text" id="user" name="username" value="<?php echo $row["username"]; ?>">
                <br>
                <label for="pass">New Password:</label>
                <input class="w3-input w3-border" type="text" id="pass" name="password" placeholder="Leave blank to keep old password">

                <p>
                    <label>User ID:</label>
                    <input class="w3-input w3-border w3-light-gray" type="text" name="id" value="<?php echo $row["id"]; ?>">
                </p>

                <button class="w3-button w3-green w3-block w3-round">Submit</button>
                <p><a href="adminRegistration.php" class="w3-button w3-white w3-border">Return</a></p>
            </form>
        </main>
    </div>
</body>
</html>