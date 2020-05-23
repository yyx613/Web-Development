<?php
	$servername = "localhost";
	$username = "root";
	$password = "";
	$database = "luhui";

	//Connect to server
	$conn = new mysqli($servername, $username, $password);

	//Create database if not exists
	$sql = "CREATE DATABASE IF NOT EXISTS ".$database;

	if($conn->query($sql) === TRUE){
		echo '<script> console.log("Successfully created to database"); </script>';
	}else{
		echo 'Error creating database:'.$conn->error;
	}

	//Connect to database
	$conn = new mysqli($servername, $username, $password, $database);

	echo '<script> console.log("Successfully connected to database"); </script>';


	//Create Company table if not exists
	$sql = "CREATE TABLE IF NOT EXISTS Company(
			Company_ID INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
			Company_name VARCHAR(100) NOT NULL,
			Company_address VARCHAR(100) NOT NULL,
			Company_tel VARCHAR(100) NOT NULL,
			Company_fax VARCHAR(100) NOT NULL,
			Company_year_end DATE NOT NULL,
			Company_date_in DATE NOT NULL,
			Company_incharge_client VARCHAR(100) NOT NULL,
			Company_incharge_client_email VARCHAR(100) NOT NULL,
			Company_incharge_staff VARCHAR(100) DEFAULT 'NULL'
			 )";

	if($conn->query($sql) === TRUE){
		echo '<script> console.log("Successfully created Company table"); </script>';
	}else{
		echo "Error creating Company table: ".$conn->error;
	}


	//Create Audit work progress table if not exists
	$sql = "CREATE TABLE IF NOT EXISTS Audit_work_progress(
			Audit_work_ID INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
			Deadline VARCHAR(100) DEFAULT '-',
			Date_allocated VARCHAR(100) DEFAULT '-',
			Fee_approved VARCHAR(100) DEFAULT '-',
			Quotation_prepared VARCHAR(100) DEFAULT '-',
			Quotation_sent VARCHAR(100) DEFAULT '-',
			Signing_pages_prepared VARCHAR(100) DEFAULT '-',
			Signing_pages_sent VARCHAR(100) DEFAULT '-',
			Thiang_pages VARCHAR(100) DEFAULT '-',
			FS_to_tax VARCHAR(100) DEFAULT '-',
			Tax_computation_completed VARCHAR(100) DEFAULT '-',
			Ready_to_view VARCHAR(100) DEFAULT '-',
			1st_review VARCHAR(100) DEFAULT '-',
			2nd_review VARCHAR(100) DEFAULT '-',
 			Final_print VARCHAR(100) DEFAULT '-',
 			Opening_balance_prepared VARCHAR(100) DEFAULT '-',
 			Actual_completed_date VARCHAR(100) DEFAULT '-',
 			Date_out VARCHAR(100) DEFAULT '-',
 			Audit_status VARCHAR(100) DEFAULT 'Ongoing',
 			Bind_status VARCHAR(100) DEFAULT 'Pending',
 			Company_ID INT,
 			FOREIGN KEY (Company_ID) REFERENCES Company(Company_ID)
			 )";

	if($conn->query($sql) === TRUE){
		echo '<script> console.log("Successfully created Audit work progress table"); </script>';
	}else{
		echo "Error creating Audit work progress table: ".$conn->error;
	}


	//Create Employee table if not exists
	$sql = "CREATE TABLE IF NOT EXISTS Employee(
			Employee_ID INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
			Employee_email VARCHAR(100) NOT NULL UNIQUE,
			Employee_full_name VARCHAR(100) NOT NULL UNIQUE,
			Employee_initial_name VARCHAR(100) NOT NULL,
			Employee_nickname VARCHAR(100) NOT NULL,
			Employee_password VARCHAR(100) NOT NULL,
			Company_ID INT,
			Audit_work_ID INT,
			FOREIGN KEY (Company_ID) REFERENCES Company(Company_ID),
			FOREIGN KEY (Audit_work_ID) REFERENCES Audit_work_progress(Audit_work_ID)
			 )";

	if($conn->query($sql) === TRUE){
		echo '<script> console.log("Successfully created Worker table"); </script>';
	}else{
		echo "Error creating Worker table: ".$conn->error;
	}

	
	//Create Manager table if not exists
	$sql = "CREATE TABLE IF NOT EXISTS Manager(
			Manager_ID INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
			Manager_email VARCHAR(100) NOT NULL UNIQUE,
			Manager_full_name VARCHAR(100) NOT NULL,
			Manager_initial_name VARCHAR(100) NOT NULL,
			Manager_nickname VARCHAR(100) NOT NULL,
			Manager_password VARCHAR(100) NOT NULL,
			Employee_ID INT,
			Audit_work_ID INT,
			FOREIGN KEY (Employee_ID) REFERENCES Employee(Employee_ID),
			FOREIGN KEY (Audit_work_ID) REFERENCES Audit_work_progress(Audit_work_ID)
			 )";

	if($conn->query($sql) === TRUE){
		echo '<script> console.log("Successfully created Manager table"); </script>';
	}else{
		echo "Error creating Manager table: ".$conn->error;
	}


	//Create Appointment table if not exists
	$sql = "CREATE TABLE IF NOT EXISTS Appointment(
			Appointment_ID INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
			Appointment_date DATE,
			Appointment_time TIME,
			Appointment_reason VARCHAR(100),
			Appointment_status VARCHAR(100),
			Appointment_description VARCHAR(100),
			Company_name VARCHAR(100),
			Employee_name VARCHAR(100),
			Employee_ID INT,
			Manager_ID INT,
			FOREIGN KEY (Employee_ID) REFERENCES Employee(Employee_ID),
			FOREIGN KEY (Manager_ID) REFERENCES Manager(Manager_ID)
			 )";

	if($conn->query($sql) === TRUE){
		echo '<script> console.log("Successfully created Appointment table"); </script>';
	}else{
		echo "Error creating Appointment table: ".$conn->error;
	}
?>