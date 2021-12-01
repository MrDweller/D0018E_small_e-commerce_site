<?php

function verify_user($conn, $username, $pwd)
{
    require_once 'login_functions.inc.php';
    $uidExist = uidExist($conn, 0, $username);

    if($uidExist === false)
    {
        return false;
    }

    $hashedPWD = $uidExist["usersPWD"];
    $checkPWD = password_verify($pwd, $hashedPWD);

    if($checkPWD === false)
    {
        return false;
    }
    else if ($checkPWD === true)
    {
        return true;
    }
}

function empty_input_field($old_email, $new_email_1, $new_email_2, $pwd)
{
    $result = null;

    if(empty($old_email) || empty($new_email_1) || empty($new_email_2) || empty($pwd))
    {
        $result = true;
    }
    else
    {
        $result = false;
    }
    return $result;
}

function email_exists($conn, $new_email)
{
    $sql = "SELECT * FROM users WHERE usersEmail = '$new_email';";
    $result = mysqli_query($conn, $sql);

    $resultCheck = mysqli_num_rows($result);
    
    if($resultCheck > 0)
    {
        return true;
    }
    elseif($resultCheck === 0)
    {
        return false;
    }

}

function invalid_email_repeat($new_email_1, $new_email_2)
{
    $result = null;
    
    if($new_email_1 !== $new_email_2)
    {
        $result = true;
    }
    else
    {
        $result = false;
    }
    return $result;
}


function change_email($conn, $old_email, $new_email)
{

    $sql = "UPDATE users SET usersEmail = '$new_email' WHERE (usersEmail = '$old_email');";
    if(mysqli_query($conn, $sql))
    {
        echo "Successfully updated record";
    }
    else 
    {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}


?>