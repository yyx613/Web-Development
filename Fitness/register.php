<?php include "register_validation.php"; ?>

<!DOCTYPE html>
<html>
<head>
	<title>register</title>
	<link rel="stylesheet" type="text/css" href="login_register.css">
	<script type="text/javascript" src="register.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
	<link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
</head>
<body>


<!--background-->
<div id="background">
	<img src="Image/fitness.jpg">
</div>

<!--form-->
<div id="form_container">
	<!--register-->
	<div id="register_container">
		<h1>Register</h1>
		<!--form-->
		<form action="" method="post" enctype="multipart/form-data">
			<!--user image-->
			<div id="user_image_container">
				<div id="user_image" title="Upload profile picture">
					<label>
			    		<input type="file" name="register_user_image" id="user_image_input">
			    		<img src="Image/default_user_image.jpg" id="user_image_src">
			    	</label>
				</div>
			</div>
			<div class="input_message">
				<?php echo $GLOBALS['user_image_message']; ?>
			</div>

			<input type="email" name="register_email" placeholder="Email" required>
			<input type="text" name="register_username" placeholder="Username" required>
			<input type="text" name="register_password" placeholder="Password" required>
			<input type="text" name="register_confirm_password" placeholder="Confirm Password" required>
			<div class="input_message">
				<?php echo $GLOBALS['confirm_password_message']; ?>
			</div>
			<div id="radio_type_input">
				<input type="radio" name="register_position" value="student" required>Student
				<input type="radio" name="register_position" value="trainer" required>Trainer
			</div>
			<input type="submit" name="register_submit" value="Register" id="register_submit_button">
		</form>
		<div class="switcher">
			<span title="Go to login page">Login</span>
		</div>
		<!--register message-->
		<div id="register_message">
			<?php echo $register_message; ?>
		</div>
	</div>
</div>













</body>
</html>