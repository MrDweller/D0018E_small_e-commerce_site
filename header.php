<?php 
    session_start();
    require_once 'javascript/auto_scroll.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>AliRoad | e-commerce</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;400;500;600;700&display=swap">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="icon" href="http://www.aliroad.se/media/favicon.ico">
    <link rel="icon" href="http://www.aliroad.se/media/favicon.png">
    
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
                                ?>
                                    <li> <button onclick='button_press("include/logout.inc.php")' class="btn"> Log out </button></li>
                                    <li> <button onclick='button_press("account.php")' class="btn">
                                <?php echo $uid; ?>
                                    </button></li>
                                <?php
                            }
                            else 
                            {
                                ?>
                                <li> <button onclick='button_press("login.php")' class="btn"> Login </button></li>
                                <li> <button onclick='button_press("signup.php")' class="btn"> Sign up </button></li>
                                <?php
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
                                <li><button onclick="button_press('cart.php')" class="btn" > <i class="fa fa-shopping-cart" style="font-size:25px"></i> 
                                <?php
                                    echo $cartCount;
                                ?>
                                </button>
                                </li>
                                <?php
                            }
                        ?>
                        
                        <li><button class=btn3 onclick="button_press('index.php')"> Home </button></li>
                        <li><button class=btn3 onclick="button_press('products.php')"> Products </button></li>
                        <li><button class=btn3 onclick="button_press('about.php')"> About </a></li>
                        <li><button class=btn3 onclick="button_press('contacts.php')"> Contact Us </a></li>
                                
                    </ul> 
                </nav>

            </div>

        </div>
    </div>
    <br>