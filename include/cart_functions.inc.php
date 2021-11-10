<?php  
    function products_exists($conn, $productID)
    {
        $sql = "SELECT productID FROM products WHERE productID = $productID;";

        $result = mysqli_query($conn, $sql);

        $resultCheck = mysqli_num_rows($result);

        if($resultCheck > 0)
        {
            return true;
        } 

        return false;
    }

    function check_cart_entry($conn, $usersID, $productID)
    {
        $sql = "SELECT amount FROM cart WHERE users_usersID = $usersID AND products_productID = $productID;";

        $result = mysqli_query($conn, $sql);

        $resultCheck = mysqli_num_rows($result);

        $row = mysqli_fetch_assoc($result);

        if($resultCheck > 0)
        {
            return $row['amount'];
        } 

        return 0;
    }

    function add_to_cart($conn, $usersID, $productID, $amount)
    {
        $sql = "INSERT INTO cart (users_usersID, products_productID, amount) VALUES ($usersID, $productID, $amount);";
        
        if (mysqli_query($conn, $sql)) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }

    function alter_cart_amount($conn, $usersID, $productID, $amount)
    {
        $sql = "UPDATE cart SET amount = $amount WHERE users_usersID = $usersID AND products_productID = $productID;";
        
        if (mysqli_query($conn, $sql)) {
            echo "Record updated successfully";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }

    function get_productIDs_from_cart($conn, $usersID)
    {
        $sql = "SELECT products_productID FROM cart WHERE users_usersID = $usersID;";

        $result = mysqli_query($conn, $sql);

        $resultCheck = mysqli_num_rows($result);

        $data = array();

        if($resultCheck > 0)
        {
            $i = 0;
            while($row = mysqli_fetch_array($result))
            {
                $data[$i] = $row[0];
                $i++;
            }
        }
        
        return $data;
    }

    function get_amount_in_cart($conn, $usersID)
    {
        $sql = "SELECT amount FROM cart WHERE users_usersID = $usersID;";

        $result = mysqli_query($conn, $sql);

        $resultCheck = mysqli_num_rows($result);


        $amount = 0;
        if($resultCheck > 0)
        {
            $i = 0;
            
            while($row = mysqli_fetch_assoc($result))
            {
                $amount += $row['amount'];
                $i++;
            }
            
        } 

        return $amount;
    }