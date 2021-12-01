<?php

    session_start();    

    if(isset($_SESSION["userid"]))
    {
        if(isset($_POST["submit"]))
        {
            require_once 'db.inc.php';
            require_once 'review_functions.inc.php';

            $productID = $_POST["productID"];
            $usersID = $_SESSION["userid"];
            $review = $_POST["review"];
            $rating = $_POST["rating"];

            if(empty($review))
            {
                header("location: account.php");
                exit();
            }

            if(review_exist($conn, $productID, $usersID))
            {
                if(edit_review($conn, $productID, $usersID, $review, $rating))
                {
                    echo "EDITED REVIEW SUCCESSFULLY";
                }
                else 
                {
                    echo "FAIL";
                }
            }
            else 
            {
                if(add_review($conn, $productID, $usersID, $review, $rating))
                {
                    echo "SUCCESSFULLY MADE A NEW REVIEW";
                }
                else 
                {
                    echo "FAIL";
                }
            }
            

        }
        else 
        {
            echo "no submit";
        }
        
    }
    else 
    {
        header("location: ../login.php");
        exit();
    }
?>