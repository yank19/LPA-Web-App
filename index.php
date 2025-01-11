<?php
session_start();
require_once 'config.php'; // Include database configuration

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["login"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Querying the user in the database
    $sql = "SELECT lpa_user_ID,lpa_user_password,lpa_user_role  FROM lpa_users WHERE lpa_user_username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        // Verify your password
        if (password_verify($password, $user["lpa_user_password"])) {
            // Guardar información en la sesión
            $_SESSION["user_id"] = $user["lpa_user_ID"];
            $_SESSION["username"] = $username;
            $_SESSION["role"] = $user["lpa_user_role"]; // Save the user's role
            echo "correct";
            // Redirect the user to another page
            header("Location: dashboard.php");
            exit();
        } else {
            echo "<script>alert('Wrong Password.');</script>";
        }
    } else {
        echo "<script>alert('User not found.');</script>";
    }

}
    
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Web APP</title>
  
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Krub:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;1,200;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="stylelogin.css">
</head>
<body>

    <div class="logo"><img src="images/logowhite.png" alt="logo"></div>
    <br>
    <div class="login-container">
        
        <h2><span class="welcome">WELCOME </span><br><span class="world">to Our world</span></h2>
    </div>
    
    <form action="index.php" method="POST">
            
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <div class="forgotpassword">
                <a href="forgot_password.php">Forgot Password?</a>
            </div>
            
            <button type="submit" name="login">Log in</button>
            
            <div class="createAccount">
                Don't have an account?<a href="register.php">Create account</a>
            </div>
    </form>
   
    
</body>
</html>


