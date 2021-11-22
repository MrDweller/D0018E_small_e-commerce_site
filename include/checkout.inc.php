<?php

    session_start();

    if(isset($_SESSION["userid"]))
    {
        require_once 'db.inc.php';
        require_once 'cart_functions.inc.php';

        $usersID = $_SESSION["userid"];
        $productIDs = get_productIDs_from_cart($conn, $usersID);

        if(sizeof($productIDs) > 0)
        {
            if(checkout($conn, $usersID, $productIDs, 0))
            {
                require_once 'shop_history_functions.inc.php';
                save_to_shop_history($conn, $usersID, $productIDs);
                empty_cart($conn, $usersID, $productIDs);
                header("location: ../checkout.php?success=true");
                exit();
            }
            else 
            {
                header("location: ../checkout.php?success=false");
                exit();
            }
        }
        else 
        {
            header("location: ../checkout.php?success=NULL");
            exit();
        }
    }
    else 
    {
        header("location: ../login.php");
        exit();
    }