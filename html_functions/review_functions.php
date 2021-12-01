<?php

    require_once 'include/product_functions.inc.php';

    function display_reviews($conn, $productID)
    {
        ?>
            <div class="review_div">
                <h1>Reviews</h1>
                <?php
                    for($i = 0; $i < 10; $i++)
                    {
                        ?>
                            <div class="review">
                                
                                    <h2>Frank</h2>
                                    <div class="rating">
                                        <?php
                                            for($j = 0; $j < 5; $j++)
                                            {
                                                ?>
                                                <i class="fa fa-smile-o"></i>
                                                <?php
                                            }
                                        ?>
                                    </div>
                                    <p>Jag är inte dum, jag har bara otur när jag tänker.</p><br>
                                    
                            </div>
                        <?php
                    }
                ?>
            </div>
        <?php
    }