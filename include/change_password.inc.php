<?php

session_start();
if(isset($_SESSION["userid"]))
{
    if(isset($_POST["submit"]))
    {
        require_once 'db.inc.php';
        require_once 'change_password_functions.inc.php';
        require_once 'change_email_functions.inc.php';
        $userUID = $_POST["uid"];
        $old_pwd = $_POST["old_pwd"];
        $new_pwd_1 = $_POST["new_pwd_1"];
        $new_pwd_2 = $_POST["new_pwd_2"];;

        // ERROR HANDLING
        if(verify_user($conn, $userUID, $userUID, $old_pwd) === false)
        {
            header("location: ../change_password.php?error=verifyError");
            exit();
        }

        if(empty_input_field($userUID, $old_pwd, $new_pwd_1, $new_pwd_2))
        {
            header("location: ../change_password.php?error=emptyInput");
            exit();
            
        }

        if(invalid_form_repeat($new_pwd_1, $new_pwd_2))
        {
            header("location: ../change_password.php?error=passwordRepeatError");
            exit();
        }

        change_password($conn, $userUID, $new_pwd_1);
        header("location: ../account.php?success=passwordChanged");
        exit();

    }
    else
    {
        header("location: ../index.php");
        exit();
    }
    
}
else 
    {
        echo "FEL PÅ SESSION";
    }

?>