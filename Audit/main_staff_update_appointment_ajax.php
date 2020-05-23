<?php

	require 'database.php';

	$cn = $_GET['cn'];
	$d = $_GET['d'];
	$t = $_GET['t'];
	$r = $_GET['r'];
	$aid = $_GET['aid'];

	$sql = "UPDATE Appointment
			SET Appointment_time='".$t."', Appointment_reason='".$r."', Appointment_date='".$d."', Appointment_reason='".$r."', Company_name='".$cn."'
			WHERE Appointment_ID='".$aid."'";

	if($conn->query($sql) === TRUE){
		//
	}
?>