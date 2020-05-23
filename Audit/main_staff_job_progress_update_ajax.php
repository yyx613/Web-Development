<?php
	require 'database.php';

	// Add company
	$temp = $_GET['temp'];
	$real_row_idx = $_GET['real_row_idx'];
	$row_idx = $_GET['row_idx'];
	$col_idx = $_GET['col_idx'] - ($row_idx * 17) - $row_idx;
	$db_col = ['Deadline',
			   'Date_allocated',
			   'Fee_approved',
			   'Quotation_prepared',
			   'Quotation_sent',
			   'Signing_pages_prepared',
			   'Signing_pages_sent',
			   'Thiang_pages',
			   'FS_to_tax',
			   'Tax_computation_completed',
			   'Ready_to_view',
			   '1st_review',
			   '2nd_review',
			   'Final_print',
			   'Opening_balance_prepared',
			   'Actual_completed_date',
			   'Date_out',
			   'Audit_status'];

	$sql = "UPDATE Audit_work_progress
			SET $db_col[$col_idx]='$temp'
			WHERE Audit_work_ID=$real_row_idx";

	if($conn->query($sql) === TRUE){
		//echo 'Company inserted';
	}
?>