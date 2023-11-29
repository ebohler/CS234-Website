<?php
session_start();

include 'navbar.php';
 
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] != true) {
    header("Location: login.php");
    exit;
}
?>

<header class="w3-container w3-center" style="padding:128px 16px">
    <h1 class="w3-margin w3-jumbo">ABOUT PAGE</h1>
    <ul class="w3-ul">
        <li>This is a website created for the CS234 Semester Project.</li>
        <li>Database-driven using MySQL and written in PHP with PDO</li>
        <li>Includes a registration table to store registered users and two other tables in a one-to-many relationship</li>
        <li>Contains full admin CRUD functionality for each table</li>
        <li>Login and register forms are validated and users logging in are authenticated</li>
        <li>All usernames are unique and all passwords are hashed using bcrypt</li>
        <li>Uses sessions to prevent users to access the website without signing in</li>
        <li>Styled using the W3.CSS framework</li>
        <li><a href="https://github.com/ebohler/CS234-Website">Made by Evan Bohler</a></li>
    </ul>
</header>

</html>