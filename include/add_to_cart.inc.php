<?php

    if(isset($_GET["product"]))
    {
        require_once 'db.inc.php';
        require_once 'cart_functions.inc.php';

        // ERROR HANDLING

        session_start();

        if(isset($_SESSION["useruid"]))
        {
            $productID = $_GET["product"];
            $result = products_exists($conn, $productID);

            if($result === false)
            {
                header("location: ../products.php");
                exit();
            }

            $usersID = $_SESSION["userid"];

            $amount = check_cart_entry($conn, $usersID, $productID);

            if($amount === 0)
            {
                add_to_cart($conn, $usersID, $productID, 1);
            }
            else 
            {
                alter_cart_amount($conn, $usersID, $productID, $amount + 1);
            }

            header("location: ../products.php");
            exit();
        }
        else 
        {
            header("location: ../login.php");
            exit();
        }
        
    }
    else
    {
        header("location: ../products.php");
        exit();
    }

    