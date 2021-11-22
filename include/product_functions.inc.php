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

