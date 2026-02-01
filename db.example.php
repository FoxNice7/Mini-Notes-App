<?php 
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$mysqli = new mysqli("localhost", "username", "password", "dataabase_name");

if($mysqli->connect_error){
    die("Connection failed: " . $mysqli->connect_error);
}

?>