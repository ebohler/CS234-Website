<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

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
?>

<header class="w3-container" style="padding:64px 16px 16px">
  <h1 class="w3-margin w3-jumbo">ADMIN MENU</h1>
</header>

<div class="w3-bar">
  <a href="adminRegistration.php" class="w3-button w3-blue-gray">Registration</a>
  <a href="adminFavorites.php" class="w3-button w3-dark-gray">Favorites</a>
  <a href="adminInfo.php" class="w3-button w3-brown">Info</a>
</div>

<body>
    <div class="w3-container w3-dark-gray">
        <div class="w3-row">
            <div class="w3-col m4 l3">
                <div class="w3-margin-top w3-margin-bottom">
                    <a href="createFavorites.php" class="w3-bar-item w3-button w3-white w3-border">Create</a>
                </div>

                <?php
                $sql = "SELECT * FROM favorites";
                
                if($result = $pdo->query($sql)) { 
                    if($result->rowCount() > 0){
                        echo '<table class="w3-table w3-bordered">';
                            echo "<thead>";
                                echo "<tr>";
                                    echo "<th>FAVID</th>";
                                    echo "<th>ID</th>";
                                    echo "<th>Song</th>";
                                    echo '<th>Genre</th>';
                                    echo '<th>Actions</th>';
                                echo "</tr>";
                            echo "</thead>";
                            echo "<tbody>";
                            while($row = $result->fetch()){
                                echo "<tr>";
                                    echo "<td>" . $row['favid'] . "</td>";
                                    echo "<td>" . $row['id'] . "</td>";
                                    echo "<td>" . $row['song'] . "</td>";
                                    echo "<td>" . $row['genre'] . "</td>";
                                    echo '<td> <a href="readFavorites.php?favid=' . $row['favid'] . '" class="w3-bar-item w3-button w3-white w3-border">View</a> </td>';
                                    echo '<td> <a href="updateFavorites.php?favid=' . $row['favid'] . '" class="w3-bar-item w3-button w3-white w3-border">Edit</a> </td>';
                                    echo '<td> <a href="deleteFavorites.php?favid=' . $row['favid'] . '" class="w3-bar-item w3-button w3-white w3-border">Remove</a> </td>';
                                echo "</tr>";
                            }
                            echo "</tbody>";                            
                        echo "</table>";
                        
                        $result = null;
                    } 
                    else {
                        echo '<div class="alert">No records found.</div>';
                    }
                } 
                else {
                    echo "Query Error";
                }
                
                $pdo = null;
                ?>

            </div>
        </div>        
    </div>
</body>
</html>

</html>