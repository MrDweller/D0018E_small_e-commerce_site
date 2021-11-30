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
                $amount = get_product_entry($conn, $productID);
                alter_product_quantity($conn, $productID, ($amount - 1));
            }

            if(isset($_GET["plus"]))
            {
                $amount = get_product_entry($conn, $productID);
                alter_product_quantity($conn, $productID, ($amount + 1));
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