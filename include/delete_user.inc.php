<?php
    session_start();
    if(isset($_SESSION["admin"]))
    {
        if(isset($_POST["delete_user"]))
        {
            require_once 'db.inc.php';
            require_once 'admin_functions.inc.php';
            $usersID = $_POST["delete_user"];
            if(is_admin($conn, $usersID))
            {
                demote_admin($conn, $usersID);
            }
            delete_user($conn, $usersID);

            header("location: ../user_settings.php");
            exit();
        }
    }

    elseif(isset($_SESSION["userid"]))
    {
        
        if(isset($_POST["delete_myself"]))
        {
            require_once 'db.inc.php';
            require_once 'admin_functions.inc.php';
            $usersID = $_POST["delete_myself"];
            delete_user($conn, $usersID);

            header("location: logout.inc.php");
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
        header("location: ../index.php");
        exit();
    }
?>