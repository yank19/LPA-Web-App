<?php
require_once 'config.php'; // Incluir la configuración de la base de datos

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["register"])) {
    // Obtener datos del formulario
    $firstname = $_POST["firstname"];
    $lastname = $_POST["lastname"];
    $email = $_POST["email"];
    $username = $_POST["username"];
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm_password"];

    // Verificar que las contraseñas coincidan
    if ($password !== $confirm_password) {
        echo "Las contraseñas no coinciden.";
    } else {
        // Encriptar la contraseña
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);

        // Insert user in the database
        $sql = "INSERT INTO lpa_users (lpa_user_username, lpa_user_password, lpa_user_firstname, lpa_user_lastname, lpa_users_email, lpa_user_role) 
                VALUES (?, ?, ?, ?, ?,?)";
        $stmt = $conn->prepare($sql);
        $role = "user"; // By default, normal user role
        $stmt->bind_param("sssss", $username, $hashed_password, $firstname, $lastname, $email,$role);

        if ($stmt->execute()) {
            // Show success alert and redirect to login
            echo "<script>
                    alert('User registered successfully.');
                    window.location.href = 'index.php';
                  </script>";
            exit(); // Stop script execution after redirecting
        } else {
            echo "Error al registrar el usuario: " . $conn->error;
        }

        $stmt->close();
    }
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

