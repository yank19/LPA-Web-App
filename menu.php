<ul class="menu">
            <li><img src="" alt=""><a class="itens" id="nameUser"> <span class="fa fa-user-circle"></span> <?php echo htmlspecialchars($firstname . ' ' . $lastname); ?></a></li>
            <br>
            <br>
            <br>
            <br><br>
            <br>
            <br>
            <li><a class="itens" href="dashboard.php"><span class="fa fa-home"></span> Home</a></li>
            <li><a class="itens" href="stock.php"><span class="fa fa-cube"></span> Stock</a></li>
            <li><a class="itens" href="#"><span class="fa fa-line-chart"></span> Sales</a></li>
            <?php if ($_SESSION['role'] == 'admin') { ?>
        <li><a class="itens" href="invoice.php"><span class="fa fa-book"></span> invoices</a></li>
        <li><a class="itens" href="clients.php"><span class="fa fa-users"></span> clients</a></li>
             <?php } ?>
            <br><br>
            
            <?php if ($_SESSION['role'] == 'admin') { ?>
       
        
        <li><a class="itensbutton" href="#"><span class="fa fa-cog"></span> System Admin.</a></li>
        <li><a class="itensbutton" href="user_management.php"><span class="fa fa-pencil"></span> User Management</a></li>
             <?php } ?>
          
            <li><a class="itensbutton" href="#"><span class="fa fa-question-circle"></span> Help</a></li>
            <li><a class="itensbutton" href="#"> <span class="fa fa-info-circle"></span> About</a></li>
            <li><a class="itensbutton" href="#"><span class="fa fa-address-book"></span> User Guide</a></li>
            <li><a class="itensbutton" href="logout.php"><span class="fa fa-sign-out"></span> Log out</a></li>
</ul>
    