<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

$dsn='mysql:host=localhost;port=8889;dbname=project';
$username_db="root";
$pwdEntered_db="root";

try {
    $pdo= new PDO($dsn,$username_db,$pwdEntered_db);
}
catch(PDOException $e) {
    die("Connection Error".$e->getMessage());
}

$sql="CREATE TABLE IF NOT EXISTS registration (
        id INT(7) NOT NULL AUTO_INCREMENT,
        username VARCHAR(100) NOT NULL,
        password VARCHAR(100) NOT NULL,
        PRIMARY KEY(id)
    )";

    $stmt=$pdo->prepare($sql);

if ($stmt->execute()){
    echo "";
}
else {
    echo "Error in creating the registration table".$stmt->$error;
}

$sql="CREATE TABLE IF NOT EXISTS favorites (
        favid INT(7) NOT NULL AUTO_INCREMENT,
        id INT(7) NOT NULL DEFAULT 1,
        song VARCHAR(100) NOT NULL,
        genre VARCHAR(100) NOT NULL,
        PRIMARY KEY (favid),
        FOREIGN KEY (id) REFERENCES registration(id)
    )";

$stmt=$pdo->prepare($sql);

if ($stmt->execute()){
    echo "";
}
else {
    echo "Error in creating the favorites table".$stmt->$error;
}

$sql="CREATE TABLE IF NOT EXISTS info (
    infoid INT(7) NOT NULL AUTO_INCREMENT,
    id INT(7) NOT NULL DEFAULT 1,
    weather VARCHAR(100) NOT NULL,
    state VARCHAR(100) NOT NULL,
    PRIMARY KEY (infoid),
    FOREIGN KEY (id) REFERENCES registration(id)
)";

$stmt=$pdo->prepare($sql);

if ($stmt->execute()){
echo "";
}
else {
echo "Error in creating the info table".$stmt->$error;
}
?>