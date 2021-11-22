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


// get contact info func

function get_contact_info($conn, $usersID)
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

?>