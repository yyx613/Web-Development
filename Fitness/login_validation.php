<?php
	require 'database.php';

	//Creata a session to bring user information to main page 
	session_start();

	$message = null;

	//Determine whether the acc exists or not
	if(isset($_POST['login_submit'])){
		$email = $_POST['login_email'];
		$password = $_POST['login_password'];

		$sql = "SELECT * FROM user_main_info";
		$result = $conn->query($sql);

		if($result->num_rows > 0){
			while($row = $result->fetch_assoc()){
				//echo 'email: '.$row["email"].' password: '.$row["password"];
				if($row['email'] == $email && $row['password'] == $password){
					$_SESSION['email'] = $row['email'];
					$_SESSION['username'] = $row['username'];
					$_SESSION['profile_picture'] = $row['profile_picture'];
					//Determine user is student or trainer
					if($row['position'] == 'student'){
						header('location: student.php');
					}else{
						header('location: trainer.php');
					}
				}
			}
			$message = "Email or password incorrect";
		}
	}



?>