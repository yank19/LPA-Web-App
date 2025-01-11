<?php
session_start();
require_once 'config.php'; // Conexión a la base de datos


// Recuperar información del usuario desde la base de datos
$user_id = $_SESSION['user_id'];
$sql = "SELECT lpa_user_firstname, lpa_user_lastname FROM lpa_users WHERE lpa_user_ID = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
    $firstname = $user['lpa_user_firstname'];
    $lastname = $user['lpa_user_lastname'];
} else {
    // Si no se encuentra al usuario, cerrar sesión por seguridad
    session_destroy();
    header("Location: index.php");
    exit();
}
$stmt->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Web APP</title>
    <link rel="stylesheet" href="CSS/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Krub:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;1,200;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">


</head>
<body>

    <!--lateral menu-->
   
        <ul class="menu">
            <li><img src="" alt=""><a class="itens" id="nameUser"> <span class="fa fa-user-circle"></span> <?php echo htmlspecialchars($firstname . ' ' . $lastname); ?></a></li>
            <br>
            <br>
            <br>
            <br><br>
            <br>
            <br>
            <li><a class="itens" href="#"><span class="fa fa-home"></span> Home</a></li>
            <li><a class="itens" href="stock.php"><span class="fa fa-cube"></span> Stock</a></li>
            <?php if ($_SESSION['role'] == 'admin') { ?>
            <li><a class="itens" href="#"><span class="fa fa-line-chart"></span> Sales</a></li>
            <li><a class="itens" href="#"><span class="fa fa-book"></span> invoices</a></li>
            <li><a class="itens" href="#"><span class="fa fa-users"></span> clients</a></li>
             <?php } ?>
            <br><br>
    
            <?php if ($_SESSION['role'] == 'admin') { ?>
        
            <li><a class="itensbutton" href="user_management.php"><span class="fa fa-pencil"></span> User Management</a></li>
             <?php } ?>
          
            <li><a class="itensbutton" href="#"><span class="fa fa-question-circle"></span> Help</a></li>
            <li><a class="itensbutton" href="mashup.php"> <span class="fa fa-info-circle"></span> About</a></li>
            
            <li><a class="itensbutton" href="logout.php"><span class="fa fa-sign-out"></span> Log out</a></li>
        </ul>
    
    <section>
        <h3 class="date"><?php echo date("d F, Y"); ?></h3>
        <h2 class="heder1">Good day, <span> <?php echo htmlspecialchars($firstname); ?>!</span></h2>
        
         
        <div id="album-rotator">
            <div id="album-rotator-holder">
                <a target="_top" class="album-item" href="https://www.w3schools.com/css/css3_buttons.asp">
                    <span class="album-details">
                        <span class="title" >New Prototipes 2024</span>
                        <span class="summary">know the last prototipe for the new season, know the last prototipe for the new season, know the last prototipe for the new season,know the last prototipe for the new season,</span>
                        <span class="fa fa-plus"> </span>
                    </span>
                </a>
                <a target="_top" class="album-item" href="https://www.w3schools.com/css/css3_buttons.asp">
                    <span class="album-details">
                        <span class="title" >New Prototipes 2024</span>
                        <span class="summary">know the last prototipe for the new season, know the last prototipe for the new season, know the last prototipe for the new season,know the last prototipe for the new season,</span>
                        <span class="fa fa-plus"> </span>
                    </span>
                </a>
                <a target="_top" class="album-item" href="https://www.w3schools.com/css/css3_buttons.asp">
                    <span class="album-details">
                        <span class="title" >New Prototipes 2024</span>
                        <span class="summary">know the last prototipe for the new season, know the last prototipe for the new season, know the last prototipe for the new season,know the last prototipe for the new season,</span>
                        <span class="fa fa-plus"> </span>
                    </span>
                </a>
            </div>
        </div>
    </section>

    <section class="whitepart">
        <h3>Lest's Start</h3><br>
        <div class="buttonsHome">
            <a href="stock.php" class="siglebuttonhome">
                <h3>Stock</h3>
                <span class="fa fa-cube"></span>
            </a>
            <a href="https://www.w3schools.com/html/html_blocks.asp" class="siglebuttonhome">
                <h3>Invoices</h3>
                <span class="fa fa-book"></span>
            </a>
            <a href="https://www.w3schools.com/html/html_blocks.asp" class="siglebuttonhome">
                <h3>Clients</h3>
                <span class="fa fa-users"></span>
            </a>
        </div>
               

    </section>
</body>
</html>