
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
            <h3 class="titlepage">Clients</h3>
            
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

                    <div class="itemslist">
                        <div class="topside">
                            <span>Client ID #0125635</span>              
                            <button id="showmodal" class="fa fa-eye"></button>
                        </div>
                        <div class="buttonside">
                            <table class="tableitens">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Last Name</th>
                                        <th>Address</th>
                                        <th>Phone</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Rick</td>
                                        <td>grill</td>
                                        <td>45 tgonmson st</td>
                                        <td>0415874523</td>
                                    </tr>
                                </tbody>
                            </table>
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
                                <span class="invoicedate">Client Since: 11/12/2024</span>
                            </div>
                            <div>
                                <p class="CI">Customer Information</p>

                                <table class="tableCI">
                                    <tr>
                                      <td class="hedertableCI">Name:</td>
                                      <td class="hedertableCI" >Address:</td>
                                      <td class="hedertableCI" >Client ID:</td>
                                    </tr>
                                    <tr>
                                      <td>Barto</td>
                                      <td>333 Elizabeth St</td>
                                      <td>1253</td>
                                    </tr>
                                    <tr>
                                        <td class="hedertableCI" >Last Name:</td>
                                        <td class="hedertableCI" >Phone:</td>
                                    </tr>
                                      <tr>
                                        <td>smith</td>
                                        <td>+61 458 256 257</td>
                                      </tr>
                                  </table>                                  
                            </div>
                            <hr>
                            <div>
                               <p class="CI">Invoices</p>
                                    <table class="tableitens">
                                        <thead>
                                            <tr>
                                                <th>Invoice</th>
                                                <th>Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>00011</td>
                                                <td>15/06/2021</td>
                                            </tr>
                                        </tbody>
                                    </table>
                            </div>
                    </dialog>

                    <div class="itemslist">
                        <div class="topside">
                            <span>order #0125635</span>
                            <span class="invoicedate">11/12/2024</span>
                            <span class="fa fa-eye"></span>
                        </div>
                        <div class="buttonside">
                            <span>Yank Aldana</span>
                            <span class="invoiceprice">$4586</span>
                        </div>
                    </div>

                                                            

                </div>

            </div> 


            <div class="columnB"> 

                <button id="showmodalclient">New Client <span class="fa fa-user"></span></button>
             

                <dialog id="modalclient">
                    <div class="popup-header">
                        <span class="save">Save</span>
                        <span class="close-btn" id="closemodalclient">&times;</span>
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
                                        <table class="tableitens">
                                            <thead>
                                                <tr>
                                                    <th>Invoice</th>
                                                    <th>Date</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>00011</td>
                                                    <td>15/06/2021</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </table>
                            <hr>
                            
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