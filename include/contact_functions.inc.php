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

function invalidName($name)
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

function add_contact_info($conn, $fname, $lname, $message)
{

    $sql = "INSERT INTO contact_info (fname, lname, msg) VALUES ('$fname', '$lname', NULL);";
    $insert_result = mysqli_query($conn, $sql);

    # get latest entry in contact_info-table
    $sql_contact_id = "SELECT * FROM contact_info ORDER BY contactID DESC LIMIT 1";
    $result = mysqli_query($conn, $sql_contact_id);
    $resultCheck = mysqli_num_rows($result);

    if($resultCheck > 0)
    {
        $row = mysqli_fetch_assoc($result);
        $filepath = '../angry_letters/message-'.strval($row["contactID"]).'.txt';
        $cID = $row["contactID"];
        $sql_query = "UPDATE contact_info SET msg = '$filepath' WHERE contactID = $cID";
        mysqli_query($conn, $sql_query);
    }


    if ($insert_result) 
    {
        return $filepath;
    } 
    else 
    {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        return false;
    }

}

function complete_contact($conn, $fname, $lname, $message)
{
    $filename = add_contact_info($conn, $fname, $lname, $message);
    
    $handle = fopen($filename, 'w');

    fwrite($handle, $message);
    fclose($handle);
    
}

?>