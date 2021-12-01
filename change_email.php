<?php
    include_once 'header.php';

?>

	<section class="signup-form"> 
		<div class="signup-form-form">
			<h2>Change email</h2><br>
			<form action="include/change_email.inc.php" method="post">
				<input type="old_email" name="old_email" placeholder="Current email..."><br>
				<input type="new_email_1" name="new_email_1" placeholder="New email..."><br>
				<input type="new_email_2" name="new_email_2" placeholder="Repeat new email..."><br>
				<input type="password" name="pwd" placeholder="Current password..."><br>
				<button class="btn" type="submit" name="submit"> Change email </button>
			</form>
	

		<?php

			if(isset($_GET["error"]))
			{
				if($_GET["error"] == "verifyError")
				{
					echo "<p>Username or password incorrect!</p>";
				}
				if($_GET["error"] == "emptyInput")
				{
					echo "<p>Fill in all the fields!</p>";
				}
				if($_GET["error"] == "emailTaken")
				{
					echo "<p>New email is already taken!</p>";
				}
				if($_GET["error"] == "emailRepeatError")
				{
					echo "<p>Repeated email does not match new email!</p>";
				}
				if($_GET["error"] == "stmtFailed")
				{
					echo "<p>bruuuh!</p>";
				}
				
			}

		?>
	
	</section>

<?php
    include_once 'footer.php';
?>