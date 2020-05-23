<?php
	session_start();
?>

<!DOCTYPE html>
<html>
<head>
	<title>Staff | <?php echo $_SESSION['full_name']; ?></title>
	<link rel="stylesheet" type="text/css" href="main.css">
	<script src="main_staff.js"></script>
	<link href="https://fonts.googleapis.com/css?family=Raleway&display=swap" rel="stylesheet">
</head>
<body>

<!--Navigation Bar-->
<div id="nagivation_bar">
	<!--Name-->
	<h1 id="user_name"><?php echo $_SESSION['full_name']; ?></h1>
	<!--Link-->
	<li class="nagivation_bar_link" id="selected_nagivation_bar_link">Company</li>
	<li class="nagivation_bar_link">Appointment</li>
	<li class="nagivation_bar_link">Job Progress</li>
	<li class="nagivation_bar_link">Report</li>
	<li class="nagivation_bar_link" id="logout_btn">Logout</li>
	<!--Status-->
	<div id="status_container">
		<p id="status_content"></p>
	</div>
</div>
<!--Company-->
<div class="function_full_container" id="selected_function_full_container">
	<!--Add company pop up-->
	<div id="add_company_pop_up_full_container">
		<div id="add_company_pop_up_container">
			<div id="add_company_pop_up_title">
				<h1>Add new company</h1>
			</div>
			<!--Add company form-->
			<form id="add_company_form">
				<input type="text" class="add_company_form" name="company_name" placeholder="Company Name" required>
				<input type="text" class="add_company_form" name="company_address" placeholder="Company Address" required>
				<input type="text" class="add_company_form"name="company_tel" placeholder="Company Tel" required>
				<input type="text" class="add_company_form" name="company_fax" placeholder="Company Fax" required> 
				<input type="text" class="add_company_form" name="company_year_end" placeholder="Company Year End" required>
				<input type="text" class="add_company_form" name="company_date_in" placeholder="Company Date In" required>
				<input type="text" class="add_company_form" name="company_incharge_client" placeholder="Incharge Client" required>
				<input type="text" class="add_company_form" name="company_incharge_client_email" placeholder="Incharge Client Email" required>
			</form>
			<button class="btn" id="add_company_pop_up_btn" type="submit">ADD</button>
		</div>
		<!--Add company container close btn-->
		<img src="remove_btn.png" class="btn" id="company_close_btn" title="Remove Company">
	</div>
	<div id="company_container">
		<div id="company_nagivation_bar">
			<h1>Company</h1>
			<!--Add company button-->
			<img src="add_btn.png" class="btn" id="add_company_btn" title="Add Company">
		</div>
		<div id="company_table">
			<table>
				<tr>
					<th>Name</th>
					<th>Address</th> 
					<th>Tel</th>
					<th>Fax</th> 
					<th>Year end</th>
					<th>Date in</th> 
					<th>Incharge client</th> 
					<th>Incharge client email</th>
					<th>Incharge staff</th> 
				</tr>
				<?php  retrieve_company_table();  ?>
			</table>
		</div>
	</div>
</div>
<!--Appointment-->
<div class="function_full_container">
	<div id="make_appointment_container">
		Make an appointment
	</div>
	<div id="appointment_full_container">
		<?php retrieve_appointment(); ?>
	</div>
	<div id="appointment_form_container">
		<div id="appointment_form">
			<input type="text" placeholder="Company Name" class="appointment_form_input">
			<input type="text" placeholder="Date" class="appointment_form_input">
			<input type="text" placeholder="Time" class="appointment_form_input">
			<textarea placeholder="Reason" class="appointment_form_input"></textarea>
			<button id="appointment_form_btn">Submit</button>
		</div>
		<img src="remove_btn.png" class="btn" id="appointment_close_btn">
	</div>
</div>
<!--Job progress-->
<div class="function_full_container">
	<div id="job_progress_full_container">
		<?php retreive_job_progress(); ?>
	</div>
