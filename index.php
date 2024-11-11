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
    
    <form action="process_login.php" method="POST">
            
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>

            <button type="submit" name="login">Log in</button>


            <a href="#" class="forgot-password">Forgot Password?</a>
            <a href="#" class="Sing-up">Sing up</a>
    </form>
   
    
</body>
</html>