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
    //$sql = "INSERT INTO billing_info (users_usersID, fname, lname, city, address, postcode) VALUES ($usersID, '$fname', '$lname', '$city', '$address', $postcode);";
    $sql = "INSERT INTO billing_info (users_usersID, fname, lname, city, address, postcode) VALUES (?, ?, ?, ?, ?, ?);";

    $stmt = mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt, $sql))
    {
        header("location: ../checkoutform.php?error=stmtFailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "issssi", $usersID, $fname, $lname, $city, $address, $postcode);
    mysqli_stmt_execute($stmt);
    $resultData = mysqli_stmt_get_result($stmt);
    mysqli_stmt_close($stmt);

    if ($resultData) {
        echo "New record created successfully";
    } 
    else 
    {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
    
}

function check_billing_info_exists($conn, $usersID)
{
    $sql = "SELECT * FROM billing_info WHERE users_usersID = ?;";

    $stmt = mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt, $sql))
    {
        header("location: ../checkoutform.php?error=stmtFailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "i", $usersID);
    mysqli_stmt_execute($stmt);
    $resultData = mysqli_stmt_get_result($stmt);

    $resultCheck = mysqli_num_rows($resultData);
    mysqli_stmt_close($stmt);

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
    $sql = "UPDATE billing_info SET fname = ?, lname = ?, city = ?, address = ?, postcode = ? WHERE users_usersID = ?;";
        
    $stmt = mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt, $sql))
    {
        header("location: ../checkoutform.php?error=stmtFailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "ssssii", $fname, $lname, $city, $address, $postcode, $usersID);
    mysqli_stmt_execute($stmt);
    $resultData = mysqli_stmt_get_result($stmt);
    mysqli_stmt_close($stmt);

    if ($resultData) {
        echo "New record updated successfully";
    } 
    else 
    {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
    
}

function get_billing_info($conn, $usersID)
{
    $sql = "SELECT * FROM billing_info WHERE users_usersID = ?;";

    $stmt = mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt, $sql))
    {
        header("location: ../checkoutform.php?error=stmtFailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "i", $usersID);
    mysqli_stmt_execute($stmt);
    $resultData = mysqli_stmt_get_result($stmt);

    $resultCheck = mysqli_num_rows($resultData);
    mysqli_stmt_close($stmt);

    if ($resultCheck > 0)
    {
        $row = mysqli_fetch_assoc($resultData);
        return $row;
    }
    
    return false;
}