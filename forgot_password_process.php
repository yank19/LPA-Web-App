<?php
require_once 'config.php'; // Conexión a la base de datos

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
    $email = $_POST["email"];

    // Verificar si el correo existe en la base de datos
    $sql = "SELECT lpa_user_ID FROM lpa_users WHERE lpa_users_email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Generar un token único
        $token = bin2hex(random_bytes(50));
        $expires = date("Y-m-d H:i:s", strtotime("+1 hour")); // Expira en 1 hora

        // Guardar el token en la base de datos
        $user = $result->fetch_assoc();
        $userID = $user['lpa_user_ID'];

        $sql = "INSERT INTO password_resets (user_id, token, expires_at) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("iss", $userID, $token, $expires);
        $stmt->execute();

        // Enviar el correo con el enlace de restablecimiento
        $resetLink = "http://mydomain.com" . $token;
        $subject = "Password Reset Request";
        $message = "Click the link below to reset your password:\n\n" . $resetLink;
        $headers = "From: no-reply@yourdomain.com";

        if (mail($email, $subject, $message, $headers)) {
            echo "<script>alert('Password reset link sent to your email.'); window.location='index.php';</script>";
        } else {
            echo "<script>alert('Error sending email.'); window.location='forgot_password.php';</script>";
        }
    } else {
        echo "<script>alert('Email not found.'); window.location.href='index.php';</script>";
        
    }
}
?>