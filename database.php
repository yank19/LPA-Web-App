<?php
$servername = "localhost";
$username = "r-oot";
$password = "";
$dbname = "LPA_eComms";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>
