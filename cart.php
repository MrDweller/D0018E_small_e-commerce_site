<?php

    include_once 'header.php';

    if(isset($_SESSION["useruid"]))
    {
        require_once 'include/db.inc.php';
        require_once 'include/cart_functions.inc.php';
        require_once 'html_functions/product_functions.php';

        $usersID = $_SESSION["userid"];
        
        $productIDs = get_productIDs_from_cart($conn, $usersID);

        display_products_productIDs($conn, $productIDs, "Shopping Cart", 1);
    }
    else 
    {
        header("location: login.php");
        exit();
    }

    ?>
        <a id="checkout" class="btn" href="include/checkout.inc.php"> Checkout </a>
        
        

    <?php


    include_once 'footer.php';
?>