<!DOCTYPE html>
<html>
<head>
	<title>Register</title>
	<link rel="stylesheet" type="text/css" href="login_register.css">
</head>
<body>

<div id="background">
	<!--Register Container-->
	<div id="login_register_container">
		<h1>Register</h1>
		<!--Register Form-->
		<form action="register_validation.php" method="POST">
			<input type="email" name="email" placeholder="Email">
			<input type="text" name="full_name" placeholder="Full Name">
			<input type="text" name="initial_name" placeholder="Initial Name">
			<input type="text" name="nickname" placeholder="Nickname">
			<input type="password" name="password" placeholder="Password">
			<select id="register_selection" name="position" required>
				<option value="" selected hidden="true">Position</option>
				<option value="employee">Employee</option> 
				<option value="manager">Manager</option>
			</select>
			<input type="submit" name="register_btn" value="Register">
		</form>
		<!--Login Link-->
		<a href="login.php" id="login_register_link">Login</a>
	</div>
</div>

</body>
</html>