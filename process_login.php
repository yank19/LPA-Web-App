<?php
session_start(); // Iniciar la sesión
include 'database.php'; // Archivo de conexión a la base de datos

// Verificar si la conexión fue exitosa
if ($conn->connect_error) {
    $_SESSION['message'] = "Error al conectar con la base de datos: " . $conn->connect_error;
    header("Location: index.php"); // Redirigir de nuevo a la página de login
    exit();
}


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Verificar si el usuario existe en la base de datos
    $sql = "SELECT * FROM lpa_users WHERE lpa_user_username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();
        // Verificar la contraseña
        if (password_verify($password, $user['password'])) {
            echo "Inicio de sesión exitoso.";
        } else {
            echo "Contraseña incorrecta.";
        }
    } else {
        // Si el usuario no está registrado, guardar mensaje en la sesión y redirigir
        $_SESSION['message'] = "El usuario no está registrado. Por favor, regístrate.";
        header("Location:login.html");
        exit();
    }
}
?>