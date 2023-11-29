<?php
require_once "sqlConfig.php";

session_start();

error_reporting(E_ALL);
ini_set('display_errors', '1');

if($_SERVER["REQUEST_METHOD"]=="POST"){
    $weather=$_POST['weather'];
    $state=$_POST['state'];

    $sql="INSERT INTO info(weather,state,id) VALUES(:weather,:state,:id)";
    $stmt=$pdo->prepare($sql);

    $stmt->bindParam(':weather',$weather);
    $stmt->bindParam(':state',$state);
    $stmt->bindParam(':id',$_SESSION["id"]);

    $stmt->execute();

    $pdo=null;

    header("location: index.php");
}

?>
