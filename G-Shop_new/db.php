<?php
$host = "localhost";
$db = "cmsc121_store";
$user = "root";
$pass = "root";

$opt = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_PERSISTENT => true);
$dbh = new PDO("mysql:host=$host;dbname=$db",$user,$pass,$opt);

?>