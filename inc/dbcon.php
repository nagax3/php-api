<?php
$host = "wash.cznay1hciiaq.eu-north-1.rds.amazonaws.com";
$username = "root";
$dbname = "wash";
$password = "qwerty";

$conn = mysqli_connect($host,$username, $password, $dbname);

if(!$conn) {

  die("Connection Failed: " . mysqli_connect_error());
}
?>