<?php
	session_start();
?>

<!DOCTYPE html>
<html>
<head>
	<title>Manager | <?php echo $_SESSION['full_name']; ?></title>
	<link rel="stylesheet" type="text/css" href="main.css">
	<script src="main_manager.js"></script>
	<link href="https://fonts.googleapis.com/css?family=Raleway&display=swap" rel="stylesheet">
</head>
<body>

<!--Navigation Bar-->
<div id="nagivation_bar">
	<!--Name-->
	<h1><?php echo $_SESSION['full_name']; ?></h1>
	<!--Link-->
	<li class="nagivation_bar_link" id="selected_nagivation_bar_link">Company</li>
	<li class="nagivation_bar_link">Appointment</li>
	<li class="nagivation_bar_link">Job Progress</li>
	<li class="nagivation_bar_link">Report</li>
	<li class="nagivation_bar_link" id="logout_btn">Logout</li>
	<!--Status-->
	<div id="status_container">
		<p id="status_content">Assigned</p>
	</div>
</div>
<!--Company-->
<div class="function_full_container" id="selected_function_full_container">
	<!--Person to assign-->
	<div id="person_to_assign_container">
		<div id="person_to_assign">
			<h1>Person to assign</h1>
			<div id="company_staff_filter">
				<input type="text" id="person_to_assign_filter" placeholder="Filter Employee With Full Name">
			</div>
			<?php person_to_assign_list(); ?>
		</div>
		<!--Add company container close btn-->
		<img src="remove_btn.png" class="btn" id="company_close_btn" title="Remove Company">
	</div>
	<!--Company table-->
	<div id="company_container">
		<div id="company_nagivation_bar">
			<h1>Company</h1>
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
				<?php retrieve_company_table(); ?>
			</table>
		</div>
	</div>
</div>
<!--Appointment-->
<div class="function_full_container">
	<div id="manager_appointment_full_container">
		<?php retrieve_appointment(); ?>
	</div>
</div>
<!--Job Progress-->
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
						<td class="company_id_detection">'.$row['Company_ID'].'</td>
						<td>'.$row['Company_name'].'</td>
						<td>'.$row['Company_address'].'</td> 
						<td>'.$row['Company_tel'].'</td>
						<td>'.$row['Company_fax'].'</td> 
						<td>'.$row['Company_year_end'].'</td>
						<td>'.$row['Company_date_in'].'</td> 
						<td>'.$row['Company_incharge_client'].'</td>
						<td>'.$row['Company_incharge_client_email'].'</td>';
						if($row['Company_incharge_staff'] != 'NULL'){
							echo '<td class="add_person_btn">'.$row['Company_incharge_staff'].'</td>';
						}else{
							echo '<td><img src="manager_add_person.png" class="add_person_btn" title="Assign Incharge Person"></td>';
						}
				echo '</tr>';
				$odd_or_even = 'even';
			}else{
				echo'<tr class="even_row">
						<td class="company_id_detection">'.$row['Company_ID'].'</td>
						<td>'.$row['Company_name'].'</td>
						<td>'.$row['Company_address'].'</td> 
						<td>'.$row['Company_tel'].'</td>
						<td>'.$row['Company_fax'].'</td> 
						<td>'.$row['Company_year_end'].'</td>
						<td>'.$row['Company_date_in'].'</td> 
						<td>'.$row['Company_incharge_client'].'</td>
						<td>'.$row['Company_incharge_client_email'].'</td>';
						if($row['Company_incharge_staff'] != 'NULL'){
							echo '<td class="add_person_btn">'.$row['Company_incharge_staff'].'</td>';
						}else{
							echo '<td><img src="manager_add_person.png" class="add_person_btn" title="Assign Incharge Person"></td>';
						}
				echo '</tr>';
				$odd_or_even = 'odd';
			}
		}
	}
}

