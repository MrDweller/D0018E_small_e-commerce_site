<?php
    include_once 'header.php';
?>

	<section class="signup-form"> 
		<div class="signup-form-form">
			<h2>Change password</h2><br>
			<form action="include/login.inc.php" method="post">
				<input type="uid" name="uid" placeholder="Username or email..."><br>
				<input type="old_pwd" name="old_pwd" placeholder="Current password..."><br>
                <input type="new_pwd_1" name="new_pwd_1" placeholder="New password..."><br>
				<input type="new_pwd_2" name="new_pwd_2" placeholder="Repeat new password..."><br>
				<button class="btn" type="submit" name="submit"> Change password </button>
			</form>
	</section>

<?php
    include_once 'footer.php';
?>