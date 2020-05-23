<?php
	require 'database.php';

	// Add company
	$id = $_GET['id'];
	$value = $_GET['value'];

	$sql = "UPDATE Audit_work_progress
			SET Bind_status='".$value."'
			WHERE Audit_work_ID='".$id."'";

	if($conn->query($sql) === TRUE){
		//echo 'Company inserted';
	}
?>