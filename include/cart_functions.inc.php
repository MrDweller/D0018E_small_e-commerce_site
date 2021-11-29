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
        $sql = "SELECT products_productID FROM cart WHERE users_usersID = $usersID AND amount > 0;";

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

    function compare_amount_with_stock($conn, $productID, $amount)
    {
        $sql = "SELECT quantity FROM products WHERE productID = $productID;";

        $result = mysqli_query($conn, $sql);

        $resultCheck = mysqli_num_rows($result);

        $row = mysqli_fetch_assoc($result);

        if($resultCheck > 0)
        {
            $amount = $row['quantity'] - $amount;

            if($amount >= 0)
            {
                return true;
            }
        } 

        return false;
    }

    function reserve_product($conn, $productID, $amount)
    {
        require_once 'product_functions.inc.php';

        $quantity = get_product_entry($conn, $productID);

        $sql = "UPDATE products SET quantity = ($quantity - $amount) WHERE productID = $productID;";
        
        if (mysqli_query($conn, $sql)) {
            echo "Record reserved successfully\n";
        } 
        else 
        {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }

    function undo_reserve_product($conn, $productID, $amount)
    {
        require_once 'product_functions.inc.php';

        $quantity = get_product_entry($conn, $productID);

        $sql = "UPDATE products SET quantity = ($quantity + $amount) WHERE productID = $productID;";
        
        if (mysqli_query($conn, $sql)) {
            echo "Record unreserved successfully\n";
        } 
        else
        {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }

    function delete_from_cart($conn, $usersID, $productID)
    {
        $sql = "DELETE FROM cart WHERE users_usersID = $usersID AND products_productID = $productID;";

        if (mysqli_query($conn, $sql)) {
            echo "Record deleted successfully\n";
        } 
        else 
        {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }

    function empty_cart($conn, $usersID, $productIDs)
    {
        for($i = 0; $i < sizeof($productIDs); $i++)
        {
            delete_from_cart($conn, $usersID, $productIDs[$i]);
        }

    }

    function checkout($conn, $usersID, $productIDs, $i)
    {
        if($i >= sizeof($productIDs))
        {
            return true;
        }

        require_once 'db.inc.php';
        start_transaction($conn);
        
        $amount = check_cart_entry($conn, $usersID, $productIDs[$i]);
        $result = compare_amount_with_stock($conn, $productIDs[$i], $amount);

        if($result === true)
        {
            reserve_product($conn, $productIDs[$i], $amount);
            commit_transaction($conn);
            $int = 1000000000;
            $i = 0;
            while($i < $int)
            {
                $i ++;
            }

            if(checkout($conn, $usersID, $productIDs, $i + 1))
            {
                return true;
            }
            else 
            {
                undo_reserve_product($conn, $productIDs[$i], $amount);
                return false;
            }
        }
        else
        {
            commit_transaction($conn);
            return false;
        }



    }