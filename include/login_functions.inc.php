<?php
function emptyInputSignup($uid, $email, $pwd, $pwdrepeat)
{
    $result = null;

    if(empty($uid) || empty($email) || empty($pwd || empty($pwdrepeat)))
    {
        $result = true;
    }
    else
    {
        $result = false;
    }
    return $result;
}

function invalidUID($uid)
{
    $result = null;

    if(!preg_match("/^[a-zA-Z0-9]*$/", $uid))
    {
        $result = true;
    }
    else
    {
        $result = false;
    }

    return $result;
}

function invalidEmail($email)
{
    $result = null;

    if(!filter_var($email, FILTER_VALIDATE_EMAIL))
    {
        $result = true;
    }
    else
    {
        $result = false;
    }
    return $result;
}

function invalidPWD($pwd, $pwdrepeat)
{
    $result = null;

    if($pwd !== $pwdrepeat)
    {
        $result = true;
    }
    else
    {
        $result = false;
    }
    return $result;
}

function uidExist($conn, $uid, $email)
{
    $sql = "SELECT * FROM users WHERE usersUID = ? OR usersEmail = ?;";
    $stmt = mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt, $sql))
    {
        header("location: ../signup.php?error=stmtFailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "ss", $uid, $email);

    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    if($row = mysqli_fetch_assoc($resultData))
    {
        return $row;
    }
    else
    {
        $result = false;
        return $result;
    }

    mysqli_stmt_close($stmt);
}

function createUser($conn, $uid, $email, $pwd, $pwdrepeat)
{
    $sql = "INSERT INTO users (usersUID, usersEmail, usersPWD) VALUES (?, ?, ?);";
    $stmt = mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt, $sql))
    {
        header("location: ../signup.php?error=stmtFailed");
        exit();
    }

    $hashedPWD = password_hash($pwd, PASSWORD_DEFAULT);

    mysqli_stmt_bind_param($stmt, "sss", $uid, $email, $hashedPWD);

    mysqli_stmt_execute($stmt);

    mysqli_stmt_close($stmt);

    loginUser($conn, $uid, $pwd);
}

function emptyInputLogin($username, $pwd)
{
    $result = null;

    if(empty($username) || empty($pwd))
    {
        $result = true;
    }
    else
    {
        $result = false;
    }
    return $result;
}

function loginUser($conn, $username, $pwd)
{
    $uidExist = uidExist($conn, $username, $username);

    if($uidExist === false)
    {
        header("location: ../login.php?error=UIDnotFound");
        exit();
    }

    $hashedPWD = $uidExist["usersPWD"];
    $checkPWD = password_verify($pwd, $hashedPWD);

    if($checkPWD === false)
    {
        header("location: ../login.php?error=wrongPWD");
        exit();
    }
    else if ($checkPWD === true)
    {
        session_start();

        $_SESSION["userid"] = $uidExist["usersID"];
        $_SESSION["useruid"] = $uidExist["usersUID"];
        header("location: ../index.php");
        exit();
    }

}