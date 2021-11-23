<?php

    session_start();

    if(isset($_POST["submit"]))
    {
        $fname = $_POST["fname"];
        $lname = $_POST["lname"];
        $address = $_POST["address"];
        $city = $_POST["city"];
        $postcode = $_POST["postcode"];

        require_once 'db.inc.php';
        require_once 'checkoutform_functions.inc.php';

        // ERROR HANDLING
        if(empty_input_checkout($fname, $lname, $address, $city, $postcode) !== false)
        {
            header("location: ../checkoutform.php?error=emptyinput");
            exit();
        }

        if(invalid_name($fname) !== false)
        {
            header("location: ../checkoutform.php?error=invalidFname");
            exit();
        }

        if(invalid_name($lname) !== false)
        {
            header("location: ../checkoutform.php?error=invalidLname");
            exit();
        }

        if(invalid_address($address) !== false)
        {
            header("location: ../checkoutform.php?error=invalidAddress");
            exit();
        }

        if(invalid_city($city) !== false)
        {
            header("location: ../checkoutform.php?error=invalidCity");
            exit();
        }

        if(invalid_postcode($postcode) !== false)
        {
            header("location: ../checkoutform.php?error=invalidPostcode");
            exit();
        }

        if(isset($_SESSION["userid"]))
        {
            $usersID = $_SESSION["userid"];

            if(check_billing_info_exists($conn, $usersID))
            {
                update_billing_info($conn, $usersID, $fname, $lname, $city, $address, $postcode);
            }
            else 
            {
                add_to_billing_info($conn, $usersID, $fname, $lname, $city, $address, $postcode);
            }

            header("location: checkout.inc.php");
            exit();
        }

        header("location: ../login.php");
        exit();

    }
    else
    {
        header("location: ../checkoutform.php");
        exit();
    }
