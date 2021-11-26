<?php

    function get_all_users($conn)
    {
        $sql = "SELECT usersUID, usersEmail FROM users";

        $result = mysqli_query($conn, $sql);

        $resultCheck = mysqli_num_rows($result);

        $data = array();
        if($resultCheck > 0)
        {
            $i = 0;
            while($row = mysqli_fetch_array($result))
            {
                $row_data = array();

                $row_data[0] = $row[0];
                $row_data[1] = $row[1];

                $data[$i] = $row_data;
                $i++;
            }
        }
        return $data;
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