<?php
    function get_product($conn, $productID)
    {
        $sql = "SELECT * FROM products WHERE products.productID = $productID;";

        $result = mysqli_query($conn, $sql);
        $row  = mysqli_fetch_assoc($result);
        return $row;
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