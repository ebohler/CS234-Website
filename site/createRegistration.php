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

if($_SERVER["REQUEST_METHOD"]=="POST"){
    $username=$_POST['username'];
    $password=$_POST['password'];
    $id=$_POST['id'];

    if (!isset($username) || empty($username)) {
        echo "<br><br><br>Error: Username cannot be blank <br>";
        echo '<a href="register.php" class="w3-button w3-red w3-round w3-border">Return</a>';
    }
    
    $userTaken = check_user($username);
    
    if ($userTaken) {
        echo "<br><br><br>Error: An account already exists with that username. <br>";
        echo '<a href="register.php" class="w3-button w3-red w3-round w3-border">Return</a>';
    }
    else if (check_password($password)) {
        $sql="INSERT INTO registration(username,password, id) VALUES(:username,:password,:id)";
        $stmt=$pdo->prepare($sql);
        
        $pwdHashed=password_hash($password,PASSWORD_BCRYPT);
        
        $stmt->bindParam(':username',$username);
        $stmt->bindParam(':password',$pwdHashed);
        $stmt->bindParam(':id',$id);
        
        $stmt->execute();
    }

    $pdo=null;

    header("location: adminRegistration.php");
}

function check_password($password) {
    if (strlen($password) >= 7 && strlen($password) <= 12) {
        if (strtolower($password) != $password) {
            return true;
        }
        else {
            echo "<br><br><br>Error: Password does not contain a capital letter <br>";
            echo '<a href="adminRegistration.php" class="w3-button w3-red w3-round w3-border">Return</a>';
            return false;
        }
    }
    else {
        echo "<br><br><br>Error: Password does not meet length requirements <br>";
        echo '<a href="adminRegistration.php" class="w3-button w3-red w3-round w3-border">Return</a>';
        return false;
    }
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

?>

<header class="w3-container" style="padding:64px 16px 0px">
  <h1 class="w3-margin">CREATE ACCOUNT</h1>
</header>

<body>
    <div class="w3-panel w3-round-xlarge w3-border w3-blue-gray w3-margin" style="padding:64px">
        <main class="w3-container">
                <form action="" method="POST">
                <label for="user">Username:</label>
                <input class="w3-input w3-border" type="text" id="user" name="username" value="">
                <br>
                <label for="pass">New Password:</label>
                <input class="w3-input w3-border" type="text" id="pass" name="password" placeholder="">
                <ul>
                    <li> Must be between 7-12 characters </li>
                    <li> Must contain a capital letter </li>
                </ul>

                <p>
                    <label>User ID:</label>
                    <input class="w3-input w3-border w3-light-gray" type="text" name="id" value="">
                </p>

                <button class="w3-button w3-green w3-block w3-round">Submit</button>
                <p><a href="adminRegistration.php" class="w3-button w3-white w3-border">Return</a></p>
            </form>
        </main>
    </div>
</body>
</html>