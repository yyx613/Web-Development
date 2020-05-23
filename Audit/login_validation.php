<?php
	require 'database.php'; //Access to database

	session_start();

	$email = $_POST['email'];
	$password = $_POST['password'];
	$valid = false;

	# Employee table
	$sql = "SELECT * FROM Employee";
	$result = $conn->query($sql);
	
	if($result->num_rows > 0){
		while($row = $result->fetch_assoc()){
			if($row['Employee_email'] == $email && $row['Employee_password'] == $password){ # if input email match Worker table's employee email
				$_SESSION['full_name'] = $row['Employee_full_name'];
				$valid = true;
				header('Location: main_staff.php'); # Heading to main_staff.php
			}
		}
	}

	# Manager table
	$sql = "SELECT * FROM Manager";
	$result = $conn->query($sql);
	
	if($result->num_rows > 0){
		while($row = $result->fetch_assoc()){
			if($row['Manager_email'] == $email && $row['Manager_password'] == $password){
				$_SESSION['full_name'] = $row['Manager_full_name'];
				$valid = true;
				header('Location: main_manager.php'); # Heading to main_manager.php
			}
		}
	}
		
	# Heading back to login.php if failed to login
	if($valid == false){
		header('Location: login.php');
	}
?>