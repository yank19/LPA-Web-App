<?php
// Configuración de la base de datos
$host = "localhost";
$db_name = "LPA_eComms";
$username = "root";
$password = "";

$conn = new mysqli($host, $username, $password, $db_name);

// Verificar conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}
?>

