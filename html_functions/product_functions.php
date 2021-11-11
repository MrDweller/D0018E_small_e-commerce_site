<?php

    require_once 'include/product_functions.inc.php';

    // $display_type says what way to display, 1 = product page and 0 = cart page
    function display_product($conn, $productID, $display_type) 
    {
        $row = get_product($conn, $productID);

        ?>
        <div class="col-<?php echo $display_type?>">
                <a href="include/add_to_cart.inc.php?product=<?php echo $productID;?>"> 
                    <img src=
                        <?php 
                            echo $row['image'];
                        ?>
                    > 
                </a>
                
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
                <p>
                    <?php
                        
                        echo 'In stock: ';
                        echo get_product_entry($conn, $productID);
                        if($display_type === 0)
                        {
                            
                            $usersID = $_SESSION['userid'];

                            ?>
                                <form action="include/alter_cart.inc.php?minus=<?php echo $productID; ?>" method="post">
                                    <button id="incart" class="btn" type="submit">-</button>
                                </form>
                                    <?php
                                        echo check_cart_entry($conn, $usersID, $productID);
                                    ?>
                                <form action="include/alter_cart.inc.php?plus=<?php echo $productID; ?>" method="post">
                                    <button id="incart" class="btn" type="submit">+</button>
                                </form>
                            <?php
                        }
                        else if($display_type !== 1 && $display_type !== 0)
                        {
                            echo 'ERROR: INVALID AMOUNT TYPE IN PRODUCT_FUNCTIONS!!!';
                        }
                        
                    ?>
                </p>
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