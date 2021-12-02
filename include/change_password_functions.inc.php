<?php

function change_password($conn, $userUID, $new_pwd_1)
{

    $sql = "UPDATE users SET usersPWD = ? WHERE (usersUID = ?);";
    $stmt = mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt, $sql))
    {
        header("location: ../change_password.php?error=stmtFailed");
        exit();
    }
    
    $hashedPWD = password_hash($new_pwd_1, PASSWORD_DEFAULT);
    
    mysqli_stmt_bind_param($stmt, "ss", $hashedPWD, $userUID);
    
    $resultData = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

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