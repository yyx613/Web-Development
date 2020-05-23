<?php
	$GLOBALS['student_data'] = [];

	//Retrieve data from user_statistic_info
	$sql = "SELECT * FROM user_statistic_info";
	$result = $conn->query($sql);

	if($result->num_rows > 0){
		while($row = $result->fetch_assoc()){
			$student_temp_data['email'] = $row['email'];
			$student_temp_data['course'] = $row['course'];
			$student_temp_data['stamina'] = $row['stamina'];
			$student_temp_data['skill'] = $row['skill'];
			$student_temp_data['luck'] = $row['luck'];
			$student_temp_data['video'] = $row['video'];

			array_push($GLOBALS['student_data'], $student_temp_data);
		}
	}

	//print_r($GLOBALS['student_data']);
	//echo sizeof($GLOBALS['student_data']);
	//print_r($GLOBALS['student_data'][0]);
/*
	foreach ($GLOBALS['student_data'][0] as $key => $value) {
		echo $key.' => '.$value.'<br>';
	}
*/
/*
	$sql = "UPDATE user_statistic_info
			SET stamina='20', skill='80', luck='50'
			WHERE email='Sf!@gmail.com' ";

	if($conn->query($sql) === TRUE){
		echo "Successful";
	}
*/
	//echo $GLOBALS['student_data'][0]['course'];

	function dynamic_student(){
		for ($i=0; $i < sizeof($GLOBALS['student_data']); $i++) { 
			echo '<div class="student_content">
				<h1 class="track_email">'.$GLOBALS['student_data'][$i]['email'].'</h1>
				<div class="upper_container">
					'.$GLOBALS['student_data'][$i]['course'].'
				</div>
				<div class="middle_container">
					<!--student profile-->
					<div class="student_profile_container">
						<!--student image-->
						<div class="student_image_container">
							<div class="student_image">
								<img src="Image/default_user_image.jpg">
							</div>
						</div>
						<!--student name-->
						<h1 class="student_name">User name</h1>
					</div>
					<!--statistic-->
					<div class="student_statistic_container">
						<div class="status_container">
							<!--status info-->
							<div class="status_info_container">
								<div class="status_info">Stamina</div>
								<div class="status_info">Skill</div>
								<div class="status_info">Luck</div>
							</div>
							<!--status input-->
							<div class="status_input_container">
								<div class="status_input"><input type="range" name="stamina_value" min="0" max="100" value="'.$GLOBALS['student_data'][$i]['stamina'].'" class="status_value"></div>
								<div class="status_input"><input type="range" name="skill_value" min="0" max="100" value="'.$GLOBALS['student_data'][$i]['skill'].'" class="status_value"></div>
								<div class="status_input"><input type="range" name="luck_value" min="0" max="100" value="'.$GLOBALS['student_data'][$i]['luck'].'" class="status_value"></div>
							</div>
							<!--status range-->
							<div class="status_range_container">
								<div class="status_range">'.$GLOBALS['student_data'][$i]['stamina'].'</div>
								<div class="status_range">'.$GLOBALS['student_data'][$i]['skill'].'</div>
								<div class="status_range">'.$GLOBALS['student_data'][$i]['luck'].'</div>
							</div>
						</div>
					</div>
					<!--video-->
					<div class="student_video_container">
						<div class="student_video">
							<div>
								<img src="Image/no_video.png">
							</div>
						</div>
					</div>
				</div>
				<div class="lower_container">
					<!--save-->
					<div class="submit_container">
						<button class="save_button">Save</button>
					</div>
				</div>
			</div>';
		}
	}

?>