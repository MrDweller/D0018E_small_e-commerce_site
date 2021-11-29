<?php
    session_start();
    if(isset($_SESSION["admin"]))
    {
        if(isset($_POST["delete_product"]))
        {
            require_once 'db.inc.php';
            require_once 'admin_functions.inc.php';
            $productID = $_POST["delete_product"];

            delete_product($conn, $productID);

            header("location: ../product_settings.php");
            exit();
        }
    }
    else 
    {
        header("location: ../index.php");
        exit();
    }
?>