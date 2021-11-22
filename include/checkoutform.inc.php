<?php

    if(isset($_POST["submit"]))
    {
        $fname = $_POST["fname"];
        $lname = $_POST["lname"];
        $email = $_POST["email"];
        $address = $_POST["address"];
        $city = $_POST["city"];
        $postcode = $_POST["postcode"];

        require_once 'db.inc.php';
        require_once 'checkoutform_functions.inc.php';



        // ERROR HANDLING
        if(empty_input_checkout($fname, $lname, $email, $address, $city, $postcode) !== false)
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

        if(invalid_email($email) !== false)
        {
            header("location: ../checkoutform.php?error=invalidEmail");
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

        header("location: checkout.inc.php");
        exit();

    }
    else
    {
        header("location: ../checkoutform.php");
        exit();
    }
