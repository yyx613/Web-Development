<?php require 'database.php'; ?>
<?php include 'trainer_course.php'; ?>
<?php include 'trainer_test.php'; ?>
<?php include 'trainer_student.php'; ?>
<?php session_start(); ?>

<!DOCTYPE html>
<html>
<head>
	<title>Trainer (<?php echo $_SESSION['username']; ?>)</title>
	<link rel="stylesheet" type="text/css" href="trainer.css">
	<script type="text/javascript" src="trainer.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
	<link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
</head>
<body>
	<p id="txtHint">d<p>
	<!--profile picture-->
	<div id="profile_container">
		<div id="profile_picture_container">
			<div id="profile_picture">
				<img src=<?php echo 'upload/'.$_SESSION['profile_picture']; ?>>
			</div>
		</div>
	</div>
	<!--nagivation-->
	<div id="nagivation_bar">
		<li class="nav_button">Course</li>
		<li class="nav_button">Student</li>
		<li class="nav_button">Setting</li>
	</div>
	<!--content-->
	<div id="content_container">
		<!--course-->
		<div id="course_container">
			<?php dynamic_course(); ?>
		</div>

		<!--student-->
		<div id="student_container">
			<div id="student_content_container">

				<?php dynamic_student(); ?>

			</div>
		</div>

		<!--setting-->
		<div id="setting_container">
			<div id="setting_content_container">
				<div class="setting_content">a</div>
				<div class="setting_content">b</div>
				<div class="setting_content">
					<i class="fas fa-sign-out-alt"></i>
					<h1>Logout</h1>
				</div>
			</div>
		</div>
	</div>

	<!--notification-->
	<div id="notification_container">
		Saved
	</div>

</body>
</html>