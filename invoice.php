<?php
session_start();
require_once 'config.php'; // Conexión a la base de datos

// // Verificar si el usuario está autenticado
// if (!isset($_SESSION['user_id'])) {
//     header("Location: index.php");
//     exit();
// }

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
// Consulta para obtener las facturas
$sql = "SELECT lpa_inv_no, lpa_inv_date, lpa_inv_client_ID, lpa_inv_client_name, lpa_inv_client_address, lpa_inv_amount, lpa_inv_status 
        FROM lpa_invoices";
$result = $conn->query($sql);
?>
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
   <!---------------- Menu Estar --------------------------->

   <?php include 'menu.php'; ?>

<!---------------- Menu  END --------------------------->
    
        <section>
            <h3 class="titlepage">Invoice</h3>
            
            <div class="searchbar">
                <div class="intosearch">
                <input type="text" id="searchInput" placeholder="Search...">
                <span class="fa fa-search"></span>
                </div>
            </div>
        </section>

    <section class="whitepart">

        <div class="continvoice"> 

        <div class="columnA"> 
                <div class="listinvoice">
                    <?php
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $invNo = $row['lpa_inv_no'];
                            $invDate = $row['lpa_inv_date'];
                            $clientID = $row['lpa_inv_client_ID'];
                            $clientName = $row['lpa_inv_client_name'];
                            $clientAddress = $row['lpa_inv_client_address'];
                            $amount = $row['lpa_inv_amount'];
                            // Consulta para obtener los ítems de la factura actual
                                $itemsSql = "SELECT lpa_invitem_no, lpa_invitem_stock_ID, lpa_invitem_stock_name, lpa_invitem_qty, lpa_invitem_stock_price, lpa_invitem_stock_amount 
                                             FROM lpa_invoice_items 
                                             WHERE lpa_invitem_inv_no = ?";
                                $itemsStmt = $conn->prepare($itemsSql);
                                $itemsStmt->bind_param("s", $invNo);
                                $itemsStmt->execute();
                                $itemsResult = $itemsStmt->get_result();
                                $items = [];
                                $subtotal = 0;
                                while ($itemRow = $itemsResult->fetch_assoc()) {
                                    $items[] = $itemRow;
                                    // Calcula el subtotal sumando los valores totales de cada ítem
                                    $subtotal += $itemRow['lpa_invitem_stock_amount'];
                                }
                                $itemsStmt->close();

                                // Calcula el tax como el 10% del subtotal
                                $tax = $subtotal * 0.10;
                                // Calcula el total sumando el subtotal y el tax
                                $total = $subtotal + $tax;
                                // Actualiza los valores en la base de datos
                                $updateSql = "UPDATE lpa_invoices 
                                              SET lpa_inv_subtotal = ?, lpa_inv_tax = ?, lpa_inv_total = ? 
                                              WHERE lpa_inv_no = ?";
                                $updateStmt = $conn->prepare($updateSql);
                                $updateStmt->bind_param("ddds", $subtotal, $tax, $total, $invNo);
                                $updateStmt->execute();
                                $updateStmt->close();
   ?>
                    <div class="itemslist">
                        <div class="topside">
                            <span>Order #<?php echo htmlspecialchars($invNo); ?></span>
                            <span class="invoicedate"><?php echo htmlspecialchars($invDate); ?></span>
                            <button id="showmodal" class="fa fa-eye"></button>
                        </div>
                        <div class="buttonside">
                            <span><?php echo htmlspecialchars($clientName); ?></span>
                            <span class="invoiceprice">$<?php echo number_format($total, 2); ?></span> <!-- Mostrando el total -->
                        </div>
                    </div>

                    <dialog id="modal">
                        <div class="popup-header">
                            <span class="save">Save</span>
                            <span class="edit">Edit</span>
                            <span class="close-btn" id="closemodal">&times;</span>
                        </div>
                        <div class="popup-content">
                            <div class="topside">
                                <span>Order #<?php echo htmlspecialchars($invNo); ?></span>
                                <span class="invoicedate"><?php echo htmlspecialchars($invDate); ?></span>
                            </div>
                            <div>
                                <p class="CI">Customer Information</p>
                                <table class="tableCI">
                                    <tr>
                                        <td class="hedertableCI">Name:</td>
                                        <td class="hedertableCI">Address:</td>
                                        <td class="hedertableCI">Client ID:</td>
                                    </tr>
                                    <tr>
                                        <td><?php echo htmlspecialchars($clientName); ?></td>
                                        <td><?php echo htmlspecialchars($clientAddress); ?></td>
                                        <td><?php echo htmlspecialchars($clientID); ?></td>
                                    </tr>
                                    <tr>
                                        <td class="hedertableCI">Last Name:</td>
                                        <td class="hedertableCI">Phone:</td>
                                    </tr>
                                    <tr>
                                        <td>Smith</td>
                                        <td>+61 458 256 257</td>
                                    </tr>
                                </table>
                            </div>
                            <hr>
                            <div>
                            <p class="CI">Items</p>
                                <table class="tableitens">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Units</th>
                                            <th>V/U</th>
                                            <th>V/T</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($items as $item) { ?>
                                        <tr>
                                            <td><?php echo htmlspecialchars($item['lpa_invitem_stock_ID']); ?></td>
                                            <td><?php echo htmlspecialchars($item['lpa_invitem_stock_name']); ?></td>
                                            <td><?php echo htmlspecialchars($item['lpa_invitem_qty']); ?></td>
                                            <td>$<?php echo htmlspecialchars($item['lpa_invitem_stock_price']); ?></td>
                                            <td>$<?php echo htmlspecialchars($item['lpa_invitem_stock_amount']); ?></td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                            <hr>
                            <div class="inftotal">
                                <p><span class="subtotal">Sub total: </span>$<?php echo number_format($subtotal, 2); ?></p>
                                <p><span class="subtotal">TAX: </span>$<?php echo number_format($tax, 2); ?></p>
                                <p><span class="subtotal">Total: </span>$<?php echo number_format($total, 2); ?></p> <!-- Mostrando el total -->
                            </div>
                        </div>
                    </dialog>

                    <?php
                        }
                    } else {
                        echo "<p>No invoices found.</p>";
                    }
                    ?>
                </div>
            </div>


            <div class="columnB"> 

                <button id="showmodalnewinvoice">New Invoice <span class="fa fa-file"></span></button>
             

                <dialog id="modalnewinvoice">
                    <div class="popup-header">
                        <span class="save">Save</span>
                        <span class="close-btn" id="closemodalnewinvoice">&times;</span>
                    </div>

                    <div class="popup-content">
                        <form id="invoiceForm">
                            <div class="topsidenewin">
                                <label for="orderNumber">Order #</label>
                                <input type="text" id="orderNumber" name="orderNumber" required>
                                <label for="invoiceDate">Fecha</label>
                                <input type="date" id="invoiceDate" name="invoiceDate" required>
                            </div>
                            <div>
                                <p class="CI">Información del Cliente</p>
                                <table class="tableCI">
                                    <tr>
                                        <td class="hedertableCI">Nombre:</td>
                                        <td class="hedertableCI">Dirección:</td>
                                        <td class="hedertableCI">ID Cliente:</td>
                                    </tr>
                                    <tr>
                                        <td><input type="text" name="clientName" required></td>
                                        <td><input type="text" name="clientAddress" required></td>
                                        <td><input type="text" name="clientId" required></td>
                                    </tr>
                                    <tr>
                                        <td class="hedertableCI">Apellido:</td>
                                        <td class="hedertableCI">Teléfono:</td>
                                    </tr>
                                    <tr>
                                        <td><input type="text" name="clientLastName" required></td>
                                        <td><input type="tel" name="clientPhone" required></td>
                                    </tr>
                                </table>
                            </div>
                            <hr>
                            <div>
                                <p class="CI">Items</p>
                                <div id="itemsContainer">
                                    <table class="tableitensnewinvoice">
                                        <thead>
                                            <tr>
                                                <th><label for="itemId">ID</label></th>
                                                <th><label for="itemName">Nombre</label></th>
                                                <th><label for="units">Unidades</label></th>
                                                <th><label for="unitPrice">V/U</label></th>
                                                <th><label for="totalPrice">V/T</label></th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td><input type="text" class="itemId" name="itemId[]" required></td>
                                                <td><input type="text" class="itemName" name="itemName[]" required></td>
                                                <td><input type="number" class="units" name="units[]" required></td>
                                                <td><input type="number" class="unitPrice" name="unitPrice[]" required></td>
                                                <td><input type="number" class="totalPrice" name="totalPrice[]" required readonly></td>
                                                <td><button type="button" class="deleteItemButton">Delete</button></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <button type="button" id="addItemButton" class="save">Agregar Artículo</button>
                            </div>
                            <hr>
                            <div class="inftotal">
                                <p><span class="subtotal">Sub total: </span>$<span id="subtotal">0</span></p>
                                <p><span class="subtotal">TAX: </span>$<span id="tax">0</span></p>
                                <p><span class="subtotal">Total: </span>$<span id="total">0</span></p>
                            </div>
                            <button type="submit" class="save">Save</button>
                        </form>
                    </div>
                </dialog>
                <hr>
                <span class="titletotal">Invoiced</span>
                <span class="buttontotal">Total: <span class="totalinvoice">$582.459.65</span></span>

            </div>  
        </div>


        
               
    </section>

    <script src="scriptmodal.js"></script>

</body>
</html>