<?php
// Verificar si se ha enviado el formulario
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Conectar a la base de datos
    require_once 'config.php'; // Asegúrate de que tu archivo de configuración de la base de datos se incluya aquí

    // Recuperar los datos del formulario
    $product_name = $_POST['product_name'];
    $product_desc = $_POST['product_desc'];
    $product_onhand = $_POST['product_onhand'];
    $product_price = $_POST['product_price'];
    $product_image = $_FILES['product_image'];

    // Verificar que todos los campos sean completados
    if (!empty($product_name) && !empty($product_desc) && !empty($product_onhand) && !empty($product_price) && !empty($product_image)) {
        // Mover imagen a la carpeta de destino
        $upload_dir = 'images/';
        $upload_file = $upload_dir . basename($product_image['name']);
        
        if (move_uploaded_file($product_image['tmp_name'], $upload_file)) {
            // Insertar datos en la base de datos
            $sql = "INSERT INTO lpa_stock (lpa_stock_name, lpa_stock_desc, lpa_stock_onhand, lpa_stock_price, lpa_stock_image) VALUES (?, ?, ?, ?, ?)";

            if ($stmt = mysqli_prepare($conn, $sql)) {
                mysqli_stmt_bind_param($stmt, 'ssids', $product_name, $product_desc, $product_onhand, $product_price, $upload_file);

                if (mysqli_stmt_execute($stmt)) {
                    echo "Producto agregado exitosamente.";
                } else {
                    echo "Error al agregar producto.";
                }

                mysqli_stmt_close($stmt);
            } else {
                echo "Error en la preparación de la consulta.";
            }
        } else {
            echo "Error al mover la imagen.";
        }
    } else {
        echo "Por favor, complete todos los campos.";
    }
}
?>