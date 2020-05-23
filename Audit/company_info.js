window.onload = function(){
	console.log('sadfasd');

	var company_btn = document.getElementById('company_btn');

	function back_to_login(){
		// Heading back to login.php
		window.location.assign('login.php');
	}

	company_btn.addEventListener('click',back_to_login);
}