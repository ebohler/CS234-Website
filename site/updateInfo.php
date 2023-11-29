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
    
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(":infoid", $identifier);
    
    $identifier = $_GET["infoid"];
    
    if($stmt->execute()) {
        if($stmt->rowCount() == 1) {
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

if($_SERVER["REQUEST_METHOD"]=="POST"){
    $weather=$_POST['weather'];
    $state=$_POST['state'];
    $id=$_POST['id'];
    $newinfoid=$_POST["infoid"];

    $sql = "UPDATE info SET weather=:weather, state = :state, id = :id, infoid = :newinfoid WHERE infoid = :infoid";
    $stmt=$pdo->prepare($sql);

    $stmt->bindParam(':weather',$weather);
    $stmt->bindParam(':state',$state);
    $stmt->bindParam(':id',$id);
    $stmt->bindParam(':infoid',$infoid);
    $stmt->bindParam(':newinfoid',$newinfoid);

    $stmt->execute();

    $pdo=null;

    header("location: adminInfo.php");
}

?>

<header class="w3-container" style="padding:64px 16px 0px">
  <h1 class="w3-margin">EDIT INFO</h1>
</header>

<body>
    <div class="w3-panel w3-round-xlarge w3-border w3-brown w3-margin" style="padding:64px"> 
        <main class="w3-container">
            <form action="" method="POST">
                <p>
                    <label>Weather: </label>
                    <input class="w3-radio" type="radio" name='weather' value="Sunny" <?php if($row["weather"] == "Sunny") {echo 'checked="checked"';} ?>>
                    <label>Sunny</label>

                    <input class="w3-radio" type="radio" name='weather' value="Cloudy" <?php if($row["weather"] == "Cloudy") {echo 'checked="checked"';} ?>>
                    <label>Cloudy</label>
                </p>

                <p>
                    <label>State: </label>
                    <select class="w3-input" name="state">
                        <option disabled>Select state</option>
                        <option value="IL" <?php if($row["state"] == "IL") {echo 'selected';} ?>>Illinois</option>
                        <option value="MO" <?php if($row["state"] == "MO") {echo 'selected';} ?>>Missouri</option>
                        <option value="AZ" <?php if($row["state"] == "AZ") {echo 'selected';} ?>>Arizona</option>
                        <option value="AR" <?php if($row["state"] == "AR") {echo 'selected';} ?>>Arkansas</option>
                        <option value="CA" <?php if($row["state"] == "CA") {echo 'selected';} ?>>California</option>
                    </select>
                </p>

                <p>
                    <label>User ID:</label>
                    <input class="w3-input w3-border w3-light-gray" type="text" name="id" value="<?php echo $row["id"]; ?>" placeholder="Must be an existing User ID!">
                </p>

                <p>
                    <label>Info ID:</label>
                    <input class="w3-input w3-border w3-light-gray" type="text" name="infoid" value="<?php echo $row["infoid"]; ?>" placeholder="INFOID">
                </p>

                <button class="w3-button w3-green w3-block w3-round">Submit</button>
                <p><a href="adminInfo.php" class="w3-button w3-white w3-border">Return</a></p>
            </form>
        </main>
    </div>
</body>
</html>