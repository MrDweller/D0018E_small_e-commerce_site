<?php
    session_start();
    if(isset($_SESSION["admin"]))
    {
        if(isset($_POST["change_user"]))
        {
            require_once 'db.inc.php';
            require_once 'admin_functions.inc.php';
            $usersID = $_POST["change_user"];
            
            if(isset($_POST["admin"]))
            {
                if(!is_admin($conn, $usersID))
                {
                    promote_to_admin($conn, $usersID);
                }
            }
            else if(isset($_POST["customer"]))
            {
                if(is_admin($conn, $usersID))
                {
                    demote_admin($conn, $usersID);
                }
            }

           
        }
    }
    else 
    {
        header("location: ../index.php");
        exit();
    }
?>