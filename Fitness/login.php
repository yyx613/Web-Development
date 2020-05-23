<?php include "login_validation.php"; ?>

<!DOCTYPE html>
<html>
<head>
	<title>login</title>
	<link rel="stylesheet" type="text/css" href="login_register.css">
	<script type="text/javascript" src="login.js"></script>
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
	<!--login-->
	<div id="login_container">
		<h1>Login</h1>
		<!--user image-->
		<div id="user_image_container">
			<div id="user_image">
				<img src="Image/default_user_image.jpg">
			</div>
		</div>
		<!--form-->
		<form action="" method="post">
			<input type="email" name="login_email" placeholder="Email" required>
			<input type="text" name="login_password" placeholder="Password" required>
			<div class="input_message">
				<?php echo $message; ?>
			</div>
			<input type="submit" name="login_submit" value="Login">
		</form>
		<div class="switcher">
			<span title="Go to register page">Register</span>
		</div>
	</div>
</div>


</body>
</html>