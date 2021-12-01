<?php

session_start();
if(isset($_SESSION["userid"]))
{
    if(isset($_POST["submit"]))
    {
        require_once 'db.inc.php';
        require_once 'change_email_functions.inc.php';
        $old_email = $_POST["old_email"];
        $new_email_1 = $_POST["new_email_1"];
        $new_email_2 = $_POST["new_email_2"];
        $pwd = $_POST["pwd"];

        // ERROR HANDLING
        if(verify_user($conn, $old_email, $pwd) === false)
        {
            header("location: ../change_email.php?error=verifyError");
            exit();
        }

        if(empty_input_field($old_email, $new_email_1, $new_email_2, $pwd))
        {
            header("location: ../change_email.php?error=emptyInput");
            exit();
        }

        if(invalid_email_repeat($new_email_1, $new_email_2))
        {
            header("location: ../change_email.php?error=emailRepeatError");
            exit();
        }

        if(email_exists($conn, $new_email_1))
        {
            header("location: ../change_email.php?error=emailTaken");
            exit();
        }

        change_email($conn, $old_email, $new_email_1);
        header("location: ../account.php");
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