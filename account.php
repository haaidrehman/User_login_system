<?php
session_start();
$messageUpload = '';
$showNameData = '';
$showAgeData = '';
$showPhoneData = '';
$showEmailData = '';
if(!empty($_SESSION['name']) && !empty($_SESSION['age']) && !empty($_SESSION['phone']) && !empty($_SESSION['email'])){
	$showNameData = $_SESSION['name'];
	$showAgeData = $_SESSION['age'];
	$showPhoneData = $_SESSION['phone'];
	$showEmailData = $_SESSION['email'];
}

$fileTypeError = '';
$fileSizeError = '';
if(isset($_POST['upload'])){
	if(!empty($_FILES['submitfile']['name'])){
		if(($_FILES['submitfile']['type'] == 'image/jpeg') | ($_FILES['submitfile']['type'] == 'image/png') | ($_FILES['submitfile']['type'] == 'image/jpg') && $_FILES['submitfile']['size'] <= 1048576){
			$fileTempName = $_FILES['submitfile']['tmp_name'];
			$fileName = $_FILES['submitfile']['name'];
			$fileMoved = move_uploaded_file($fileTempName, 'files/'.$fileName);
			if($fileMoved == true){
				$handle = fopen('files/'.$fileName, 'r');
				$readData = fread($handle, filesize('files/'.$fileName));
				fclose($handle);
				
				
				mail($_SESSION['email'], 'Uploaded File.', $readData, 'From: haaidrehman086@gmail.com');
				$messageUpload = 'Files uploaded successfully.';
			}
			
		}
		else{
			if(($_FILES['submitfile']['type'] != 'image/jpeg') | ($_FILES['submitfile']['type'] != 'image/png') | ($_FILES['submitfile']['type'] != 'image/jpg')){
				$fileTypeError = 'Only PNG, JPEG, JPG image formats are allowed <br>';
			}
			if($_FILES['submitfile']['size'] > 1048576){
				$fileSizeError = 'File size should be less than 1 MB.';
			}
		}
	}
}

if(isset($_POST['log_out'])){
	session_unset();
	session_destroy();
	header('location: login.php');
}

?>
<!DOCTYPE html>
<html lang="en">
<?php require_once('template/header.php'); ?>

<div class="container data">
	<div class="row">
		<div class="col-md-12">
			<h2 class="text-center pt-5">Hello user here is your data :-)</h2>
			<div class="outer top-bottom-space mx-auto remove-padding set-width acount-outer">
				<div class="row">
					<div class="col-md-6">
						<p class="text-bg my-3">Name</p>
					</div>
					<div class="col-md-6">
						<p class="text-bg my-3"><?php echo $showNameData; ?></p>
					</div>
					<div class="col-md-6">
						<p class="text-bg my-3">Age</p>
					</div>
					<div class="col-md-6">
						<p class="text-bg my-3"><?php echo $showAgeData; ?></p>
					</div>
					<div class="col-md-6">
						<p class="text-bg my-3">Phone Number</p>
					</div>
					<div class="col-md-6">
						<p class="text-bg my-3"><?php echo $showPhoneData; ?></p>
					</div>
					<div class="col-md-6">
						<p class="text-bg my-3">Email</p>
					</div>
					<div class="col-md-6">
						<p class="text-bg my-3"><small style="font-size: 10px"><?php echo $showEmailData; ?></small></p>
					</div>
				</div>
			</div>
			<div class="mx-auto file_upload mt-3">
				<form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">
				<input type="file" name="submitfile">
					<button type="submit" name="upload">Upload</button>
				</form>
				<span><?php echo $fileTypeError; ?></span>
				<span><?php echo $fileSizeError; ?></span>
				<span><?php echo $messageUpload; ?></span>
			</div>

			<div class="logout-outer outer remove-extra-padding text-center mx-auto mt-4 mb-5">
				<form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST">
					<button type="submit" name="log_out" class="text-decoration-none">Logout</button>
				</form>
			</div>
			
		</div>
	</div>
</div>

<?php require_once('template/footer.php'); ?>
</html>


