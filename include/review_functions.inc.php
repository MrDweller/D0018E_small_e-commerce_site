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

    function get_review_rating($conn, $productID)
    {
        $sql = "SELECT rating FROM reviews WHERE productID = $productID;";

        $result = mysqli_query($conn, $sql);

        $result_check = mysqli_num_rows($result);

        if($result_check > 0)
        {   
            $data = array();
            $i = 0;
            while($row = mysqli_fetch_array($result))
            {
                $data[$i] = $row[0];

                $i = $i + 1;
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
            $index = 0;
            while($row = mysqli_fetch_array($result))
            {
                $row_data = array();

                $row_data[0] = $row[0];
                $row_data[1] = $row[1];
                $row_data[2] = $row[2];

                $data[$index] = $row_data;

                $index++;
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
        $sql = "SELECT review FROM reviews WHERE productID = $productID AND userID = $usersID;";
        $result = mysqli_query($conn, $sql);
        $rows = mysqli_num_rows($result);


        if( $rows === 0 )
        {
            return false;
        }
        else if( $rows > 0 )
        {
            return true;
        }
        else
        {
            echo mysqli_error($conn);
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

    function get_average_rating($conn, $productID)
    {
        $ratings = get_review_rating($conn, $productID);

        if($ratings !== false)
        {
            $sum_rating = 0;
            for($i = 0; $i < sizeof($ratings); $i++)
            {
                $sum_rating += $ratings[$i];
            }
            $average_rating = $sum_rating / sizeof($ratings);
            return round( $average_rating, 0, PHP_ROUND_HALF_UP);
        }
        return false;
    }

    function sort_productIDs_by_rating($conn, $productIDs)
    {
        // implementation of buket sort.
        $rating_one = array();
        $index_one = 0;
        $rating_two = array();
        $index_two = 0;
        $rating_three = array();
        $index_three = 0;
        $rating_four = array();
        $index_four = 0;
        $rating_five = array();
        $index_five = 0;

        for($i = 0; $i < sizeof($productIDs); $i++)
        {
            $productID_rating = get_average_rating($conn, $productIDs[$i]);

            switch($productID_rating)
            {
                case 1:
                    $rating_one[$index_one] = $productIDs[$i];
                    $index_one ++;
                    break;
                case 2:
                    $rating_two[$index_two] = $productIDs[$i];
                    $index_two ++;
                    break;
                case 3:
                    $rating_three[$index_three] = $productIDs[$i];
                    $index_three ++;
                    break;
                case 4:
                    $rating_four[$index_four] = $productIDs[$i];
                    $index_four ++;
                    break;
                case 5:
                    $rating_five[$index_five] = $productIDs[$i];
                    $index_five ++;
                    break;
            }
        }
        $sorted_productIDs = array_merge($rating_five, $rating_four, $rating_three, $rating_two, $rating_one);
        return $sorted_productIDs;

    }

    function get_top_rated_products($conn, $productIDs, $max_products)
    {
        $sorted_productIDs = sort_productIDs_by_rating($conn, $productIDs);

        $top_products = array();

        for($i = 0; $i < sizeof($sorted_productIDs); $i++)
        {
            if($i >= $max_products)
            {
                return $top_products;
            }
            else 
            {
                $top_products[$i] = $sorted_productIDs[$i];
            }
        }

        return $top_products;
    }