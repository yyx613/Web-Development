<?php
	require 'database.php';

	$temp = '-';

	// Audit work progress
	$sql = "INSERT INTO Audit_work_progress(Fee_approved)
			VALUES ('$temp')";

	if($conn->query($sql) === TRUE){
		//echo 'Audit inserted';
	}

	// Add company
	$cn = $_GET['cn'];
	$ca = $_GET['ca'];
	$ct = $_GET['ct'];
	$cf = $_GET['cf'];
	$cy = $_GET['cy'];
	$cdi = $_GET['cdi'];
	$ic = $_GET['ic'];
	$ice = $_GET['ice'];
	
	$sql = "INSERT INTO Company(Company_name, Company_address, Company_tel, Company_fax, Company_year_end, Company_date_in, Company_incharge_client, Company_incharge_client_email) 
			VALUES ('$cn', '$ca', '$ct', '$cf', '$cy', '$cdi', '$ic', '$ice')";

	if($conn->query($sql) === TRUE){
		//echo 'Company inserted';
	}
?>