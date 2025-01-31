<?php
session_start();
require_once 'config.php'; //

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
} 
// else {
//     // Si no se encuentra al usuario, cerrar sesión por seguridad
//     session_destroy();
//     header("Location: index.php");
//     exit();
// }



// Consulta para obtener los productos
$sql = "SELECT lpa_stock_ID, lpa_stock_name, lpa_stock_desc, lpa_stock_onhand, lpa_stock_price,  lpa_stock_image 
        FROM lpa_stock 
        WHERE lpa_stock_status = 'A'";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Web APP - Stock</title>
    <link rel="stylesheet" href="CSS/style.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Krub:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>

 <!--lateral menu-->
   <!---------------- Menu Estar --------------------------->

   <?php include 'menu.php'; ?>

    <!---------------- Menu  END --------------------------->
    <!-- Sección de Stock -->
    <section>
        <h3 class="titlepage">Stock</h3>
        
        <div class="searchbar">
            <div class="intosearch">
            <input type="text" id="searchInput" placeholder="Search...">
            <span class="fa fa-search"></span>
            </div>
        </div>
    </section>

    <section class="whitepart">
        <?php
        // Verificar si hay resultados
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $productID = $row['lpa_stock_ID'];
                $productName = $row['lpa_stock_name'];
                $productDesc = $row['lpa_stock_desc'];
                $productOnHand = $row['lpa_stock_onhand'];
                $productPrice = $row['lpa_stock_price'];
                $productImage = $row['lpa_stock_image'];
        ?>
    <div class="listproduts">
            <div class="product-container"> 
                <img src="<?php echo htmlspecialchars($productImage); ?>" alt="<?php echo htmlspecialchars($productName); ?>" class="product-image"> 
                <div class="product-details">
                    <div class="product-title"><?php echo htmlspecialchars($productName); ?></div> 
                    <div class="product-description"><?php echo htmlspecialchars($productDesc); ?></div> 
                    <div class="product-info"> 
                        <span>$ <?php echo number_format($productPrice, 2); ?></span> 
                        <span><?php echo htmlspecialchars($productOnHand); ?> Units</span> 
                        <span>ID: <?php echo htmlspecialchars($productID); ?></span> 
                        <span class="arrow-icon">&gt;</span>
                    </div>
                </div> 
            </div>
    </div>
        <?php
            }
        } else {
            echo "<p>No products found.</p>";
        }
        ?>
    </section>
</body>
</html>