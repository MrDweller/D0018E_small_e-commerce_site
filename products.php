<?php
    include_once 'header.php';
    require_once 'include/db.inc.php';
    require_once 'include/product_functions.inc.php';

    $ORDER_NONE = '';
    $ORDER_RATING = 'ORDER BY rating DESC';
    $ORDER_PRICE_ASC = 'ORDER BY price ASC';
    $ORDER_PRICE_DESC = 'ORDER BY price DESC';
    
    function display_product($conn, $productID)
    {
        

        $row = get_product($conn, $productID);
        ?>
        <div class="col-1">
                <img src=
                    <?php 
                        echo $row['image'];
                    ?>
                >
                <h3>
                    <?php
                        echo $row['productName'];
                    ?>
                </h3>
                <div>
                    <?php
                        echo $row['description'];
                    ?>
                </div>
                <div class="rating">
                    <?php
                        for($i = 0; $i < $row['rating']; $i++)
                        {
                            ?>
                            <i class="fa fa-smile-o"></i>
                            <?php
                        }
                    ?>
                </div>
                <p>
                    <?php
                        echo $row['price'];
                    ?>
                SEK</p>
            </div>
        <?php
    }
?>

<!-- we're on the aliroad guys, buy som aliwareZ -->
    <div class="categories">
        <div class="small-container">
            <h2 id="title">Top Products </h2>
            <div class="row">
                <div class="col-3">
                    <img src="media/feature1.jpg">
                </div>
                <div class="col-3">
                    <img src="media/feature2.jpg" width="10px">
                </div>
                <div class="col-3">
                    <img src="media/feature3.jpg">
                </div>
            </div>
        </div>
    </div>

    <!-- WORKS, men flytta och utvidga?? -->
    <div class="dropdown">
        <button class="dropbtn">Sort By</button>
            <div class="dropdown-content">
                <a href="products.php?order=PriceASC">Price (Ascending)</a>
                <a href="products.php?order=PriceDESC">Price (Descending)</a>
                <a href="products.php?order=Rating">Rating</a>
            </div>
    </div>

    <!-- features products -->
    <div class="small-container">
        <h2 id="title">Want some buy?</h2>
        <div class="row">
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
                for($i = 0; $i < sizeof($productIDs); $i++)
                {
                    $id = $productIDs[$i];
                    display_product($conn, $id);

                    // if a row is full
                    if(($i + 1) % 4 === 0)
                    {
                        ?>
                                </div>
                            </div>
                            <div class="small-container">
                                <div class="row">
                        <?php
                    }
                }
                
            ?>
        </div>
    </div>

    <!-- offer section -->
    <div class="row">
        <div class="col-2">
            <h1>Walk on down the Aliroad :)</h1>
            <p>BUY a pair of yellow sneakers for your legs!</p>
            <a href="" class="btn"> BUY NOW FOR ONLY 666 SEK&#8594; </a>
        </div>
        <div class="col-2">
            <h1> Walk with us </h1>
            <img src="media/ysneaks.jpg">
            <h1>BUY NOW ONLY FOR 666 SEK NOW, THIS IS ALI!</h1>
        </div>
    </div>


<?php
    include_once 'footer.php';
?>