<?php
    include_once 'header.php';
?>

    <section class="checkout-form">
        <div class="signup-form-form">
            <h2>Billing Address</h2><br>
            <form action="include/checkoutform.inc.php" method="post">
                <input type="text" name="fname" placeholder="First name"><br>
                <input type="text" name="lname" placeholder="Last name"><br>
                <input type="text" name="email" placeholder="Email"><br>
                <input type="text" name="address" placeholder="Address"><br>
                <input type="text" name="city" placeholder="City"><br>
                <input type="text" name="postcode" placeholder="Postcode"><br>
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
                    }
                ?>
            </form>
        </div>
    </section>

<?php
    include_once 'footer.php';
?>