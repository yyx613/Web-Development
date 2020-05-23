<?php
	
	$email = intval($_GET['email']);
	$stamina = intval($_GET['stamina']);
	$skill = intval($_GET['skill']);
	$luck = intval($_GET['luck']);


	$sql = "UPDATE user_statistic_info
			SET stamina='".$stamina."', skill='".$skill."', luck='".$luck."'
			WHERE email='".$email."' ";

	if($conn->query($sql) === TRUE){
		//echo "Successfully created table";
	}else{
		echo "Error creating database: ".$conn->error;
	}

?>


