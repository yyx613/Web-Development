<?php
	require 'database.php';

	$cn = $_GET['cn'];
	$en = $_GET['en'];
	$d = $_GET['d'];
	$t = $_GET['t'];
	$r = $_GET['r'];

	$sql = "INSERT INTO Appointment(Appointment_time, Appointment_reason, Appointment_date, Company_name, Employee_name)
			VALUES ('$t', '$r', '$d', '$cn', '$en')";

	if($conn->query($sql) === TRUE){
		echo '<p>test</p>';
	}
?>