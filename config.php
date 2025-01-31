<?php
// config database
$host = "localhost";
$db_name = "LPA_eComms";
$username = "root";
$password = "";

$conn = new mysqli($host, $username, $password, $db_name);

// check conexion
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}
?>

