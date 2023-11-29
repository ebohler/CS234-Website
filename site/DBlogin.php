<?php
require_once "sqlConfig.php";

error_reporting(E_ALL);
ini_set('display_errors', '1');

if($_SERVER['REQUEST_METHOD']=='POST') {
    if(empty($_POST['username'])) {
        echo "Error: Username cannot be blank <br>";
        echo '<a href="login.php" class="w3-button w3-red w3-round w3-border">Return</a>';
        exit();
    }
    else {
        $username=$_POST['username'];
    }

    if(empty($_POST['password'])) {
        echo "Error: Password cannot be blank <br>";
        echo '<a href="login.php" class="w3-button w3-red w3-round w3-border">Return</a>';
        exit();
    }
    else {
        $password=$_POST['password'];
    }

    $sql = "SELECT id, username, password FROM registration WHERE username = :username";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(":username", $username);
    
    $stmt->execute();
    if($stmt->rowCount() == 1) {
        if($row = $stmt->fetch()){
            $username = $row["username"];
            $pwdHashed = $row["password"];
            $id = $row["id"];

            if(password_verify($password, $pwdHashed)) {
                session_start();
                
                $_SESSION["username"] = $username;
                $_SESSION["id"] = $id;
                $_SESSION["loggedin"] = true;                          
                    
                header("location: index.php");
            } 
            else {
                echo "Error: Invalid username or password. <br>";
                echo '<a href="login.php" class="w3-button w3-red w3-round w3-border">Return</a>';
            }
        }
    } 
    else {
        echo "Error: Invalid username or password. <br>";
        echo '<a href="login.php" class="w3-button w3-red w3-round w3-border">Return</a>';
    }
    $pdo = null;
}

?>
