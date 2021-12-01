<?php
    include_once 'header.php';
?>

	<section class="signup-form"> 
		<div class="signup-form-form">
			<h2>Log in</h2><br>
			<form action="include/login.inc.php" method="post">
				<input type="text" name="uid" placeholder="Username/Email..."><br>
				<input type="password" name="pwd" placeholder="Password..."><br>
				<button class="btn" type="submit" name="submit"> Submit </button>
			</form>
			<?php
                    if(isset($_GET["error"]))
                    {
                        if($_GET["error"] == "emptyinput")
                        {
                            echo "<p>Fill in all fields!</p>";
                        }
                        if($_GET["error"] == "UIDnotFound")
                        {
                            echo "<p>User name or email is not found!</p>";
                        }
                        if($_GET["error"] == "wrongPWD")
                        {
                            echo "<p>Wrong password!</p>";
                        }
                        if($_GET["error"] == "stmtFailed")
                        {
                            echo "<p>FUCK YOU HACKER, STOP SQL INJECTION!</p>";
                        }
                    }
            ?>
            
		</div>
	</section>

<?php
    include_once 'footer.php';
?>