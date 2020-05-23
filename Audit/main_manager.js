window.onload = function(){
	// Logout
	var logout_btn = document.getElementById('logout_btn');

	function back_to_login(){
		// Heading back to login.php
		window.location.assign('login.php');
	}

	logout_btn.addEventListener('click',back_to_login);

	// Show incharge person container
	var add_person_btn = document.getElementsByClassName('add_person_btn');
	var company_close_btn = document.getElementById('company_close_btn');
	var person_to_assign_container = document.getElementById('person_to_assign_container');
	var cid = 0;

	function hide_add_company_pop_up(){
		person_to_assign_container.style.display = 'none';
	}

	company_close_btn.addEventListener('click',hide_add_company_pop_up);

	function show_incharge_person_container(i){
		return function(){
			console.log('C: ' + company_id_detection[i].innerHTML);
			cid = company_id_detection[i].innerHTML;
			add_person_btn_idx = i;
			if(add_person_btn[i].innerHTML == ''){// is btn
				//console.log('is btn');
				person_to_assign_container.style.display = 'inline';
			}else{
				//console.log('is not btn');
				add_person_btn[i].style.cursor = 'default';
				return false;
			}
			return false;
		}
	}

	for(var i = 0; i < add_person_btn.length; i++){
		add_person_btn[i].onclick = show_incharge_person_container(i);
	}

	function set_default(){
		for(var i = 0; i < add_person_btn.length; i++){
			if(add_person_btn[i].innerHTML != ''){// is btn
				//console.log('is not btn');
				add_person_btn[i].style.cursor = 'default';
			}
		}
	}

	set_default();

	// Assign incharge person
	var person_list_container = document.getElementsByClassName('person_list_container');
	var person_full_name = document.getElementsByClassName('person_full_name');
	var status_container = document.getElementById('status_container');
	var status_content = document.getElementById('status_content');
	var person_email = document.getElementsByClassName('person_email');
	var company_id_detection = document.getElementsByClassName('company_id_detection');

	function show_and_hide_status(content){
		//Status
		status_content.innerHTML = content;
		status_container.style.animation = 'show_add_company_status .5s forwards';
		setTimeout(function(){status_container.style.animation = 'hide_add_company_status .5s forwards';}, 5000);
	}

	function assign_incharge_person(i){
		return function(){
			// Show & hide status
			//Updating incharge person into database
			var xhttp = new XMLHttpRequest();
			
			xhttp.open("GET", "main_manager_company_ajax.php?name=" + person_full_name[i].innerHTML + "&company_index=" + cid, true);
			xhttp.send();

			//Changing incharge person image
			add_person_btn[add_person_btn_idx].src = "manager_added_person.png";
			add_person_btn[add_person_btn_idx].title = "Assigned to " + person_full_name[i].innerHTML;
			//Disable click
			add_person_btn[add_person_btn_idx].style.cursor = 'default';
			add_person_btn[add_person_btn_idx].onclick = function(){return false};

			show_and_hide_status('Assigned to ' + person_full_name[i].innerHTML);

			return false;
		}
	}

	for(var i = 0; i < person_list_container.length; i++){
		person_list_container[i].onclick = assign_incharge_person(i);
	}

	// switch function color
	var nagivation_bar_link = document.getElementsByClassName('nagivation_bar_link');
	var old_selected_nagivation_bar_link_idx = 0; 
	var function_full_container = document.getElementsByClassName('function_full_container');

	function switch_nagivation_bar_link_color(i){
		return function(){
			// old selected nagivation_bar_link
			nagivation_bar_link[old_selected_nagivation_bar_link_idx].style.backgroundColor = 'lightblue';
			// new selected nagivation_bar_link
			nagivation_bar_link[i].style.backgroundColor = 'white';
			// hide function_full_container
			function_full_container[old_selected_nagivation_bar_link_idx].style.display = 'none';
			// show function_full_container
			function_full_container[i].style.display = 'inline';
			// change new index
			old_selected_nagivation_bar_link_idx = i;

			return false;
		}
	}

	for(var i = 0; i < nagivation_bar_link.length; i++){
		nagivation_bar_link[i].onclick = switch_nagivation_bar_link_color(i);
	}

	// Meet appointment
	var manager_appointment_submit_btn = document.getElementsByClassName('manager_appointment_submit_btn');
	var appointment_description = document.getElementsByClassName('appointment_description');

	function update_appointment(i){
		return function(){
			if(appointment_description[i].value != ''){
				console.log(i);
				console.log(appointment_description[i].value);
				
				//Updating description into database
				var xhttp = new XMLHttpRequest();

				xhttp.open("GET", "main_manager_submit_appointment_ajax.php?d=" + appointment_description[i].value + '&idx=' + i, true);
				xhttp.send();

				show_and_hide_status('Submitted Appointment');
			}
			return false;
		}
	}

	for (var i = 0; i < manager_appointment_submit_btn.length; i++) {
		manager_appointment_submit_btn[i].onclick = update_appointment(i);
	}

	//Job Progress
	// Job Progress
	var job_progress_container = document.getElementsByClassName('job_progress_container');
	var job_name = document.getElementsByClassName('job_name');
	var job_details_container = document.getElementsByClassName('job_details_container');
	var job_details_btn = document.getElementsByClassName('job_details_btn');
	var job_progress_input = document.getElementsByClassName('job_progress_input');
	var job_progress_details = [];
	var job_progress_read = false;

	function show_job_progress_details(i){
		return function(){
			if(job_progress_details[i] == 'hide'){
				job_progress_container[i].style.animation = 'show_job_progress_details_container .2s forwards';
				job_details_container[i].style.animation = 'show_job_progress_details .2s forwards';
				job_details_btn[i].src = 'hide_job_details_btn.png';
				job_details_btn[i].title = 'Hide details';
				job_progress_details[i] = 'show';
			}else{
				job_progress_container[i].style.animation = 'hide_job_progress_details_container .2s forwards';
				job_details_container[i].style.animation = 'hide_job_progress_details .2s forwards';
				job_details_btn[i].src = 'show_job_details_btn.png';
				job_details_btn[i].title = 'Show details';
				job_progress_details[i] = 'hide';
			}
			return false;
		}
	}

	for (var i = 0; i < job_details_btn.length; i++) {
		if(job_progress_read == false){
			job_progress_details.push('hide');
		}
		job_details_btn[i].onclick = show_job_progress_details(i);
	}
	job_progress_read = true;


	var progress_bar = document.getElementsByClassName('progress_bar');

	function get_new_job_progress_bar(){
		for (var i = 0; i < progress_bar.length; i++) {
			var job_progress_done = 0;
			//console.log('i: ' + i);
			for (var j = (i * 18); j < ((i + 1) * 18); j++) {
				if(job_progress_input[j].value != '-'){
					job_progress_done++;
					//console.log('j: ' + j + ' | ' + job_progress_input[j].value);
				}
			}
			progress_bar[i].style.width = job_progress_done/18 * 100 + '%';
		}
	}

	get_new_job_progress_bar();

	var job_progress_audit_work_id_detection = document.getElementsByClassName('job_progress_audit_work_id_detection');
	var manager_jp_bind_input = document.getElementsByClassName('manager_jp_bind_input');
	var update_progress_btn = document.getElementsByClassName('update_progress_btn');
	var temp_txt;

	function focus_jp_bind_status(i){
		return function(){
			temp_txt = manager_jp_bind_input[i].value;
			manager_jp_bind_input[i].value = '';
			manager_jp_bind_input[i].disabled = false;
			manager_jp_bind_input[i].focus();

			return false;
		}
	}

	function blur_jp_bind_status(i){
		return function(){
			if(manager_jp_bind_input[i].value == '' || manager_jp_bind_input[i].value == '-'){
				manager_jp_bind_input[i].value = temp_txt
			}else{
				//Updating bind_status into database
				var xhttp = new XMLHttpRequest();

				xhttp.open("GET", "main_manager_update_jp_ajax.php?id=" + job_progress_audit_work_id_detection[i].innerHTML + '&value=' + manager_jp_bind_input[i].value, true);
				xhttp.send();
			}

			return false;
		}
	}

	for (var i = 0; i < update_progress_btn.length; i++) {
		update_progress_btn[i].onclick = focus_jp_bind_status(i);
		manager_jp_bind_input[i].onblur = blur_jp_bind_status(i);
	}





	// 	Report
	var report_content_full_container = document.getElementsByClassName('report_content_full_container');
	var report_nagivation_link = document.getElementsByClassName('report_nagivation_link');
	var default_report_nav_idx = 0;

	report_content_full_container[default_report_nav_idx].style.display = 'inline';
	report_nagivation_link[default_report_nav_idx].style.backgroundColor = 'white';

	function switch_report_nav(i){
		return function(){
			if(default_report_nav_idx != i){
				// New
				report_content_full_container[i].style.display = 'inline';
				report_nagivation_link[i].style.backgroundColor = 'white';
				// Default
				report_content_full_container[default_report_nav_idx].style.display = 'none';
				report_nagivation_link[default_report_nav_idx].style.backgroundColor = '#f2f2f2';

				default_report_nav_idx = i;
			}
			return false;
		}
	}

	for (var i = 0; i < report_nagivation_link.length; i++) {
		report_nagivation_link[i].onclick = switch_report_nav(i);
	}

	// Filter company
	var total_company_year_filter = document.getElementById('total_company_year_filter');
	var total_company_month_filter = document.getElementById('total_company_month_filter');
	var total_company_day_filter = document.getElementById('total_company_day_filter');
	var report_company_list = document.getElementsByClassName('report_company_list');
	var company_report_div = document.getElementsByClassName('company_report_div');

	function filter_company(){
		var input_year = total_company_year_filter.value;
		var input_month= total_company_month_filter.value;
		var input_day = total_company_day_filter.value;

		var year_null = true;
		var month_null = true;
		var day_null = true;

		// Checking input for all filter
		if(input_year != ''){
			year_null = false;
			//console.log('filter year not null');
		}

		if(input_month != ''){
			month_null = false;
			//console.log('filter month not null');
		}

		if(input_day != ''){
			day_null = false;
			//console.log('filter day not null');
		}

		var day_28 = true;

		// feb 29 days
		if(year_null == false){
			if(input_year % 4 != 0){
				day_28 = false;
			}
		}

		// Validate month
		if(month_null == false){
			if(input_month < 1 || input_month > 12){
				show_and_hide_status('Incorrect Month Range');
				//console.log('month:' + input_month);
				return;
			}
		}

		// Validate day
		if(day_null == false){
			if(month_null == true){ // Only day
				console.log('Only day');
				if(input_day < 1 || input_day > 31){
					show_and_hide_status('Incorrect Day Range');
					//console.log('day:' + input_day);
					return;
				}
			}else{// Month and day
				console.log('Month and day');
				if(input_month == '1' || input_month == '3' || input_month == '5' ||
					input_month == '7' || input_month == '8' || input_month == '10' ||
					input_month == '12'){
					if(input_day < 1 || input_day > 31){
						show_and_hide_status('Incorrect Day Range');
						//console.log('day:' + input_day);
						return;
					}
				}else if(input_month == '4' || input_month == '6' || input_month == '9' || input_month == '11'){
					if(input_day < 1 || input_day > 30){
						show_and_hide_status('Incorrect Day Range');
						//console.log('day:' + input_day);
						return;
					}
				}else if(input_month == '2' && day_28 == true){
					if(input_day < 1 || input_day > 28){
						show_and_hide_status('Incorrect Day Range');
						//console.log('day:' + input_day);
						return;
					}
				}else if(input_month == '2' && day_28 == false){
					if(input_day < 1 || input_day > 29){
						show_and_hide_status('Incorrect Day Range');
						//console.log('day:' + input_day);
						return;
					}
				}
			}
		}


		// Month
		if(input_month.length == 1){
			input_month = '0' + input_month;
		}
		// Day
		if(input_day.length == 1){
			input_day = '0' + input_day;
		}


		//console.log('filter year:' + input_year);
		//console.log('filter month:' + input_month);
		//console.log('filter day:' + input_day);

		for (var i = 0; i < report_company_list.length; i++) {
			var year = report_company_list[i].innerHTML.substring(0, 4);
			var month = report_company_list[i].innerHTML.substring(5, 7);
			var day = report_company_list[i].innerHTML.substring(8, 10);

			if(year_null == true && month_null == true && day_null == true){
				company_report_div[i].style.display = '';
			}else if(year_null == false && month_null == false && day_null == false){
				//console.log('Entered year month day');
				if(input_year == year && input_month == month && input_day == day){
					company_report_div[i].style.display = '';
				}else{
					company_report_div[i].style.display = 'none';
				}
			}else if(month_null == false && day_null == false){
				//console.log('Entered month day');
				if(input_month == month && input_day == day){
					company_report_div[i].style.display = '';
				}else{
					company_report_div[i].style.display = 'none';
				}
			}else if(year_null == false && day_null == false){
				//console.log('Entered year day');
				if(input_year == year && input_day == day){
					company_report_div[i].style.display = '';
				}else{
					company_report_div[i].style.display = 'none';
				}
			}else if(year_null == false && month_null == false){
				//console.log('Entered year month');
				if(input_year == year && input_month == month){
					company_report_div[i].style.display = '';
				}else{
					company_report_div[i].style.display = 'none';
				}
			}else if(input_year == year || input_month == month || input_day == day){
				//console.log('Entered any');
				company_report_div[i].style.display = '';
			}else{
				company_report_div[i].style.display = 'none';
			}
		}
	}

	total_company_year_filter.addEventListener('keyup', filter_company);
	total_company_month_filter.addEventListener('keyup', filter_company);
	total_company_day_filter.addEventListener('keyup', filter_company);

	// Filter staff
	var report_staff_filter = document.getElementById('report_staff_filter');
	var report_staff_list = document.getElementsByClassName('report_staff_list');
	var staff_report_div = document.getElementsByClassName('staff_report_div');

	function filter_staff(){
		var input = report_staff_filter.value;
		var filter = input.toUpperCase();
		//console.log(filter);
		for (var i = 0; i < report_staff_list.length; i++){
			var match = report_staff_list[i].innerHTML;
			var match_filter = match.toUpperCase();

			if(match_filter.includes(filter)){
				staff_report_div[i].style.display = '';
				//console.log(match_filter);
			}else{
				staff_report_div[i].style.display = 'none';
				//console.log(match_filter);
			}
		}
	}

	report_staff_filter.addEventListener('keyup', filter_staff);

	// Printer company
	var total_company_printer = document.getElementById('total_company_printer');

	function print_total_company(){
		var divToPrint = document.getElementById("total_company_table");
		newWin = window.open("");
		newWin.document.write(divToPrint.outerHTML);
		newWin.print();
		
	}

	total_company_printer.addEventListener('click', print_total_company);

	// Printer staff
	var staff_job_printer = document.getElementById('staff_job_printer');

	function print_staff(){
		var divToPrint = document.getElementById("staff_table");
		newWin = window.open("");
		newWin.document.write(divToPrint.outerHTML);
		newWin.print();
		newWin.close();
	}

	staff_job_printer.addEventListener('click', print_staff);


	var person_full_name = document.getElementsByClassName('person_full_name');
	var person_list_container = document.getElementsByClassName('person_list_container');
	var person_to_assign_filter = document.getElementById('person_to_assign_filter');

	function filter_staff_company(){
		var input = person_to_assign_filter.value;
		var filter = input.toUpperCase();
		//console.log(filter);
		for (var i = 0; i < person_full_name.length; i++){
			var match = person_full_name[i].innerHTML;
			var match_filter = match.toUpperCase();

			if(match_filter.includes(filter)){
				person_list_container[i].style.display = '';
				//console.log(match_filter);
			}else{
				person_list_container[i].style.display = 'none';
				//console.log(match_filter);
			}
		}
	}

	person_to_assign_filter.addEventListener('keyup', filter_staff_company);
}