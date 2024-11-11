<?php
session_start(); // Iniciar la sesión
include 'database.php'; // Archivo de conexión a la base de datos

// Procesar el registro
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['register'])) {
   
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];


    // Verificar si las contraseñas coinciden
    if ($password !== $confirm_password) {
        die("Password and Confirm Password fields should match");
    }

    // Encriptar la contraseña antes de almacenarla
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Insertar el nuevo usuario en la base de datos
    $sql = "INSERT INTO lpa_users ( lpa_user_username, lpa_user_password, lpa_user_firstname, lpa_user_lastname, lpa_user_group, lpa_inv_status,lpa_users_email) VALUES (?, ?, ?, ?, 'user', 'A', ?)";
    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
        die("Error en la preparación de la consulta: " . $conn->error);
    }

    $stmt->bind_param("sss", $username, $hashed_password, $firstname, $lastname,'user', 'A', $email);

    if ($stmt->execute()) {
        echo "Registro exitoso. Ahora puedes iniciar sesión.";
    } else {
        echo "Error al registrar usuario: " . $stmt->error;
    }
}

// Mostrar el mensaje si existe en la sesión
if (isset($_SESSION['message'])) {
    echo "<p style='color:red;'>" . $_SESSION['message'] . "</p>";
    unset($_SESSION['message']); // Eliminar el mensaje después de mostrarlo
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro de Usuario</title>
    <link rel="stylesheet" href="stylelogin.css">
</head>
<body>
    <h2>Registro</h2>
    
    <form action="register.php" method="POST">
       

        <label for="First Name">First Name:</label>
        <input type="text" name="firstname" required>

        <label for="lastname">Last Name:</label>
        <input type="text" name="lastname" required>

        <label for="email">Email:</label>
        <input type="email" name="email" required>


        <label for="username">User:</label>
        <input type="text" name="username" required>

        <label for="password">Password</label>
        <input type="password" name="password" required>

        <label for="password"> Confirm Password</label>
        <input type="password" name="confirm_password" required>

        
        
      


        <button type="submit" name="register">Registrar</button>
    </form>
    
</body>
</html>



