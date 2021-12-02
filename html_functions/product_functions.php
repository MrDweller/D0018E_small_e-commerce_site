<?php

    require_once 'include/product_functions.inc.php';

    // $display_type says what way to display, 1 = product page and 0 = cart page, 2 = product page
    function display_product($conn, $productID, $display_type) 
    {
        $row = get_product($conn, $productID);

        ?>
        <div class="col-<?php echo $display_type?>">
                <button class="img_btn" onclick="button_press('product_page.php?product=<?php echo $productID;?>')"><img src=<?php echo $row['image']; ?>> </button> 
                
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
                        require_once 'include/review_functions.inc.php';
                        $average_rating = get_average_rating($conn, $productID);
                        if($average_rating)
                        {
                            for($i = 0; $i < $average_rating; $i++)
                            {
                                ?>
                                <i class="fa fa-smile-o"></i>
                                <?php
                            }
                        }
                        
                    ?>
                </div>
                <p>
                    <?php
                        echo $row['price'];
                    ?>
                SEK</p>
                <p>
                    <?php
                        echo 'In stock: ';
                        echo get_product_entry($conn, $productID);   
                    ?>     
                </p>

                <?php
                    if($display_type === 1 || $display_type === 2)
                    {
                        ?>
                            <button class="btn" onclick="button_press_scroll('include/add_to_cart.inc.php?product=<?php echo $productID;?>')">Add to cart</button> 
                        <?php
                    }

                    if($display_type === 0)
                    {
                        
                        $usersID = $_SESSION['userid'];

                        ?>
                            <button onclick="button_press_scroll('include/alter_cart.inc.php?prodID=<?php echo $productID; ?>&minus')" class="btn" >-</button>
                            <?php
                                echo check_cart_entry($conn, $usersID, $productID);
                            ?>
                            <button onclick="button_press_scroll('include/alter_cart.inc.php?prodID=<?php echo $productID; ?>&plus')" class="btn" >+</button>
                        <?php
                    }
                    else if($display_type !== 1 && $display_type !== 0 && $display_type !== 2)
                    {
                        echo 'ERROR: INVALID AMOUNT TYPE IN PRODUCT_FUNCTIONS!!!';
                    }
                      
                ?>
                
            </div>
        <?php
    }

    function display_products_productIDs($conn, $productIDs, $title, $display_type)
    {
        ?>
        <div class="small-container">
            <h2 id="title"> 
                <?php   
                    echo $title;
                ?>
            </h2>

                <div class="row">
                    <?php
                    for($i = 0; $i < sizeof($productIDs); $i++)
                    {
                        $id = $productIDs[$i];
                        display_product($conn, $id, $display_type);

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

<?php
    }
?>