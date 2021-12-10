<?php

    if(isset($_SESSION["userid"]))
    {
        require_once 'db.inc.php';
        require_once 'product_functions.inc.php';
        require_once 'shop_history_functions.inc.php';
        require_once 'review_functions.inc.php';

        $usersID = $_SESSION["userid"];

        $data = get_shop_history($conn, $usersID);
        $shop_hist = array();
        $reviews = get_users_reviews($conn, $usersID);

        $index = 0;
        for($i = 0; $i < sizeof($data); $i+=4)
        {
            $productName = get_product_name($conn, $data[$i]);

            $shop_hist[$index] = [$productName, $data[$i + 1], $data[$i + 2], $data[$i], $data[$i + 3]];
            $index ++;
        }
    }
    else 
    {
        header("location: index.php");
        exit();
    }