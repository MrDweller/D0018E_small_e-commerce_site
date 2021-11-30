<?php
    session_start();
    if(isset($_SESSION["admin"]))
    {
        if(isset($_POST["submit"]))
        {
            require_once 'db.inc.php';
            require_once 'admin_functions.inc.php';
            require_once 'product_functions.inc.php';
            require_once 'login_functions.inc.php';
            
            $product_name = $_POST["product_name"];
            $product_price = $_POST["product_price"];
            $product_quantity = $_POST["product_quantity"];
            $img = $_POST["img"];
            $target_dir = "../media/";
            $filepath = $target_dir . $img;
            
            
            $product_description = $_POST["product_description"];
            
            if(emptyInput_product($product_name, $product_price, $product_quantity, $img, $product_description))
            {
                echo "empty\n";
            }
            
            if(invalid_text($product_name))
            {
                echo "invalid name\n";
            }

            if(invalid_num($product_price))
            {
                echo "invalid number\n";
            }

            if(invalid_num($product_quantity))
            {
                echo "invalid quantity\n";
            }

            if(invalid_text($product_description))
            {
                echo "invalid description\n";
            }
        }
    }
    else 
    {
        header("location: ../index.php");
        exit();
    }
?>