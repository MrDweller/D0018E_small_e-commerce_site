<?php

// CHECKOUT
function empty_input_checkout($fname, $lname, $address, $city, $postcode)
{
    $result = null;

    if(empty($fname) || empty($lname) || empty($address) || empty($city) || empty($postcode))
    {
        $result = true;
    }
    else
    {
        $result = false;
    }
    return $result;
}

function invalid_name($name)
{
    $result = null;

    if(!preg_match("/^\pL+$/u", $name))
    {
        $result = true;
    }
    else
    {
        $result = false;
    }

    return $result;
}

function invalid_address($address)
{
    $result = null;

    if(!preg_match("/^\pL+(\s\pN+\pL*)?$/u", $address))
    {
        $result = true;
    }
    else
    {
        $result = false;
    }

    return $result;
}

function invalid_city($city)
{
    $result = null;

    if(!preg_match("/^\pL+$/u", $city))
    {
        $result = true;
    }
    else
    {
        $result = false;
    }

    return $result;
}

function invalid_postcode($postcode)
{
    $result = null;

    if(!preg_match("/^[0-9]*$/", $postcode))
    {
        $result = true;
    }
    else
    {
        $result = false;
    }

    return $result;
}

function add_to_billing_info($conn, $usersID, $fname, $lname, $city, $address, $postcode)
{
    $sql = "INSERT INTO billing_info (users_usersID, fname, lname, city, address, postcode) VALUES ($usersID, '$fname', '$lname', '$city', '$address', $postcode);";
        
    if (mysqli_query($conn, $sql)) {
        echo "New record created successfully";
    } 
    else 
    {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}

function check_billing_info_exists($conn, $usersID)
{
    $sql = "SELECT * FROM billing_info WHERE users_usersID = $usersID;";

    $result = mysqli_query($conn, $sql);

    $resultCheck = mysqli_num_rows($result);

    if ($resultCheck > 0)
    {
        return true;
    }
    else 
    {
        return false;  
    }

}

function update_billing_info($conn, $usersID, $fname, $lname, $city, $address, $postcode)
{
    $sql = "UPDATE billing_info SET fname = '$fname', lname = '$lname', city = '$city', address = '$address', postcode = $postcode WHERE users_usersID = $usersID;";
        
    if (mysqli_query($conn, $sql)) 
    {
        echo "Rrecord updated successfully";
    } 
    else 
    {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}

function get_billing_info($conn, $usersID)
{
    $sql = "SELECT * FROM billing_info WHERE users_usersID = $usersID;";

    $result = mysqli_query($conn, $sql);

    $resultCheck = mysqli_num_rows($result);

    if($resultCheck > 0)
    {
        $row = mysqli_fetch_assoc($result);
        return $row;
    }
    
    return false;
}