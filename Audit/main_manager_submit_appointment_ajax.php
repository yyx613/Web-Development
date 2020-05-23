<?php
	require 'database.php';

	$d = $_GET['d'];
	$idx = $_GET['idx'] + 1;

	$sql = "UPDATE Appointment
			SET Appointment_description='".$d."'
			WHERE Appointment_ID='".$idx."'";

	if($conn->query($sql) === TRUE){
		//
	}
?>