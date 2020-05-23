window.onload = function(){
	var user_name = document.getElementById('user_name');
	// Logout
	var logout_btn = document.getElementById('logout_btn');

	function back_to_login(){
		// Heading back to login.php
		window.location.assign('login.php');
	}

	logout_btn.addEventListener('click',back_to_login);

	// Show & hide add company pop up container
	var add_company_btn = document.getElementById('add_company_btn');
	var company_close_btn = document.getElementById('company_close_btn');
	var add_company_pop_up_full_container = document.getElementById('add_company_pop_up_full_container');


	function show_add_company_pop_up(){
		add_company_pop_up_full_container.style.display = 'inline';
	}

	function hide_add_company_pop_up(){
		add_company_pop_up_full_container.style.display = 'none';
	}

	add_company_btn.addEventListener('click', show_add_company_pop_up)
	company_close_btn.addEventListener('click', hide_add_company_pop_up)

	function onfocus_changing_type_time(i){
		return function(){
			add_company_form[i].type = 'time';
			appointment_form_input[i].type = 'time';
			return false;
		}
	}

	function onfocus_changing_type_date(i){
		return function(){
			add_company_form[i].type = 'date';
			appointment_form_input[i].type = 'date';
			return false;
		}
	}

	function onblur_changing_type_text(i){
		return function(){
			add_company_form[i].type = 'text';
			appointment_form_input[i].type = 'text';
			return false;
		}
	}

	for (var i = 4; i < 6; i++) {
		add_company_form[i].onfocus = onfocus_changing_type_date(i);
		add_company_form[i].onblur = onblur_changing_type_text(i);
	}

	//Inserting new company into database
	var add_company_pop_up_btn = document.getElementById('add_company_pop_up_btn');
	var status_container = document.getElementById('status_container');
	var add_company_pop_up_btn = document.getElementById('add_company_pop_up_btn');
	var status_content = document.getElementById('status_content');

	function show_and_hide_status(content){
		status_content.innerHTML = content;
		status_container.style.animation = 'show_add_company_status .5s forwards';
		setTimeout(function(){status_container.style.animation = 'hide_add_company_status .5s forwards';}, 3000);
	}

	function insert_new_company(){
		var add_company_form = document.getElementsByClassName('add_company_form');
		var input_null = false;
		//Validating null input
		for(var i = 0; i < add_company_form.length ;i++){
			//console.log(add_company_form[i].value);
			if(add_company_form[i].value == ''){
				input_null = true;
				show_and_hide_status('Fill in all input');
				break;
			}
		}
		// Inserting data
		if(input_null == false){
			var xhttp = new XMLHttpRequest();
			
			xhttp.onreadystatechange = function(){
		        if(this.readyState == 4 && this.status == 200){
		        	document.location.reload(true);
	                //document.getElementById("company_table_ajax").innerHTML = this.responseText;
	        	}
	    	};

			xhttp.open("GET", "main_staff_company_ajax.php?cn=" + 
						add_company_form[0].value + "&ca=" + 
						add_company_form[1].value + "&ct=" +
						add_company_form[2].value + "&cf=" +
						add_company_form[3].value + "&cy=" + 
						add_company_form[4].value + "&cdi="+
						add_company_form[5].value + "&ic=" +
						add_company_form[6].value + "&ice="+
						add_company_form[7].value, true);
			xhttp.send();

			show_and_hide_status('Added new company');
		}
	}

	add_company_pop_up_btn.addEventListener('click', insert_new_company)

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

	// Appointment
	var remove_appointment_btn = document.getElementsByClassName('remove_appointment_btn');
	var edit_appointment_btn = document.getElementsByClassName('edit_appointment_btn');
	var appointment_container = document.getElementsByClassName('appointment_container');
	var appointment_aid = document.getElementsByClassName('appointment_aid');
	var app_input = document.getElementsByClassName('app_input');
	var app_status = [];

	function remove_appointment(i){
		return function(){
			var xhttp = new XMLHttpRequest();

			xhttp.open("GET", "main_staff_delete_appointment_ajax.php?aid=" + appointment_aid[i].innerHTML, true);
			xhttp.send();

			// Remove 
			appointment_container[i].style.display = 'none';

			return false;
		}
	}

	for (var i = 0; i < remove_appointment_btn.length; i++) {
		remove_appointment_btn[i].onclick = remove_appointment(i);
	}

	function change_detail(i){
		if(app_status[i] == 'update'){
			for (var i = 0; i < app_input.length; i++) {
				app_input[i].disabled = false;
				app_input[i].autofocus;
			}
		}else{
			for (var i = 0; i < app_input.length; i++) {
				app_input[i].disabled = true;
			}
		}
	}

	function edit_appointment(i){
		return function(){
			if(app_status[i] == 'update'){
				edit_appointment_btn[i].src = 'appointment_done.png';
				edit_appointment_btn[i].title = 'Done';
				change_detail(i);
				app_status[i] = 'done';
			}else{
				edit_appointment_btn[i].src = 'edit_appointment.png';
				edit_appointment_btn[i].title = 'Update';
				change_detail(i);
				app_status[i] = 'update';

				var xhttp = new XMLHttpRequest();

				xhttp.open("GET", "main_staff_update_appointment_ajax.php?cn=" + app_input[0].value +
							'&d=' + app_input[1].value +
							'&t=' + app_input[2].value +
							'&r=' + app_input[3].value +
							'&aid=' + appointment_aid[i].innerHTML, true);
				xhttp.send();

				show_and_hide_status('Updated Appointment');
			}

			return false;
		}
	}

	for (var i = 0; i < edit_appointment_btn.length; i++) {
		edit_appointment_btn[i].onclick = edit_appointment(i);
		app_status.push('update');
	}



	// Appointment form
	var make_appointment_container = document.getElementById('make_appointment_container');
	var appointment_form_container = document.getElementById('appointment_form_container');
	var appointment_close_btn = document.getElementById('appointment_close_btn');

	function show_appointment_form_container(){
		appointment_form_container.style.display = 'inline';
	}

	function hide_appointment_form_container(){
		appointment_form_container.style.display = 'none';
	}

	make_appointment_container.addEventListener('click', show_appointment_form_container)
	appointment_close_btn.addEventListener('click', hide_appointment_form_container)

	// Inserting appointment into database
	var appointment_form_input = document.getElementsByClassName('appointment_form_input');
	var appointment_form_btn = document.getElementById('appointment_form_btn');

	function insert_appointment(){
		//Inserting appointment into database;
		var xhttp = new XMLHttpRequest();

		xhttp.open("GET", "main_staff_insert_appointment_ajax.php?cn=" + appointment_form_input[0].value +
					'&en=' + user_name.innerHTML +
					'&d=' + appointment_form_input[1].value +
					'&t=' + appointment_form_input[2].value +
					'&r=' + appointment_form_input[3].value, true);
		xhttp.send();

		show_and_hide_status('Submitted Appointment');
	}

	appointment_form_btn.addEventListener('click', insert_appointment)

	appointment_form_input[1].onfocus = onfocus_changing_type_date(1);
	appointment_form_input[1].onblur = onblur_changing_type_text(1);
	appointment_form_input[2].onfocus = onfocus_changing_type_time(2);
	appointment_form_input[2].onblur = onblur_changing_type_text(2);
	









	// Job Progress
	var job_progress_container = document.getElementsByClassName('job_progress_container');
	var job_name = document.getElementsByClassName('job_name');
	var job_details_container = document.getElementsByClassName('job_details_container');
	var job_details_btn = document.getElementsByClassName('job_details_btn');
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

	// Update job progress
	var update_progress_btn = document.getElementsByClassName('update_progress_btn');
	var job_progress_input = document.getElementsByClassName('job_progress_input');
	var old_job_progress_input;
	var row_idx;
	var read = [];

	function update_job_progress(i){
		return function(){
			if(read[i] == false){
				old_job_progress_input = job_progress_input[i].value;
				read[i] = true;
			}
			job_progress_input[i].value = '';
			job_progress_input[i].disabled = false;
			job_progress_input[i].focus();
			col_idx = i;
			//console.log('col_idx: ' + i);
			return false;
		}
	}

	for (var i = 0; i < update_progress_btn.length; i++){
		read[i] = false;
		update_progress_btn[i].onclick = update_job_progress(i);
	}

	var progress_bar = document.getElementsByClassName('progress_bar');
	var job_progress_audit_work_id_detection = document.getElementsByClassName('job_progress_audit_work_id_detection');

	function show_back_input(i){
		return function(){
			if(job_progress_input[i].value == ''){
				console.log('blank');
				job_progress_input[i].value = old_job_progress_input;
			}else{
				old_job_progress_input = job_progress_input[i].value; 
				job_progress_input[i].value = job_progress_input[i].value;
				// Updating job progress into database;
				var xhttp = new XMLHttpRequest();

				xhttp.open("GET", "main_staff_job_progress_update_ajax.php?temp=" + job_progress_input[i].value + '&row_idx=' + row_idx + '&col_idx=' + col_idx + '&real_row_idx=' + job_progress_audit_work_id_detection[row_idx].innerHTML, true);
				xhttp.send();
				// Update html job progress
				
				get_new_job_progress_bar();
			}
			return false;
		}
	}

	for (var i = 0; i < job_progress_input.length; i++){
		job_progress_input[i].onblur = show_back_input(i);
	}

	function get_job_progress_container_idx(i){
		return function(){
			//job_progress_audit_work_id_detection[i].innerHTML
			row_idx = i
			//console.log('row_idx: ' + i);
			return false;
		}
	}

	for (var i = 0; i < job_progress_container.length; i++) {
		job_progress_container[i].onclick = get_job_progress_container_idx(i);
	}

	var bind_status_ajax = document.getElementsByClassName('bind_status_ajax');

	function get_new_job_progress_bar(){
		for (var i = 0; i < progress_bar.length; i++) {
			var job_progress_done = 0;
			
			for (var j = (i * 18); j < ((i + 1) * 18); j++) {
				if(job_progress_input[j].value != '-'){
					job_progress_done++;
					console.log('x | row:' + i +' col: ' + j + ' | ' + job_progress_done);
				}
			}

			progress_bar[i].style.width = job_progress_done/18 * 100 + '%';
		}
	}

	get_new_job_progress_bar();





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
}