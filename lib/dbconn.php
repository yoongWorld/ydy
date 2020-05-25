<?php
//$servername = "localhost";
//$username = "root";
//$password = "";
//$dbname = "templestay";
$username = "yoong2";
$password = "dbs43794379";
$dbname = "yoong2";
header("Content-Type: text/html; charset=UTF-8");
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
mysqli_set_charset($conn, "utf8");
?>