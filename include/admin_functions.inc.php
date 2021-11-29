<?php

    function get_all_users($conn)
    {
        $sql = "SELECT usersID, usersUID, usersEmail FROM users";

        $result = mysqli_query($conn, $sql);

        $resultCheck = mysqli_num_rows($result);

        $data = array();
        if($resultCheck > 0)
        {
            $i = 0;
            while($row = mysqli_fetch_array($result))
            {
                $row_data = array();

                $row_data[0] = $row[0];
                $row_data[1] = $row[1];
                $row_data[2] = $row[2];

                $data[$i] = $row_data;
                $i++;
            }
        }
        return $data;
    }

    function is_admin($conn, $usersID)
    {
        $sql = "SELECT usersID FROM admins WHERE usersID = $usersID;";

        $result = mysqli_query($conn, $sql);

        $row = mysqli_fetch_assoc($result);

        if($row)
        {
            return true;
        }
        else 
        {
            return false;
        }
    }

    function is_ali($conn, $usersID)
    {
        $sql = "SELECT is_ali FROM admins WHERE usersID = $usersID;";

        $result = mysqli_query($conn, $sql);

        $resultCheck = mysqli_num_rows($result);

        $row = mysqli_fetch_array($result);

        if($resultCheck > 0 && $row['is_ali'] === '1')
        {
            return true;
        }
        
        return false;
    }

    function demote_admin($conn, $usersID)
    {
        $sql = "DELETE FROM admins WHERE usersID = $usersID;";

        if (mysqli_query($conn, $sql)) {
            echo "Record successfully deleted";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }

    function promote_to_admin($conn, $usersID)
    {
        $sql = "INSERT INTO admins (usersID) VALUES ($usersID);";

        if (mysqli_query($conn, $sql)) {
            echo "Record successfully added";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }

    function delete_user($conn, $usersID)
    {
        $sql = "DELETE FROM users WHERE usersID = $usersID;";

        if (mysqli_query($conn, $sql)) {
            echo "Record successfully deleted";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }

    }




    // PRODUCTS
    function get_all_products($conn)
    {
        $sql = "SELECT productID, productName, image, price, quantity FROM products";

        $result = mysqli_query($conn, $sql);

        $resultCheck = mysqli_num_rows($result);

        $data = array();
        if($resultCheck > 0)
        {
            $i = 0;
            while($row = mysqli_fetch_array($result))
            {
                $row_data = array();

                $row_data[0] = $row[0];
                $row_data[1] = $row[1];
                $row_data[2] = $row[2];
                $row_data[3] = $row[3];
                $row_data[4] = $row[4];

                $data[$i] = $row_data;
                $i++;
            }
        }
        return $data;
    }

    function delete_product($conn, $productID)
    {
        $sql = "DELETE FROM products WHERE productID = $productID;";

        if (mysqli_query($conn, $sql)) {
            echo "Record successfully deleted";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }

    }