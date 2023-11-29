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
  <h1 class="w3-margin">ADD WEATHER INFO</h1>
</header>

<body class="w3-panel" >
    <main class="w3-container">
        <form action="DBinfo.php" method="POST">
            <p>
                <label>Weather: </label>
                <input class="w3-radio" type="radio" name='weather' value="Sunny">
                <label>Sunny</label>

                <input class="w3-radio" type="radio" name='weather' value="Cloudy">
                <label>Cloudy</label>
            </p>

            <p>
                <label>State: </label>
                <select class="w3-input" name="state">
                    <option selected disabled>Select state</option>
                    <option value="IL">Illinois</option>
                    <option value="MO">Missouri</option>
                    <option value="AZ">Arizona</option>
                    <option value="AR">Arkansas</option>
                    <option value="CA">California</option>
                </select>
            </p>

            <button class="w3-button w3-green w3-block w3-round">Submit</button>
        </form>
    </main>
</body>
</html>