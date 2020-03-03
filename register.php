<?php 
session_start();

$name = '';
$age = '';
$gender = '';
$phone = '';
$email = '';
$password = '';
$nameErr = '';
$ageErr = '';
$genderErr = '';
$phoneErr = '';
$emailErr = '';
$passwordErr = '';
$showMessageEmail = '';
$checkMail = '';

if(isset($_POST['register'])){
	 if(!empty($_POST['name'])){
		if(preg_match('/^[A-Z]{1}[a-z]+(\s[A-Z]{1}[a-z]+)?$/', $_POST['name'])){
			$name = $_POST['name'];
			$_SESSION['name'] = $name;
		}
		else{
            $nameErr = 'Please enter a valid name.';
		}
	 }
	 else{
		 $nameErr = 'Please enter your name.';
	 }
	 if(!empty($_POST['age'])){
         if(preg_match('/[0-9]{1,2}/', $_POST['age'])){
			$age = $_POST['age'];
			$_SESSION['age'] = $age;
		 }
		 else{
			 $ageErr = 'Please enter a valid age.';
		 }
	 }
	 else{
		 $ageErr = 'Please enter your age.';
	 }

	 if(!empty($_POST['gender'])){
		$gender = $_POST['gender'];
		$_SESSION['gender'] = $gender;
	 }
	 else{
		 $genderErr = 'Please select gender.';
	 }

	 if(!empty($_POST['phone'])){
       if(preg_match('/^[0-9]{10}$/', $_POST['phone'])){
		 $phone = $_POST['phone'];
		 $_SESSION['phone'] = $phone;
	   }
	   else{
		   $phoneErr = 'Phone number is not valid';
	   }
	 }
	 else{
        $phoneErr = 'Please enter your phone number';
	 }

	 if(!empty($_POST['email'])){
		 if(preg_match('/^[a-zA-Z0-9]+[_]?[a-zA-Z0-9]+@[a-z]+\.[a-z]{3}$/', $_POST['email'])){
			 $email = $_POST['email'];
			 $_SESSION['email'] = $email;

			 // generate password after validating email
			 $str = 'abcdefghijklmnopqrstuvwxyz#0123&&456789ABCDEFGHIJKLMNOPQRSTUVWXYZ@/$$';
			 $genratePassword = substr(str_shuffle($str), 0, 15);
			 $_SESSION['user_password'] = $genratePassword;
			 $mailTo = $_POST['email'];
			 $subject = "Login Password.";
			 $messageContent = "Password: ".$_SESSION['user_password']."\n";
			 $messageContent .= "Your IP Address: ".$_SERVER['REMOTE_ADDR'];
			 $header = "From: haaidrehman086@gmail.com";
			 $showMessageEmail = mail($mailTo, $subject, $messageContent, $header);
			 if($showMessageEmail == true){
				$checkMail = 'Check your email.';
			 } 
			  

		 }
		 else{
			$emailErr = 'Please enter a valid email.';
		 }
	 }
	 else{
		$emailErr = 'Please enter your email.';
	 }

}

?>
<!DOCTYPE html>
<html lang="en">
	<?php require_once('template/header.php'); ?>
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="outer my-5 mx-auto  remove-padding set-width">
					<form method="POST" action="<?php $_SERVER['PHP_SELF']; ?>">
						<div class="form-group">
							<label>Name</label>
							<input type="text" class="form-control" name="name">
							<span class="error-msg"><small><?php echo $nameErr; ?></small></span>
						</div>
						<div class="form-group">
							<label>Age</label>
							<input type="number" class="form-control" name="age">
							<span class="error-msg"><small><?php echo $ageErr; ?></small></span>
						</div>
						<div class="form-check form-check-inline">
							<input class="form-check-input" type="radio" name="gender" value="Male">
							<label class="form-check-label" >Male</label>
						</div>
						<div class="form-check form-check-inline">
							<input class="form-check-input" type="radio" name="gender" value="Female">
							<label class="form-check-label">Female</label>
							<span class="error-msg"><small><?php echo $genderErr; ?></small></span>
						</div>
						<div class="form-group pt-2">
							<label>Phone</label>
							<input type="text" class="form-control" name="phone">
							<span class="error-msg"><small><?php echo $phoneErr; ?></small></span>
						</div>
						<div class="form-group">
							<label>Email address</label>
							<input type="email" class="form-control" name="email">
							<span class="error-msg"><small><?php echo $emailErr; ?></small></span>
							<small class="form-text text-muted">We'll never share your email with anyone else.</small>
						</div>
						<button type="submit" class="btn btn-primary" name="register">Register</button>
					</form>
				</div>
                <div class="form-text">
					<p><?php echo $checkMail; ?></p>
				</div>
				<div class="text-center mt-n4 pb-4"><a href="login.php" class="text-decoration-none">Click here to login</a></div>
			</div>
		</div>
	</div>
	<?php require_once('template/footer.php'); ?>
</html>