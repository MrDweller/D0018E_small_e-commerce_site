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
            $product_description = $_POST["product_description"];
            $uploaded = true;
            

            $target_dir = "../media/";
            $file = basename($_FILES["img"]["name"]);
            $filepath = $target_dir . $file;
            
            $check = getimagesize($_FILES["img"]["tmp_name"]);
            if($check !== false) {
                echo "File is an image - " . $check["mime"] . ". ";
                $uploaded = true;
            } else {
                echo "File is not an image.";
                $uploaded = false;
            }

            // Check if file already exists
            if (file_exists($filepath)) 
            {
                echo "Sorry, file already exists.";
                $uploaded = false;
            }

            // Check file size, not > 600KB
            if ($_FILES["img"]["size"] > 600000) 
            {
                echo "Sorry, your file is too large.";
                $uploaded = false;
            }

            // Allow certain file formats
            $image_file_type = strtolower(pathinfo($filepath, PATHINFO_EXTENSION));
            if($image_file_type != "jpg" && $image_file_type != "png" && $image_file_type != "jpeg") 
            {
                echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                $uploaded = false;
            }


            if(emptyInput_product($product_name, $product_price, $product_quantity, $file))
            {
                echo "empty\n";
                header("location: ../product_settings.php?error=emptyInput");
                exit(); 
            }
            
            if(invalid_text($product_name))
            {
                echo "invalid name\n";
                header("location: ../product_settings.php?error=invalidName");
                exit(); 
            }

            if(invalid_num($product_price))
            {
                echo "invalid number\n";
                header("location: ../product_settings.php?error=invalidPrice");
                exit(); 
            }

            if(invalid_num($product_quantity))
            {
                echo "invalid quantity\n";
                header("location: ../product_settings.php?error=invalidQuantity");
                exit(); 
            }

            // Check if $uploaded is set to false by an error
            if ($uploaded == false) 
            {
                echo "Sorry, your file was not uploaded.";
                header("location: ../product_settings.php?error=imgUploadFailed");
                exit(); 
            // if everything is ok, try to upload file
            } 
            else 
            {
                if (move_uploaded_file($_FILES["img"]["tmp_name"], $filepath)) 
                {
                    echo "The file ". htmlspecialchars(basename($_FILES["img"]["name"])). " has been uploaded.";
                } 
                else 
                {
                    echo "Sorry, there was an error uploading your file.";
                    header("location: ../product_settings.php?error=imgUploadFailed");
                    exit();
                }
            }

            add_product($conn, $product_name, "media/".$file, $product_price, $product_description, $product_quantity);
            
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