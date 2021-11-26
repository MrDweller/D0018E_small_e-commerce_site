<?php

    function get_all_users()
    {
        
    }

    function is_admin($conn, $usersID)
    {
        $sql = "SELECT * FROM admins WHERE usersID = $usersID;";

        $result = mysqli_query($conn, $sql);

        $row = mysqli_fetch_assoc($result);

        if($row)
        {
            return true;
        }
        else 
        {
            return false;
        }
    }