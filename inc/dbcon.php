<?php
$host = "141.252.219.226
";
$port = 3306
$username = "root";
$dbname = "wash";
$password = "";

$conn = mysqli_connect($host,$username, $password, $dbname, $port);

if(!$conn) {

  die("Connection Failed: " . mysqli_connect_error());
}
?>