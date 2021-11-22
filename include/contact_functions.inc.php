<?php

// CONTACT
function emptyInputContact($fname, $lname, $subject)
{
    $result = null;

    if(empty($fname) || empty($lname) || empty($subject))
    {
        $result = true;
    }
    else
    {
        $result = false;
    }
    return $result;
}

function invalidFname($fname)
{
    $result = null;

    if(!preg_match("/^[a-zA-Z]*$/", $fname))
    {
        $result = true;
    }
    else
    {
        $result = false;
    }

    return $result;
}

function invalidLname($lname)
{
    $result = null;

    if(!preg_match("/^[a-zA-Z]*$/", $lname))
    {
        $result = true;
    }
    else
    {
        $result = false;
    }

    return $result;
}


function get_form_info($conn, $usersID)
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


function add_contact_info($conn, $usersID, $fname, $lname, $message)
{

    # insert shiet here

    $sql = "INSERT INTO contact_info (users_usersID, fname, lname, msg) VALUES ($usersID, '$fname', '$lname', NULL);";
    $insert_result = mysqli_query($conn, $sql);

    $sql_contact_id = "SELECT * FROM contact_info ORDER BY contactID DESC LIMIT 1";
    $result = mysqli_query($conn, $sql_contact_id);
    $resultCheck = mysqli_num_rows($result);

    if($resultCheck > 0)
    {
        $row = mysqli_fetch_assoc($result);
        $filepath = 'angry_letters/message-'.strval($row["contactID"]);
        $filepath .= '.txt';
        $cID = $row["contactID"];
        $sql_query = "UPDATE contact_info SET msg = '$filepath' WHERE contactID = $cID";
        mysqli_query($conn, $sql_query);
    }


    if ($insert_result) 
    {
        echo "New record created successfully";
        return $filepath;
    } 
    else 
    {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        return false;
    }


}




?>