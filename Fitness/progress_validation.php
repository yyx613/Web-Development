<?php
	require 'database.php';

	//Globals variable
	$GLOBALS['progress'] = array(
							array('title'=>'Jazz','stamina'=>'70%','skill'=>'50%','luck'=>'80%','time_spent'=>'35'),
							array('title'=>'Freestyle','stamina'=>'30%','skill'=>'70%','luck'=>'40%','time_spent'=>'25'),
							array('title'=>'Shoulder','stamina'=>'50%','skill'=>'80%','luck'=>'20%','time_spent'=>'14'),
						);
	
	//Function
	function dynamic_progress(){
		for($i=0; $i < sizeof($GLOBALS['progress']); $i++){
			echo '<div class="selected_course_container">
					<h1>'.$GLOBALS['progress'][$i]['title'].'</h1>
					<div class="video_container">
						<h2>Video</h2>
						<div class="video_source_container">
							<div class="video_source">
								<label title="Upload video">
									<input type="file" name="video" multiple="multiple" class="video">
									<img src="Image/video.jpg" class="video_image">
								</label>
							</div>
						</div>
					</div>
					<div class="statistic_container">
						<h2>Statistic</h2>
						<div class="statistic_details_container">
							<h3>Stamina</h3>
								<div class="progress_bar_container">
									<div class="progress_bar" style="width:'.$GLOBALS['progress'][$i]['stamina'].';"></div>
								</div>
							<h3>Skill</h3>
								<div class="progress_bar_container">
									<div class="progress_bar" style="width:'.$GLOBALS['progress'][$i]['skill'].';"></div>
								</div>
							<h3>Luck</h3>
								<div class="progress_bar_container">
									<div class="progress_bar" style="width:'.$GLOBALS['progress'][$i]['luck'].';"></div>
								</div>
						</div>
					</div>
					<div class="time_spent_container">
						<h2>Time Spent</h2>
						<div class="time_spent">
							<h1>'.$GLOBALS['progress'][$i]['time_spent'].'</h1>
							<h2>Hours</h2>
						</div>
					</div>
				 </div>';
		}
	}

	//Main
	

?>