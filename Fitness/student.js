window.onload = function(){
	var logout_button = document.getElementById('logout_button');
	var to_do_list_button = document.getElementById('to_do_list_button');
	var show_reminder_button = document.getElementById('show_reminder_button');
	var hide_reminder_button = document.getElementById('hide_reminder_button');
	var word_option = document.getElementsByClassName('word_option');
	var functional_container = document.getElementsByClassName('functional_container');
	var functional_container = document.getElementsByClassName('functional_container');

	var sub_course_container = document.getElementsByClassName('sub_course_container');
	var sub_course_types_container = document.getElementsByClassName('sub_course_types_container');

	function go_to_login_page(){
		window.location.assign('login.php');
	}

	var to_do_list_current_status = 'show';
	function hide_or_show_to_do_list(){
		var to_do_list_container = document.getElementById('to_do_list_container');
		if(to_do_list_current_status == 'show'){
			to_do_list_container.style.display = 'none';
			to_do_list_current_status = 'hide';
		}else{
			to_do_list_container.style.display = 'inline';
			to_do_list_current_status = 'show';
		}
	}

	function show_reminder(){
		var reminder_container_background = document.getElementById('reminder_container_background');
		
		reminder_container_background.style.animation = 'reminder_in .5s forwards';
	}

	function hide_reminder(){
		var reminder_container_background = document.getElementById('reminder_container_background');
		
		reminder_container_background.style.animation = 'reminder_out .5s forwards';
	}

	//user container fade in
	var user_container = document.getElementById('user_container');
	user_container.style.animation = 'user_container_in .5s forwards';
	//set default word option
	var default_word_option = document.getElementsByClassName('word_option')[0];
	var default_container = document.getElementsByClassName('functional_container')[0];

	default_word_option.style.backgroundColor = '#E42F2F';
	default_word_option.style.color = 'white';
	default_container.style.animation = 'container_in .5s forwards';

	function swap_container(){
		//change back to default
		default_word_option.style.backgroundColor = '#f2f2f2';
		default_word_option.style.color = 'black';
		default_container.style.animation = 'container_out .5s forwards';

		new_word_option = document.getElementsByClassName('word_option')[this.value];
		new_container = document.getElementsByClassName('functional_container')[this.value];
		
		//change to selected
		new_word_option.style.backgroundColor = '#E42F2F';
		new_word_option.style.color = 'white';
		new_container.style.animation = 'container_in 1s forwards';

		default_word_option = new_word_option;
		default_container = new_container;
	}

	function hide_others_course_types_and_show_own(show){
		for(var i = 0; i < sub_course_types_container.length; i++){
			if(i == show){
				sub_course_types_container[i].style.animation = 'sub_course_types_container_in .5s forwards';
			}else{
				sub_course_types_container[i].style.animation = 'sub_course_types_container_out .5s forwards';
			}
		}
	}

	function show_course_types(){
		switch(this.id){
			case 'yoga':
				hide_others_course_types_and_show_own(0);
				break;
			case 'gym':
				hide_others_course_types_and_show_own(1);
				break;
			case 'swimming':
				hide_others_course_types_and_show_own(2);
				break;
			case 'dance':
				hide_others_course_types_and_show_own(3);
				break;
		}
	}

	for(var i = 0; i < word_option.length; i++){
		word_option[i].addEventListener('click',swap_container);
	}
	for (var i = 0; i < sub_course_container.length; i++) {
		sub_course_container[i].addEventListener('click',show_course_types);
	}
	logout_button.addEventListener('click',go_to_login_page);
	to_do_list_button.addEventListener('click',hide_or_show_to_do_list);
	show_reminder_button.addEventListener('click',show_reminder);
	hide_reminder_button.addEventListener('click',hide_reminder);

	//Progress
	var video = document.getElementsByClassName("video");

	function validate_video_type(){
		
		
	}

	for (var i = 0; i < video.length; i++) {
		video[i].addEventListener('change',validate_video_type);
	}

}