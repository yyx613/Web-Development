<?php

	require 'database.php';

	$aid = $_GET['aid'];

	$sql = "DELETE FROM Appointment
			WHERE Appointment_ID='".$aid."'";

	if($conn->query($sql) === TRUE){
		//
	}
?>