<?php
    include_once 'header.php';
    require_once 'include/db.inc.php';
    require_once 'html_functions/product_functions.php';
?>
    <!-- welcome section -->
    <div class="row">
        <div class="col-2">
            <h1>WELCOME TO ALIROAD!</h1>
            <p>Enjoy our varied selection of the finest wares of all the different roads there is, we are Aliroad! </p>
            <a href = 'products.php' class="btn"> Lets go! &#8594; </a>
        </div>
        <div class="col-2">
            <img src="media/aliware_logo.png">
            <h2> Aliwares are for everyone, go ahead and check it out!</h2>
        </div>
    </div>
    <br>

    <!-- TOP products -->
    <?php
        $productIDs = get_featured_products($conn, 0);
        display_products_productIDs($conn, $productIDs, 'Top Products', 1);
    ?>
    
    <!-- features products -->
    <?php
        $productIDs = get_featured_products($conn, 1);
        display_products_productIDs($conn, $productIDs, 'Featured Products', 1);
    ?>

    <!-- footer -->
    <?php
        include_once 'footer.php'
    ?>