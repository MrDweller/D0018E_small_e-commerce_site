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

?>