function person_to_assign_list(){
	require 'database.php';
	# Reading all data from Employee table
	$sql = "SELECT * FROM Employee
			ORDER BY Employee_full_name ASC";
	$result = $conn->query($sql);

	if($result->num_rows > 0){
		while($row = $result->fetch_assoc()){
			echo '<div title="Assign this staff" class="person_list_container">
					<div class="image_container">
						<img src="person.png">
						<h2 class="person_full_name">'.$row['Employee_full_name'].'</h2>
					</div>
					<div class="pofile_container">
						<h3>Initial Name: '.$row['Employee_initial_name'].'</h3>
						<h3>Nickname: '.$row['Employee_nickname'].'</h3>
						<h3>Email: <span class="person_email">'.$row['Employee_email'].'</span></h3>
					</div>

				  </div>';
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
			echo '
				<div class="appointment_container">
					<div class="appointment_upper_container">
						<input type="text" name="app" class="app_input" value='.$row['Company_name'].' disabled>
						<input type="date" name="app" class="app_input" value='.$row['Appointment_date'].' disabled>
						<input type="time" name="app" class="app_input" value='.$row['Appointment_time'].' disabled>
					</div>
					<div class="appointment_lower_container">
						<div class="appointment_lower_container_content">
							<textarea placeholder="Reason" disabled>'.$row['Appointment_reason'].'</textarea>
						</div>
						<div class="appointment_lower_container_content">
							<textarea placeholder="Description" class="appointment_description">'.$row['Appointment_description'].'</textarea>
						</div>
						<button class="manager_appointment_submit_btn">Submit</button>
					</div>
				</div>
			';

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
							<h1 class="audit_status_ajax">'.$row['Audit_status'].'</h1>
						</div>
					</div>
					<div class="job_progress_bar_container">
						<div class="job_progress_bar">
							<div class="progress_bar"></div>
						</div>
					</div>
					<div class="job_details_container">
						<table>
							<td class="job_progress_task">Deadline</td>
							<td class="job_progress_task">Date Allocated</td>
							<td class="job_progress_task">Fee Approved</td>
							<td><input type="text" name="jp" class="job_progress_input" value='.$row['Deadline'].' disabled></td>
							<td><input type="text" name="jp" class="job_progress_input" value='.$row['Date_allocated'].' disabled></td>
							<td><input type="text" name="jp" class="job_progress_input" value='.$row['Fee_approved'].' disabled></td>

							<td class="job_progress_task">Quotation Prepared</td>
							<td class="job_progress_task">Quotation Sent</td>
							<td class="job_progress_task">Signing Pages Prepared</td>
							<td><input type="text" name="jp" class="job_progress_input" value='.$row['Quotation_prepared'].' disabled></td>
							<td><input type="text" name="jp" class="job_progress_input" value='.$row['Quotation_sent'].' disabled></td>
							<td><input type="text" name="jp" class="job_progress_input" value='.$row['Signing_pages_prepared'].' disabled></td>

							<td class="job_progress_task">Signing Pages Sent</td>
							<td class="job_progress_task">Thiang Pages</td>
							<td class="job_progress_task">FS To Tax</td>
							<td><input type="text" name="jp" class="job_progress_input" value='.$row['Signing_pages_sent'].' disabled></td>
							<td><input type="text" name="jp" class="job_progress_input" value='.$row['Thiang_pages'].' disabled></td>
							<td><input type="text" name="jp" class="job_progress_input" value='.$row['FS_to_tax'].' disabled></td>

							<td class="job_progress_task">Tax Computation Completed</td>
							<td class="job_progress_task">Ready To View</td>
							<td class="job_progress_task">First Review</td>
							<td><input type="text" name="jp" class="job_progress_input" value='.$row['Tax_computation_completed'].' disabled></td>
							<td><input type="text" name="jp" class="job_progress_input" value='.$row['Ready_to_view'].' disabled></td>
							<td><input type="text" name="jp" class="job_progress_input" value='.$row['1st_review'].' disabled></td>

							<td class="job_progress_task">Second Review</td>
							<td class="job_progress_task">Final Print</td>
							<td class="job_progress_task">Opening Balance Prepared</td>
							<td><input type="text" name="jp" class="job_progress_input" value='.$row['2nd_review'].' disabled></td>
							<td><input type="text" name="jp" class="job_progress_input" value='.$row['Final_print'].' disabled></td>
							<td><input type="text" name="jp" class="job_progress_input" value='.$row['Opening_balance_prepared'].' disabled></td>

							<td class="job_progress_task">Actual Completed Date</td>
							<td class="job_progress_task">Date Out</td>
							<td class="job_progress_task">Bind Status<img src="update_job_progress.png" class="update_progress_btn" title="Update"></td>
							<td><input type="text" name="jp" class="job_progress_input" value='.$row['Actual_completed_date'].' disabled></td>
							<td><input type="text" name="jp" class="job_progress_input" value='.$row['Date_out'].' disabled></td>
							<td><input type="text" name="jp" class="job_progress_input manager_jp_bind_input" value='.$row['Bind_status'].' disabled></td>
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