<?php
$host = "localhost";
$username = "root";
$dbname = "wash";
$password = "";

$conn = mysqli_connect($host,$username, $password, $dbname);

if(!$conn) {

  die("Connection Failed: " . mysqli_connect_error());
}
?>