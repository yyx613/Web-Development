window.onload = function(){
	var switcher = document.getElementsByClassName('switcher')[0];


	function go_to_register_page(){
		window.location.assign('register.php');
	}

	switcher.addEventListener('click',go_to_register_page);
}