<?php
    include_once 'header.php';
?>
	<section class="signup-form"> 
		<div class="signup-form-form">
			<h2>Change password</h2><br>
			<form action="include/change_password.inc.php" method="post">
				<input type="uid" name="uid" placeholder="Username or email..."><br>
				<input type="password" name="old_pwd" placeholder="Current password..."><br>
                <input type="password" name="new_pwd_1" placeholder="New password..."><br>
				<input type="password" name="new_pwd_2" placeholder="Repeat new password..."><br>
				<button class="btn" type="submit" name="submit"> Submit changes </button>
			</form>

		<?php

			if(isset($_GET["error"]))
			{
				if($_GET["error"] == "verifyError")
				{
					echo "<p>Username or current password incorrect!</p>";
				}
				if($_GET["error"] == "emptyInput")
				{
					echo "<p>Fill in all the fields!</p>";
				}
				if($_GET["error"] == "passwordRepeatError")
				{
					echo "<p>Repeated password does not match new password!</p>";
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