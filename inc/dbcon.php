<?php
$host = "wash.cznay1hciiaq.eu-north-1.rds.amazonaws.com";
$port = 3306;
$username = "root";
$dbname = "wash";
$password = "qwerty1234";

$conn = mysqli_connect($host,$username, $password, $dbname, $port);

if(!$conn) {

  die("Connection Failed: " . mysqli_connect_error());
}
?>