<?php

    session_start();

    if(isset($_SESSION["userid"]))
    {
        require_once 'db.inc.php';
        require_once 'cart_functions.inc.php';

        $usersID = $_SESSION["userid"];

        if(isset($_GET["prodID"]))
        {
            $productID = $_GET["prodID"];

            if(isset($_GET["minus"]))
            {
                $amount = check_cart_entry($conn, $usersID, $productID);
                alter_cart_amount($conn, $usersID, $productID, ($amount - 1));
            }

            if(isset($_GET["plus"]))
            {
                $amount = check_cart_entry($conn, $usersID, $productID);
                alter_cart_amount($conn, $usersID, $productID, ($amount + 1));
            }
            
            header("location: ../cart.php");
            exit();
        }
    }
    else 
    {
        header("location: ../login.php");
        exit();
    }