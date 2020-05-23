<?php
	require 'database.php'; //Access to database

	$email = $_POST['email'];
	$full_name = $_POST['full_name'];
	$initial_name = $_POST['initial_name'];
	$nickname = $_POST['nickname'];
	$password = $_POST['password'];
	$position = $_POST['position'];

	$email_existed = False;

	# Reading all data from Employee table for validation
	$sql = "SELECT Employee_email FROM Employee";
	$result = $conn->query($sql);

	if($result->num_rows > 0){
		while($row = $result->fetch_assoc()){
			if($row['Employee_email'] == $email){
				$email_existed = True;
			}
		}
	}

	# Reading all data from Manager table for validation
	$sql = "SELECT Manager_email FROM Manager";
	$result = $conn->query($sql);

	if($result->num_rows > 0){
		while($row = $result->fetch_assoc()){
			if($row['Manager_email'] == $email){
				$email_existed = True;
			}
		}
	}

	# Inserting data
	if($position == 'employee' && $email_existed == False){
		$sql = "INSERT INTO Employee (Employee_email, Employee_full_name, Employee_initial_name, Employee_nickname, Employee_password)
				VALUES ('$email','$full_name','$initial_name','$nickname','$password')";

		# Inserting data into Employee table
		if($conn->query($sql) === TRUE){
			echo 'Successfully inserted the data into Employee table';
		}else{
			echo 'Error:'.$conn->error;
		}
	}elseif($position == 'manager' && $email_existed == False){
		$sql = "INSERT INTO Manager (Manager_email, Manager_full_name, Manager_initial_name, Manager_nickname, Manager_password)
				VALUES ('$email','$full_name','$initial_name','$nickname','$password')";

		# Inserting data into Manager table
		if($conn->query($sql) === TRUE){
			echo 'Successfully inserted the data into Manager table';
		}else{
			echo 'Error:'.$conn->error;
		}
	}else{
		echo $email.' occupied';
	}
	

	$email_existed = False; # Reset

	# Heading to register.php
	header('Location: register.php');
	

?>