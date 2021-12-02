<?php

    function get_product($conn, $productID)
    {
        $sql = "SELECT * FROM products WHERE products.productID = $productID;";

        $result = mysqli_query($conn, $sql);
        $row  = mysqli_fetch_assoc($result);
        return $row;
    }

    function get_product_name($conn, $productID)
    {
        $sql = "SELECT productName FROM products WHERE products.productID = $productID;";

        $result = mysqli_query($conn, $sql);
        $row  = mysqli_fetch_assoc($result);
        return $row['productName'];
    }

    function get_productIDs($conn, $sql_ORDER_BY)
    {
        if($sql_ORDER_BY == 'rating')
        {
            require_once 'review_functions.inc.php';
            $productIDs = get_productIDs($conn, '');
            return sort_productIDs_by_rating($conn, $productIDs);
        }
        $sql = "SELECT productID FROM products $sql_ORDER_BY;";

        $result = mysqli_query($conn, $sql);
        $resultCheck = mysqli_num_rows($result);

        $data = array();

        if($resultCheck > 0)
        {
            $i = 0;
            while($row  = mysqli_fetch_array($result))
            {
                $data[$i] = $row[0];
                $i++;
            }
        }
        
        return $data;
        
    }

    // $sql_FEATURED_IDENTITY says which products to get, $sql_FEATURED_IDENTITY = 0, best rating, $sql_FEATURED_IDENTITY = 1, quantity
    function get_featured_products($conn, $sql_FEATURED_IDENTITY)
    {
        if($sql_FEATURED_IDENTITY == 0)
        {
            require_once 'review_functions.inc.php';
            
            $productIDs = get_productIDs($conn, '');
            return get_top_rated_products($conn, $productIDs, 4);
        }
        else if($sql_FEATURED_IDENTITY == 1)
        {
            $sql_Max_Identity = "SELECT MAX(quantity) FROM products;";

            $result_Identity = mysqli_query($conn, $sql_Max_Identity);
            $row_Identity  = mysqli_fetch_array($result_Identity);
    
            $sql = "SELECT productID FROM products WHERE quantity = $row_Identity[0]";
    
            $result = mysqli_query($conn, $sql);
            $resultCheck = mysqli_num_rows($result);
    
            $data = array();
    
            if($resultCheck > 0)
            {
                $i = 0;
                while($row  = mysqli_fetch_array($result))
                {
                    $data[$i] = $row[0];
                    $i++;
                }
            }
            
            return $data;
        }
        else 
        {
            return false;
        }

       
    }

    function get_product_entry($conn, $productID)
    {
        $sql = "SELECT quantity FROM products WHERE productID = $productID;";

        $result = mysqli_query($conn, $sql);

        $resultCheck = mysqli_num_rows($result);

        $row = mysqli_fetch_assoc($result);

        if($resultCheck > 0)
        {
            return $row['quantity'];
        } 

        return 0;
    }

    function alter_product_quantity($conn, $productID, $amount)
    {
        $sql = "UPDATE products SET quantity = $amount WHERE productID = $productID;";
        
        if (mysqli_query($conn, $sql)) {
            echo "Record updated successfully";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }

    function add_product($conn, $product_name, $img, $product_price, $product_description, $product_quantity)
    {
    
        $sql = "INSERT INTO products (productName, image, price, description, quantity) VALUES (?, ?, ?, ?, ?);";
        $stmt = mysqli_stmt_init($conn);

        if(!mysqli_stmt_prepare($stmt, $sql))
        {
            header("location: ../product_settings.php?error=stmtFailed");
            exit();
        }

        mysqli_stmt_bind_param($stmt, "ssisi", $product_name, $img, $product_price, $product_description, $product_quantity);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

    }


    //ADMIN ERROR FOR ADDNING 

    function emptyInput_product($product_name, $product_price, $product_quantity, $img)
    {
        $result = null;

        if(empty($product_name) || empty($product_price) || empty($product_quantity) || empty($img))
        {
            $result = true;
        }
        else
        {
            $result = false;
        }
        return $result;
    }

    function invalid_text($text)
    {
        $result = null;

        if(!preg_match("/^\pL+$/u", $text))
        {
            $result = true;
        }
        else
        {
            $result = false;
        }

        return $result;
    }

    function invalid_num($num)
    {
        $result = null;

        if(!preg_match("/^[0-9]*$/", $num))
        {
            $result = true;
        }
        else
        {
            $result = false;
        }

        return $result;
    }

