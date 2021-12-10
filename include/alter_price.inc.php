<?php

    session_start();

    if(isset($_SESSION["admin"]))
    {
        require_once 'db.inc.php';
        require_once 'product_functions.inc.php';

        if(isset($_GET["prodID"]))
        {
            $productID = $_GET["prodID"];

            if(isset($_GET["minus"]))
            {
                $price = get_product($conn, $productID)['price'];
                alter_product_price($conn, $productID, ($price - 1));
            }

            if(isset($_GET["plus"]))
            {
                $price = get_product($conn, $productID)['price'];
                alter_product_price($conn, $productID, ($price + 1));
            }
            
            header("location: ../product_settings.php");
            exit();
        }
    }
    else 
    {
        header("location: ../index.php");
        exit();
    }