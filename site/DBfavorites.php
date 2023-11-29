<?php
require_once "sqlConfig.php";

session_start();

error_reporting(E_ALL);
ini_set('display_errors', '1');

if($_SERVER["REQUEST_METHOD"]=="POST"){
    $song=$_POST['song'];
    $genre=$_POST['genre'];

    $sql="INSERT INTO favorites(song,genre,id) VALUES(:song,:genre,:id)";
    $stmt=$pdo->prepare($sql);

    $stmt->bindParam(':song',$song);
    $stmt->bindParam(':genre',$genre);
    $stmt->bindParam(':id',$_SESSION["id"]);

    $stmt->execute();

    $pdo=null;

    header("location: index.php");
}

?>