</div>
<!--Report-->
<div class="function_full_container">
	<div id="report_nagivation_container">
		<div class="report_nagivation_link">
			<h4>Total Company</h4>
		</div>
		<div class="report_nagivation_link">
			<h4>Staff With Assigned Jobs</h4>
		</div>
	</div>

	<div class="report_content_full_container">
		<div class="report_content_container">
			<div id="total_company_filter_container">
				<div class="total_company_filter_content">
					<input type="text" id="total_company_year_filter" placeholder="Year">
				</div>
				<div class="total_company_filter_content">
					<input type="text" id="total_company_month_filter" placeholder="Month">
				</div>
				<div class="total_company_filter_content">
					<input type="text" id="total_company_day_filter" placeholder="Day">
				</div>
			</div>
			<img src="company_fax.png" title="Print" id="total_company_printer">
			<table id="total_company_table">
				<tr>
					<th>Company Name</th>
					<th>Year End</th> 
					<th>Incharge Client</th>
					<th>Incharge Client Email</th>
				</tr>
				<?php retrieve_total_company(); ?>
			</table>
		</div>
	</div>

	<div class="report_content_full_container">
		<div class="report_content_container">
			<input type="text" placeholder="Filter Employee Initial Name" id="report_staff_filter">
			<img src="company_fax.png" id="staff_job_printer">
			<table id="staff_table">
				<tr>
					<th>Company Name</th>
					<th>Year End</th> 
					<th>Employee Full Name</th>
					<th>Employee Initial Name</th>  
				</tr>
				<?php retrieve_staff_report(); ?>
			</table>
		</div>
	</div>
</div>


</body>
</html>


<?php
function retrieve_company_table(){
	require 'database.php';
	# Reading all data from Company table
	$sql = "SELECT * FROM Company
			ORDER BY Company_name ASC";
	$result = $conn->query($sql);

	if($result->num_rows > 0){
		$odd_or_even = 'odd';
		while($row = $result->fetch_assoc()){
			if($odd_or_even == 'odd'){
				echo'<tr>
						<td>'.$row['Company_name'].'</td>
						<td>'.$row['Company_address'].'</td> 
						<td>'.$row['Company_tel'].'</td>
						<td>'.$row['Company_fax'].'</td> 
						<td>'.$row['Company_year_end'].'</td>
						<td>'.$row['Company_date_in'].'</td> 
						<td>'.$row['Company_incharge_client'].'</td>
						<td>'.$row['Company_incharge_client_email'].'</td>';
						// Company_incharge_staff
						if($row['Company_incharge_staff'] == 'NULL'){
							echo '<td>Pending</td>';
						}else{
							echo '<td>'.$row['Company_incharge_staff'].'</td>';
						}
					echo'</tr>';
				$odd_or_even = 'even';
			}elseif($odd_or_even == 'even'){
				echo'<tr class="even_row">
						<td>'.$row['Company_name'].'</td>
						<td>'.$row['Company_address'].'</td> 
						<td>'.$row['Company_tel'].'</td>
						<td>'.$row['Company_fax'].'</td> 
						<td>'.$row['Company_year_end'].'</td>
						<td>'.$row['Company_date_in'].'</td> 
						<td>'.$row['Company_incharge_client'].'</td>
						<td>'.$row['Company_incharge_client_email'].'</td>';
						// Company_incharge_staff
						if($row['Company_incharge_staff'] == 'NULL'){
							echo '<td>Pending</td>';
						}else{
							echo '<td>'.$row['Company_incharge_staff'].'</td>';
						}
					echo'</tr>';
				$odd_or_even = 'odd';
			}
		}
	}
}

