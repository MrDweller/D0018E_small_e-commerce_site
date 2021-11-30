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

    function get_featured_products($conn, $sql_FEATURED_IDENTITY)
    {
        $sql_Max_Identity = "SELECT MAX($sql_FEATURED_IDENTITY) FROM products;";

        $result_Identity = mysqli_query($conn, $sql_Max_Identity);
        $row_Identity  = mysqli_fetch_array($result_Identity);

        $sql = "SELECT productID FROM products WHERE $sql_FEATURED_IDENTITY = $row_Identity[0]";

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


    //ADMIN ERROR FOR ADDNING 

    function emptyInput_product($product_name, $product_price, $product_quantity, $img, $product_description)
    {
        $result = null;

        if(empty($product_name) || empty($product_price) || empty($product_quantity) || empty($img) || empty($product_description))
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

