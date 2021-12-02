<?php

    require_once 'include/product_functions.inc.php';

    function display_reviews($conn, $productID)
    {
        ?>
            <div class="review_div">
                <h1>Reviews</h1>
                <?php
                    require_once 'include/review_functions.inc.php';
                    $reviews = get_all_reviews($conn, $productID);

                    if($reviews === false)
                    {
                        exit();
                    }
                    
                    for($i = 0; $i < sizeof($reviews); $i += 3)
                    {
                        require_once 'include/users_functions.inc.php';
                        

                        $usersID = $reviews[$i];
                        $userUID = get_username($conn, $usersID);

                        ?>
                            <div class="review">

                                    <h2><?php echo $userUID["usersUID"]?></h2>
                                    <div class="rating">
                                        <?php
                                            for($j = 0; $j < $reviews[$i+2]; $j++)
                                            {
                                                ?>
                                                <i class="fa fa-smile-o"></i>
                                                <?php
                                            }
                                        ?>
                                    </div>
                                    <p><?php echo ("<xmp>" . $reviews[$i + 1] . "</xmp>");?></p><br>
                                    
                            </div>
                        <?php
                    }
                ?>
            </div>
        <?php
    }