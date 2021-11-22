<?php
    include_once 'header.php';
    require_once 'include/db.inc.php';
    require_once 'include/product_functions.inc.php';
    require_once 'html_functions/product_functions.php';

    $ORDER_NONE = '';
    $ORDER_RATING = 'ORDER BY rating DESC';
    $ORDER_PRICE_ASC = 'ORDER BY price ASC';
    $ORDER_PRICE_DESC = 'ORDER BY price DESC';
    
?>

    <!-- Top products -->
    <?php
        $productIDs = get_featured_products($conn, 'rating');
        display_products_productIDs($conn, $productIDs, 'Top Products', 1);
    ?>

    <div class="dropdown">
        <button class="dropbtn">Sort By</button>
            <div class="dropdown-content">
                <a href="products.php?order=PriceASC">Price (Ascending)</a>
                <a href="products.php?order=PriceDESC">Price (Descending)</a>
                <a href="products.php?order=Rating">Rating</a>
            </div>
    </div>
    
    <?php    
        $order = $ORDER_NONE;
        if(isset($_GET["order"]))
        {
            if($_GET["order"] == "PriceASC")
            {
                $order = $ORDER_PRICE_ASC;
            }
            if($_GET["order"] == "PriceDESC")
            {
                $order = $ORDER_PRICE_DESC;
            }
            if($_GET["order"] == "Rating")
            {
                $order = $ORDER_RATING;
            }
        }
        $productIDs = get_productIDs($conn, $order);
        display_products_productIDs($conn, $productIDs, 'Products', 1);
        
    ?>


    <h2 id="title"> Special alioffer </h2>
    <!-- offer section FIIIXXX PROD ID-->
    <div class="row">
        <div class="col-2">
            <h1>Walk on down the Aliroad :)</h1>
            <p>BUY a pair of yellow sneakers for your legs!</p>
            <a href="include/add_to_cart.inc.php?product=<?php echo 9;?>" class="btn"> BUY NOW FOR ONLY 99 SEK </a>
        </div>
        <div class="col-2">
            <h1> Walk with us </h1>
            <img src="media/ysneaks.jpg">
            <h1>BUY NOW ONLY FOR 99 SEK NOW, THIS IS ALI!</h1>
        </div>
    </div>


<?php
    include_once 'footer.php';
?>