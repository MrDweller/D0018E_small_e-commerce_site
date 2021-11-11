<?php
    require_once 'include/product_functions.inc.php';

    // $amount_type says what kind of quantities to display, 0 = 'In stock' and 1 = 'In cart'
    function display_product($conn, $productID, $amount_type) 
    {
        $row = get_product($conn, $productID);
        ?>
        <div class="col-1">
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
                        if($amount_type === 0)
                        {
                            echo 'In stock ';
                            echo get_product_entry($conn, $productID);

                        }
                        else if($amount_type === 1)
                        {
                            echo 'In cart ';
                            $usersID = $_SESSION['userid'];
                            echo check_cart_entry($conn, $usersID, $productID);
                        }
                        else 
                        {
                            echo 'ERROR: INVALID AMOUNT TYPE IN PRODUCT_FUNCTIONS!!!';
                        }
                        
                    ?>
                </p>
            </div>
        <?php
    }

    function display_products_productIDs($conn, $productIDs, $title, $amount_type)
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
                        display_product($conn, $id, $amount_type);

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