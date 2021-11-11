<?php

    session_start();

    if(isset($_SESSION["userid"]))
    {
        require_once 'db.inc.php';
        require_once 'cart_functions.inc.php';

        $usersID = $_SESSION["userid"];

        if(isset($_GET["plus"]))
        {
            echo "Kom in i plus-satsen";
            $productID = $_GET["plus"];
            $amount = check_cart_entry($conn, $usersID, $productID);
            alter_cart_amount($conn, $usersID, $productID, ($amount + 1));
            header("location: ../cart.php");
            exit();
        }
        
        if(isset($_GET["minus"]))
        {
            echo "Kom in i minus-satsen";
            $productID = $_GET["minus"];
            $amount = check_cart_entry($conn, $usersID, $productID);
            alter_cart_amount($conn, $usersID, $productID, ($amount - 1));
            header("location: ../cart.php");
            exit();
        }
    }
    else 
    {
        header("location: ../login.php");
        exit();
    }