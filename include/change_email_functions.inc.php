<?php

function verify_user($conn, $username, $email, $pwd)
{
    require_once 'login_functions.inc.php';
    $uidExist = uidExist($conn, $username, $email);

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
    $sql = "SELECT * FROM users WHERE usersEmail = ?;";
    $stmt = mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt, $sql))
    {
        header("location: ../change_email.php?error=stmtFailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "s", $new_email);

    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
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

function invalid_form_repeat($entry_1, $entry_2)
{
    $result = null;
    
    if($entry_1 !== $entry_2)
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

    $sql = "UPDATE users SET usersEmail = ? WHERE (usersEmail = ?);";
    $stmt = mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt, $sql))
    {
        header("location: ../change_email.php?error=stmtFailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "ss", $new_email, $old_email);

    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    if($resultData)
    {
        echo "Successfully updated record";
    }
    else 
    {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}


?>