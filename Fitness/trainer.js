window.onload = function(){
	//Nav_button
	var nav_button = document.getElementsByClassName('nav_button');

	//default nav_button (course)
	var default_nav_button = nav_button[0];
	default_nav_button.style.borderBottom = 'solid 2px red';

	function switch_content(){
		var course_container =  document.getElementById('course_container');
		var student_container =  document.getElementById('student_container');
		var setting_container =  document.getElementById('setting_container');

		if(this.innerHTML == 'Course'){
			//console.log('Course found');
			//Content
			course_container.style.visibility = 'visible';
			student_container.style.visibility = 'hidden';
			setting_container.style.visibility = 'hidden';
		}else if(this.innerHTML == 'Student'){
			//console.log('Student found');
			//Content
			course_container.style.visibility = 'hidden';
			student_container.style.visibility = 'visible';
			setting_container.style.visibility = 'hidden';
		}else{
			//console.log('Setting found');
			//Content
			course_container.style.visibility = 'hidden';
			student_container.style.visibility = 'hidden';
			setting_container.style.visibility = 'visible';
		}
		
		default_nav_button.style.borderBottom = 'solid 2px white';
		this.style.borderBottom = 'solid 2px red';
		default_nav_button = this;
	}

	for(var i = 0; i < nav_button.length; i++){
		nav_button[i].addEventListener('click',switch_content);
	}

	//Remove course type
	var course_type = document.getElementsByClassName('course_type');

	function remove_particular_course_type(){
		console.log(this.innerHTML);
		this.style.display = 'none';
	}

	for(var i = 0; i < course_type.length; i++){
		course_type[i].addEventListener('click',remove_particular_course_type);
	}

	//Change range value based on input
	var status_value = document.getElementsByClassName('status_value');
	var status_range = document.getElementsByClassName('status_range');

	function change_value_for_range_input(i){
		return function(){
			status_range[i].innerText = this.value;
			return false;
		}
	}

	for(var i = 0; i < status_value.length; i++){
		status_value[i].oninput = change_value_for_range_input(i);
	}

	//Save data and show notification
	var save_button = document.getElementsByClassName('save_button');
	var status_range = document.getElementsByClassName('status_range');
	var track_email = document.getElementsByClassName('track_email');

	function show_notification(){
		//show notification
		var notification = document.getElementById('notification_container');

		notification.style.animation = 'notification_slide_in .5s forwards';
		setTimeout(function(){notification.style.animation = 'notification_slide_out .5s forwards';}, 5000);
	}

	function save_data(i){
		return function(){
			console.log(track_email[i].innerText);
			console.log(status_range[i*3].innerText);
			console.log(status_range[i*3 + 1].innerText);
			console.log(status_range[i*3 + 2].innerText);

			//Save data to database
			var xhttp = new XMLHttpRequest();
			console.log("trainer_test.php?email="+ track_email[i].innerText +"&stamina="+ status_range[i*3].innerText +"&skill="+ status_range[i*3 + 1].innerText +"&luck="+ status_range[i*3 + 2].innerText);

			xhttp.onreadystatechange = function() {
	            if (this.readyState == 4 && this.status == 200) {
	                document.getElementById("txtHint").innerHTML = this.responseText;
	            }
	        };
	        xmlhttp.open("GET","trainer_test.php?email="+ track_email[i].innerText +"&stamina="+ status_range[i*3].innerText +"&skill="+ status_range[i*3 + 1].innerText +"&luck="+ status_range[i*3 + 2].innerText ,true);
	        xmlhttp.send();


			
			return false;
		}
	}

	for (var i = 0; i < save_button.length; i++) {
		save_button[i].addEventListener('click',show_notification);
		save_button[i].onclick = save_data(i);
	}

	//Setting button
	var setting_content = document.getElementsByClassName('setting_content');

	function setting_function(){
		if(this.innerText == 'a'){
			alert('div a clicked');
		}else if(this.innerText == 'b'){
			alert('div b clicked');
		}else{
			window.location.assign('login.php');
		}
	}

	for (var i = 0; i < setting_content.length; i++) {
		setting_content[i].addEventListener('click', setting_function);
	}
}