<?php
    include_once 'header.php';

    if(isset($_GET["product"]))
    {
        require_once 'include/db.inc.php';
        require_once 'html_functions/product_functions.php';

        $productID = $_GET["product"];
        ?>
            <div class="center_div">
                <?php
                    display_product($conn, $productID, 5);
                ?>
            </div>
        <?php
        
        require_once 'html_functions/review_functions.php';

        display_reviews($conn, $productID);
    }
    else
    {
        header("location: products.php");
        exit();
    }
?>

<?php
    include_once 'footer.php';
?>