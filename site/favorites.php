<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

session_start();

include 'navbar.php';
 
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] != true) {
    header("Location: login.php");
    exit;
}
?>
 
<header class="w3-container" style="padding:32px 16px 8px">
  <h1 class="w3-margin">ADD FAVORITE SONG</h1>
</header>

<body class="w3-panel" >
    <main class="w3-container">
        <form action="DBfavorites.php" method="POST">
            <p>
                <label>Song Title:</label>
                <input class="w3-input w3-border w3-light-gray" type="text" name="song" placeholder="Enter song title">
            </p>
            
            <p>
                <label>Genre: </label>
                <input class="w3-radio" type="radio" name='genre' value="Pop">
                <label>Pop</label>

                <input class="w3-radio" type="radio" name='genre' value="Rock">
                <label>Rock</label>

                <input class="w3-radio" type="radio" name='genre' value="Rap">
                <label>Rap</label>
            </p>

            <button class="w3-button w3-green w3-block w3-round">Submit</button>
        </form>
    </main>
</body>
</html>