<?php

    session_start();

    if(isset($_SESSION["admin"]))
    {
        require_once 'db.inc.php';
        require_once 'product_functions.inc.php';

        if(isset($_GET["prodID"]))
        {
            $productID = $_GET["prodID"];

            $new_price = $_POST["new_price"];
            alter_product_price($conn, $productID, $new_price);

            
            header("location: ../product_settings.php");
            exit();
        }
    }
    else 
    {
        header("location: ../index.php");
        exit();
    }