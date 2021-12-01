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

    function get_users_reviews($conn, $usersID)
    {
        $sql = "SELECT productID, review, rating FROM reviews WHERE userID = $usersID;";

        $result = mysqli_query($conn, $sql);

        $result_check = mysqli_num_rows($result);

        if($result_check > 0)
        {   
            $data = array();
            $i = 0;
            $index = 0;
            while($row = mysqli_fetch_array($result))
            {
                $row_data = array();

                $row_data[$i] = $row[0];
                $row_data[$i + 1] = $row[1];
                $row_data[$i + 2] = $row[2];

                $data[$index] = $row_data;

                $i = $i + 3;
                $index ++;
            }
            return $data;
        }
        else 
        {
            return false;
        }
    }

    function review_exist($conn, $productID, $usersID)
    {
        $sql = "SELECT * FROM reviews WHERE productID = $productID AND userID = $usersID;";

        if( (mysqli_query($conn, $sql)) === false )
        {
            return false;
        }
        else 
        {
            return true;
        }
    }

    function edit_review($conn, $productID, $usersID, $review, $rating)
    {
        $sql = "UPDATE reviews SET review = '$review', rating = $rating WHERE productID = $productID AND userID = $usersID;";

        if(mysqli_query($conn, $sql))
        {
            return true;
        }
        else
        {
            echo mysqli_error($conn);
            return false;
        }
    }

    function add_review($conn, $productID, $usersID, $review, $rating)
    {
        $sql = "INSERT INTO reviews (productID,	userID,	review,	rating) VALUES ($productID, $usersID, '$review', $rating);";

        if(mysqli_query($conn, $sql))
        {
            return true;
        }
        else
        {
            echo mysqli_error($conn);
            return false;
        }
    }