<?php
require_once "sqlConfig.php";

if($_SERVER["REQUEST_METHOD"]=="POST"){
    $username=$_POST['username'];
    $pwdEntered=$_POST['password'];
}


function check_user($username) {
    global $pdo;

    $sql = "SELECT id FROM registration WHERE username = :username";
        
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(":username", $user);
    
    $user = $_POST["username"];
    
    if($stmt->execute()){
        if($stmt->rowCount() == 1){
            return true;
        } 
        else {
            return false;
        }
    } 
    else {
        echo "Error: Please try again. <br>";
        echo '<a href="register.php" class="w3-button w3-red w3-round w3-border">Return</a>';
    }
    
}

function check_password($pwdEntered) {
    if (strlen($pwdEntered) >= 7 && strlen($pwdEntered) <= 12) {
        if (strtolower($pwdEntered) != $pwdEntered) {
            return true;
        }
        else {
            echo "Error: Password does not contain a capital letter <br>";
            echo '<a href="register.php" class="w3-button w3-red w3-round w3-border">Return</a>';
            return false;
        }
    }
    else {
        echo "Error: Password does not meet length requirements <br>";
        echo '<a href="register.php" class="w3-button w3-red w3-round w3-border">Return</a>';
        return false;
    }
}

if (!isset($username) || empty($username)) {
    echo "Username cannot be blank <br>";
    echo '<a href="register.php" class="w3-button w3-red w3-round w3-border">Return</a>';
    exit();
}

$userTaken = check_user($username);

if ($userTaken) {
    echo "Error: An account already exists with that username. <br>";
    echo '<a href="register.php" class="w3-button w3-red w3-round w3-border">Return</a>';
}
else if (check_password($pwdEntered)) {
    echo "Registration success! <br>";
    echo '<a href="login.php" class="w3-button w3-red w3-round w3-border">Login</a>';
    $sql="INSERT INTO registration(username,password) VALUES(:username,:password)";
    $stmt=$pdo->prepare($sql);
    
    $pwdHashed=password_hash($pwdEntered,PASSWORD_BCRYPT);
    
    $stmt->bindParam(':username',$username);
    $stmt->bindParam(':password',$pwdHashed);
    
    $stmt->execute();
}

$pdo=null;



?>
