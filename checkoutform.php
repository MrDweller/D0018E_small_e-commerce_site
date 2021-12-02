<?php
    include_once 'header.php';
    require_once 'include/db.inc.php';
    require_once 'include/checkoutform_functions.inc.php';

    $fname = '';
    $lname = '';
    $address = '';
    $city = '';
    $postcode = '';

    if(isset($_SESSION["userid"]))
    {
        $row = get_billing_info($conn, $usersID);
        if($row !== false)
        {
            $fname = $row['fname'];
            $lname = $row['lname'];
            $address = $row['address'];
            $city = $row['city'];
            $postcode = $row['postcode'];
        }
    }
?>

    <section class="checkout-form">
        <div class="signup-form-form">
            <h2>Billing Address</h2><br>
            <form action="include/checkoutform.inc.php" method="post">
                <input type="text" name="fname" placeholder="First name" value="<?php echo $fname ?>"><br>
                <input type="text" name="lname" placeholder="Last name" value="<?php echo $lname ?>"><br>
                <input type="text" name="address" placeholder="Address" value="<?php echo $address ?>"><br>
                <input type="text" name="city" placeholder="City" value="<?php echo $city ?>"><br>
                <input type="text" name="postcode" placeholder="Postcode" value="<?php echo $postcode ?>"><br>
                <button class="btn" type="submit" name="submit">Confirm Checkout</button>


                <?php
                    // ?error=
                    if(isset($_GET["error"]))
                    {

                        if($_GET["error"] == "emptyinput")
                        {
                            echo "<p>Fill in all fields!</p>";
                        }

                        if($_GET["error"] == "invalidFname")
                        {
                            echo "<p>First name is invalid!</p>";
                        }

                        if($_GET["error"] == "invalidLname")
                        {
                            echo "<p>Last name is invalid!</p>";
                        }

                        if($_GET["error"] == "invalidEmail")
                        {
                            echo "<p>Choose a proper email!</p>";
                        }

                        if($_GET["error"] == "invalidAddress")
                        {
                            echo "<p>Choose a proper address!</p>";
                        }

                        if($_GET["error"] == "invalidCity")
                        {
                            echo "<p>Choose a proper city!</p>";
                        }

                        if($_GET["error"] == "invalidPostcode")
                        {
                            echo "<p>Choose a proper postcode!</p>";
                        }
                        if($_GET["error"] == "stmtFailed")
                        {
                            echo "<p>Maddarbich!</p>";
                        }

                    }
                ?>
            </form>
        </div>
    </section>

<?php
    include_once 'footer.php';
?>