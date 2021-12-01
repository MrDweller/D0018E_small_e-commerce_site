<?php
    function get_all_reviews($conn, $productID)
    {
        $sql = "SELECT 	userID,	review,	rating 	 FROM reviews WHERE productID = $productID;";

        $result = mysqli_query($conn, $sql);

        $result_check = mysqli_num_rows($result);

        if($result_check > 0)
        {   
            $data = array();
            $i = 0;
            while($row = mysqli_fetch_array($result))
            {
                $data[$i] = $row[0];
                $data[$i + 1] = $row[1];
                $data[$i + 2] = $row[2];

                $i = $i + 3;
            }
            return $data;
        }
        else 
        {
            return false;
        }
    }