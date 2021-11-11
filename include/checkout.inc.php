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