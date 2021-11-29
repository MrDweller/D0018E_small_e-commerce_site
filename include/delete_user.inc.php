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

            
        }
    }
    else 
    {
        header("location: ../index.php");
        exit();
    }
?>