<?php 
    function get_username($conn, $usersID)
    {
        $sql = "SELECT usersUID FROM users WHERE usersID = $usersID;";

        $result = mysqli_query($conn, $sql);

        $result_check = mysqli_num_rows($result);

        if($result_check > 0)
        {   
            $row = mysqli_fetch_assoc($result);
            return $row;
        }
        else 
        {
            return false;
        }
    }