function retreive_job_progress(){
	require 'database.php';
	# Reading all data from Company table
	$sql = "SELECT * FROM Company
			LEFT JOIN Audit_work_progress
			ON Company.Company_ID=Audit_work_progress.Audit_work_ID
			ORDER BY Company_name ASC";
	$result = $conn->query($sql);

	if($result->num_rows > 0){
		while($row = $result->fetch_assoc()){
			echo '
				<div class="job_progress_container">
					<h1 class="job_progress_audit_work_id_detection">'.$row['Audit_work_ID'].'</h1>
					<div class="job_progress_name">
						<div id="job_progress_name_content_first">
							<h1>'.$row['Company_name'].'</h1>
						</div>
						<div id="job_progress_name_content_second">
							<h1 class="bind_status_ajax">'.$row['Bind_status'].'</h1>
						</div>
					</div>
					<div class="job_progress_bar_container">
						<div class="job_progress_bar">
							<div class="progress_bar"></div>
						</div>
					</div>
					<div class="job_details_container">
						<table>
							<td class="job_progress_task">Deadline<img src="update_job_progress.png" class="update_progress_btn" title="Update"></td>
							<td class="job_progress_task">Date Allocated<img src="update_job_progress.png" class="update_progress_btn" title="Update"></td>
							<td class="job_progress_task">Fee Approved<img src="update_job_progress.png" class="update_progress_btn" title="Update"></td>
							<td><input type="text" name="jp" class="job_progress_input" value='.$row['Deadline'].' disabled></td>
							<td><input type="text" name="jp" class="job_progress_input" value='.$row['Date_allocated'].' disabled></td>
							<td><input type="text" name="jp" class="job_progress_input" value='.$row['Fee_approved'].' disabled></td>

							<td class="job_progress_task">Quotation Prepared<img src="update_job_progress.png" class="update_progress_btn" title="Update"></td>
							<td class="job_progress_task">Quotation Sent<img src="update_job_progress.png" class="update_progress_btn" title="Update"></td>
							<td class="job_progress_task">Signing Pages Prepared<img src="update_job_progress.png" class="update_progress_btn" title="Update"></td>
							<td><input type="text" name="jp" class="job_progress_input" value='.$row['Quotation_prepared'].' disabled></td>
							<td><input type="text" name="jp" class="job_progress_input" value='.$row['Quotation_sent'].' disabled></td>
							<td><input type="text" name="jp" class="job_progress_input" value='.$row['Signing_pages_prepared'].' disabled></td>

							<td class="job_progress_task">Signing Pages Sent<img src="update_job_progress.png" class="update_progress_btn" title="Update"></td>
							<td class="job_progress_task">Thiang Pages<img src="update_job_progress.png" class="update_progress_btn" title="Update"></td>
							<td class="job_progress_task">FS To Tax<img src="update_job_progress.png" class="update_progress_btn" title="Update"></td>
							<td><input type="text" name="jp" class="job_progress_input" value='.$row['Signing_pages_sent'].' disabled></td>
							<td><input type="text" name="jp" class="job_progress_input" value='.$row['Thiang_pages'].' disabled></td>
							<td><input type="text" name="jp" class="job_progress_input" value='.$row['FS_to_tax'].' disabled></td>

							<td class="job_progress_task">Tax Computation Completed<img src="update_job_progress.png" class="update_progress_btn" title="Update"></td>
							<td class="job_progress_task">Ready To View<img src="update_job_progress.png" class="update_progress_btn" title="Update"></td>
							<td class="job_progress_task">First Review<img src="update_job_progress.png" class="update_progress_btn" title="Update"></td>
							<td><input type="text" name="jp" class="job_progress_input" value='.$row['Tax_computation_completed'].' disabled></td>
							<td><input type="text" name="jp" class="job_progress_input" value='.$row['Ready_to_view'].' disabled></td>
							<td><input type="text" name="jp" class="job_progress_input" value='.$row['1st_review'].' disabled></td>

							<td class="job_progress_task">Second Review<img src="update_job_progress.png" class="update_progress_btn" title="Update"></td>
							<td class="job_progress_task">Final Print<img src="update_job_progress.png" class="update_progress_btn" title="Update"></td>
							<td class="job_progress_task">Opening Balance Prepared<img src="update_job_progress.png" class="update_progress_btn" title="Update"></td>
							<td><input type="text" name="jp" class="job_progress_input" value='.$row['2nd_review'].' disabled></td>
							<td><input type="text" name="jp" class="job_progress_input" value='.$row['Final_print'].' disabled></td>
							<td><input type="text" name="jp" class="job_progress_input" value='.$row['Opening_balance_prepared'].' disabled></td>

							<td class="job_progress_task">Actual Completed Date<img src="update_job_progress.png" class="update_progress_btn" title="Update"></td>
							<td class="job_progress_task">Date Out<img src="update_job_progress.png" class="update_progress_btn" title="Update"></td>
							<td class="job_progress_task">Audit Status<img src="update_job_progress.png" class="update_progress_btn" title="Update"></td>
							<td><input type="text" name="jp" class="job_progress_input" value='.$row['Actual_completed_date'].' disabled></td>
							<td><input type="text" name="jp" class="job_progress_input" value='.$row['Date_out'].' disabled></td>
							<td><input type="text" name="jp" class="job_progress_input" value='.$row['Audit_status'].' disabled></td>
						</table>
					</div>
					<div class="job_details_btn_container">
						<img src="show_job_details_btn.png" class="job_details_btn" title="Show details">
					</div>
				</div>
				 ';
		}
	}
}

