<!DOCTYPE html>
<html lang="en">
<?php require_once('template/header.php'); ?>

<div class="container">
	<h1 class="text-center my-5">Welcome to our portal.</h1>
	<div class="row">
	<div class="col-md-4">
		<div class="outer mb-5 mx-auto text-center">
			<a href="register.php"><i class="fas fa-user-plus" style="font-size: 60px; color: white;"></i></a>
			<p class="text-white ml-n3 mt-2">Register</p>
		</div>
	</div>
	<div class="col-md-4">
		<div class="outer mb-5 mx-auto text-center">
			<a href="login.php"><i class="fas fa-sign-in-alt" style="font-size: 60px; color: white;"></i></a>
			<p class="text-white mt-2">Log In</p>
		</div>
	</div>
	<div class="col-md-4">
		<div class="outer mb-5 mx-auto text-center">
			<a href="account.php"><i class="fas fa-user-alt" style="font-size: 60px; color: white;"></i></a>
			<p class="text-white mt-2">Account</p>
		</div>
	</div>
	</div>
</div>

<?php require_once('template/footer.php'); ?>
</html>