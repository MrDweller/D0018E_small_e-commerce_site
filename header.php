<?php 
    session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>AliRoad | e-commerce</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;400;500;600;700&display=swap">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    
</head>
<body>

    <div class="header">
        <div class="container">
            <div class="navbar">
                <div class="logo">
                   <a href="index.php"> <img id="Aliroad" src="media/logo.png"></a>
                </div>
                <nav>
                    <ul>
                        <?php
                            if(isset($_SESSION["useruid"]))
                            {
                                $uid = $_SESSION["useruid"];
                                echo '<li> <a href="include/logout.inc.php" class="btn"> Log out </a></li>';
                                echo '<li> <a href="account.php" class="btn">';
                                echo $uid;
                                echo '</a></li>';
                            }
                            else 
                            {
                                echo '<li> <a href="login.php" class="btn"> Login </a></li>';
                                echo '<li> <a href="signup.php" class="btn"> Sign up </a></li>';
                            }
                        ?>
                        
                        
                        <?php
                            // Get the amount in your cart, but only if you're logged in
                            if(isset($_SESSION["userid"]))
                            {
                                require_once 'include/db.inc.php';
                                require_once 'include/cart_functions.inc.php';

                                $cartCount = 0;

                                $usersID = $_SESSION["userid"];

                                $cartCount = get_amount_in_cart($conn, $usersID);

                                ?>
                                <li><a href="cart.php" class="btn"> <i class="fa fa-shopping-cart" style="font-size:25px"></i> 
                                <?php
                                    echo $cartCount;
                                ?>
                                </a></li>
                                <?php
                            }
                        ?>


                        
                        
                        <li><a href="index.php"> Home </a></li>
                        <li><a href="products.php"> Products </a></li>
                        <li><a href="about.php"> About </a></li>
                        <li><a href="contacts.php"> Contact Us </a></li>
                                
                    </ul> 
                </nav>

            </div>

        </div>
    </div>
    <br>