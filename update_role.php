<?php
// Iniciar la sesión
session_start();
require_once 'config.php'; // Conexión a la base de datos

// Verificar si el usuario está autenticado y es administrador
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    echo "Access denied.";
    exit();
}

// Verificar que los datos se envían correctamente desde el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['user_role']) && isset($_POST['user_id'])) {
    $userId = $_POST['user_id'];
    $newRole = $_POST['user_role'];

    // Actualizar el rol en la base de datos
    $sql = "UPDATE lpa_users SET lpa_user_role = ? WHERE lpa_user_ID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $newRole, $userId);

    if ($stmt->execute()) {
        echo "<script>alert('User role updated successfully.');</script>";
        header("Location: user_management.php"); // Redirige a la página de gestión de usuarios
        exit();
    } else {
        echo "<script>alert('Error updating user role.');</script>";
    }

    $stmt->close();
} else {
    echo "Invalid request.";
}
?>