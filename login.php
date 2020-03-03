<?php 
session_start();

$logEmail = '';
$logPassword = '';
$logEmailErr = '';
$logPasswordErr = '';
if(isset($_POST['login'])){
     if(!empty($_POST['log_email']) && !empty($_POST['log_password'])){
		if(preg_match('/^[a-zA-Z0-9]+[_]?[a-zA-Z0-9]+@[a-z]+\.[a-z]{3}$/', $_POST['log_email'])){
			$logEmail = $_POST['log_email'];
			$logPassword = $_POST['log_password'];
			if(isset($_SESSION['email']) && isset($_SESSION['user_password'])){
				if($logEmail == $_SESSION['email'] && $logPassword == $_SESSION['user_password']){
                 header('location: account.php');
			}
			else{
				if($logEmail != $_SESSION['email']){
				   $logEmailErr = 'Email not matched.';
				}
				if($logPassword != $_SESSION['user_password']){
				   $logPasswordErr = 'Password not matched.';
				}
					 
			}
			}
		}
	 }
	 else{
		 if(empty($_POST['log_email'])){
			$logEmailErr = 'Please enter your registered email.';
		 }
		 if(empty($_POST['log_password'])){
			$logPasswordErr = 'Please enter your password';
		 }
		 
	 }

	//  if(!empty($_POST['log_password'])){
	// 	$logPassword = $_POST['log_password'];
	//  }
	//  else{
	// 	$logPasswordErr = 'Please enter your password.';
	//  }
}

?>
<!DOCTYPE html>
<html lang="en">
<?php require_once('template/header.php'); ?>
<div class="container">
<div class="row">
	<div class="col-md-12 mt-3 mb-5">
		
		<div class="outer top-bottom-space mx-auto remove-padding set-width mb-5">
			<form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST">
				<div class="form-group">
					<label>Email address</label>
					<input type="email" class="form-control" name="log_email">
					<span class="error-msg"><small><?php echo $logEmailErr; ?></small></span>
				</div>
				<div class="form-group">
					<label>Password</label>
					<input type="password" class="form-control" name="log_password">
					<span class="error-msg"><small><?php echo $logPasswordErr; ?></small></span>
				</div>
				<button type="submit" class="btn btn-primary px-4" name="login">Login</button>
			</form>
		</div>
	</div>
</div>
</div>
<?php require_once('template/footer.php'); ?>
</html>