function retrieve_appointment(){
	require 'database.php';
	# Reading all data from Appointment table
	$sql = "SELECT * FROM Appointment";
	$result = $conn->query($sql);

	if($result->num_rows > 0){
		while($row = $result->fetch_assoc()){
			if($row['Employee_name'] == $_SESSION['full_name']){
				echo '
					<div class="appointment_container">
						<h1 class="appointment_aid">'.$row['Appointment_ID'].'</h1>
						<div class="appointment_icon_container">
							<img src="remove_appointment.png" title="Remove" class="remove_appointment_btn">
							<img src="edit_appointment.png" title="Update" class="edit_appointment_btn">
						</div>
						<div class="appointment_upper_container">
							<input type="text" name="app" class="app_input" value='.$row['Company_name'].' disabled>
							<input type="date" name="app" class="app_input" value='.$row['Appointment_date'].' disabled>
							<input type="time" name="app" class="app_input" value='.$row['Appointment_time'].' disabled>
						</div>
						<div class="appointment_lower_container">
							<div class="appointment_lower_container_content">
								<textarea placeholder="Reason" disabled class="app_input">'.$row['Appointment_reason'].'</textarea>
							</div>
							<div class="appointment_lower_container_content">
								<textarea placeholder="Description" disabled>'.$row['Appointment_description'].'</textarea>
							</div>
						</div>
					</div>
				';
			}
		}
	}
}

function retrieve_total_company(){
	require 'database.php';
	# Reading all data from Company table
	$sql = "SELECT * FROM Company
			ORDER BY Company_name ASC";
	$result = $conn->query($sql);

	if($result->num_rows > 0){
		while($row = $result->fetch_assoc()){
			echo'<tr class="company_report_div">
					<td>'.$row['Company_name'].'</td>
					<td class="report_company_list">'.$row['Company_year_end'].'</td>
					<td>'.$row['Company_incharge_client'].'</td> 
					<td>'.$row['Company_incharge_client_email'].'</td>';
			echo '</tr>';
		}
	}
}

function retrieve_staff_report(){
	require 'database.php';
	# Reading all data from Company table
	$sql = "SELECT * FROM Company
			LEFT JOIN Employee
			ON Company.Company_incharge_staff=Employee.Employee_full_name
			ORDER BY Company_name ASC";
	$result = $conn->query($sql);

	if($result->num_rows > 0){
		while($row = $result->fetch_assoc()){
			if($row['Employee_full_name'] != NULL){
				echo'<tr class="staff_report_div">
						<td>'.$row['Company_name'].'</td>
						<td>'.$row['Company_year_end'].'</td>
						<td class="report_staff_list">'.$row['Employee_full_name'].'</td> 
						<td>'.$row['Employee_initial_name'].'</td>';
				echo '</tr>';
			}
		}
	}
}
?>