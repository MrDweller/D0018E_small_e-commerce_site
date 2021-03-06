<?php
    require_once 'cart_functions.inc.php';

    function save_to_shop_history($conn, $usersID, $productIDs)
    {
        for($i = 0; $i < sizeof($productIDs); $i++)
        {
            require_once 'product_functions.inc.php';
            $unit_price = get_product($conn, $productIDs[$i])['price'];

            $amount = check_cart_entry($conn, $usersID, $productIDs[$i]);
            $date = date("Y-m-d H:i:s");
            $sql = "INSERT INTO shopping_history (users_usersID, products_productsID, amount, date_time, unit_price) VALUES ($usersID, $productIDs[$i], $amount, '$date', $unit_price);";
        
            if (mysqli_query($conn, $sql)) {
                echo "New record created successfully";
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
        }
        
    }

    function get_shop_history($conn, $usersID)
    {
        $sql = "SELECT products_productsID, amount, date_time, unit_price FROM shopping_history WHERE users_usersID = $usersID;";

        $result = mysqli_query($conn, $sql);

        $resultCheck = mysqli_num_rows($result);

        $data = array();
        if($resultCheck > 0)
        {
            $i = 0;
            while($row = mysqli_fetch_array($result))
            {
                $data[$i] = $row[0];
                $data[$i + 1] = $row[1];
                $data[$i + 2] = $row[2];
                $data[$i + 3] = $row[3];
                $i+=4;
            }
            
        } 

        return $data;
    }