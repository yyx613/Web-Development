<?php
	require 'database.php';

	$name = $_GET['name'];
	$company_index = $_GET['company_index'];

	$sql = "UPDATE Company
			SET Company_incharge_staff='".$name."'
			WHERE Company_ID='".$company_index."'";

	if($conn->query($sql) === TRUE){
		// Add notification
	}
?>