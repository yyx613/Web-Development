<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<link rel="stylesheet" type="text/css" href="login_register.css">
</head>
<body>

<div id="background">
	<!--Login Container-->
	<div id="login_register_container">
		<h1>Login</h1>
		<!--Login Form-->
		<form action="login_validation.php" method="POST">
			<input type="email" name="email" placeholder="Email">
			<input type="password" name="password" placeholder="Password">
			<input type="submit" name="login_btn" value="Login" id="login_btn">
		</form>
		<!--Register Link-->
		<a href="register.php" id="login_register_link">Register</a>
	</div>
</div>

</body>
</html>