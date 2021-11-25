<?php
    include_once 'header.php';
?>

    <section class="signup-form">
        <div class="signup-form-form">
            <h2>Sign up</h2><br>
            <form action="include/signup.inc.php" method="post">
                <input type="text" name="uid" placeholder="Username..."><br>
                <input type="text" name="email" placeholder="Email..."><br>
                <input type="password" name="pwd" placeholder="Password..."><br>
                <input type="password" name="pwdrepeat" placeholder="Repeat password..."><br>
                <button class="btn" type="submit" name="submit">Submit</button>

                <?php
                    if(isset($_GET["error"]))
                    {
                        if($_GET["error"] == "emptyinput")
                        {
                            echo "<p>Fill in all fields!</p>";
                        }
                        if($_GET["error"] == "invalidUID")
                        {
                            echo "<p>Choose a proper user name!</p>";
                        }
                        if($_GET["error"] == "invalidEmail")
                        {
                            echo "<p>Choose a proper email!</p>";
                        }
                        if($_GET["error"] == "invalidPWD")
                        {
                            echo "<p>Password doesn't match!</p>";
                        }
                        if($_GET["error"] == "UIDtaken")
                        {
                            echo "<p>That user name or email is taken!</p>";
                        }
                        if($_GET["error"] == "stmtFailed")
                        {
                            echo "<p>FUCK YOU HACKER, STOP SQL INJECTION!</p>";
                        }
                    }
                ?>
            </form>
        </div>
    </section>

<?php
    include_once 'footer.php';
?>