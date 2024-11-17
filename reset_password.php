<?php
require_once 'config.php';

if (isset($_GET['token'])) {
    $token = $_GET['token'];

    // Verificar el token en la base de datos
    $sql = "SELECT user_id, expires_at FROM password_resets WHERE token = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $token);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $reset = $result->fetch_assoc();
        if (strtotime($reset['expires_at']) > time()) {
            $userID = $reset['user_id'];
        } else {
            echo "<script>alert('Token expired.'); window.location='forgot_password.php';</script>";
            exit();
        }
    } else {
        echo "<script>alert('Invalid token.'); window.location='forgot_password.php';</script>";
        exit();
    }
} else {
    header("Location: forgot_password.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $newPassword = password_hash($_POST['new_password'], PASSWORD_DEFAULT);

    // Actualizar la contraseña en la base de datos
    $sql = "UPDATE lpa_users SET lpa_user_password = ? WHERE lpa_user_ID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $newPassword, $userID);
    $stmt->execute();

    // Eliminar el token usado
    $sql = "DELETE FROM password_resets WHERE user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $userID);
    $stmt->execute();

    echo "<script>alert('Password reset successfully.'); window.location='index.php';</script>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Reset Password</h2>
    <form method="POST">
        <label for="new_password">New Password:</label>
        <input type="password" name="new_password" id="new_password" required>
        <button type="submit">Reset Password</button>
    </form>
</body>
</html>

