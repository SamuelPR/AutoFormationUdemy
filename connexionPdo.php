<?php
$hostname = 'host=localhost';
$username = 'root';
$password = '';
$bdd = 'library';

try {
    $myPdo = new PDO("mysql:$hostname;dbname=$bdd;charset=utf8", $username, $password);
    $myPdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo $e->getMessage();
    $myPdo = null;
}
?>