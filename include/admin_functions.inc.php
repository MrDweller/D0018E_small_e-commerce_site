<?php


    // USERS
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
        require_once 'product_functions.inc.php';
        $product = get_product($conn, $productID);

        if(unlink("../" . $product["image"]))
        {
            echo "Image successfully deleted";
        }
        else
        {
            echo "ERROR IMAGE NOT DELETED";
        }

        $sql = "DELETE FROM products WHERE productID = $productID;";

        if (mysqli_query($conn, $sql)) {
            echo "Record successfully deleted";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }


    // CONTACT
    function get_all_messages($conn)
    {
        $sql = "SELECT fname, lname, msg FROM contact_info";

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

function read_message($filepath_msg)
{
    return file_get_contents(__DIR__ . "/" . $filepath_msg);
}

function format_message($string, $line_length)
{
    $array = str_split($string);
    $counter = 0;
    $string_builder = "";
    foreach ($array as $char) {
        $counter++;
        if($counter >= $line_length)
        {
            $string_builder = $string_builder . "<br>";
            $counter = 0;
        }

        $string_builder = $string_builder . $char;
       }
    
    return $string_builder;
}
