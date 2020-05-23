window.onload = function(){
	var user_image_input = document.getElementById('user_image_input');
	var switcher = document.getElementsByClassName('switcher')[0];

	function go_to_login_page(){
		window.location.assign('login.php');
	}

	function change_image_when_user_uploaded_image(){
		var reader = new FileReader();

		reader.onload = function(){
			var user_image_src = document.getElementById('user_image_src');
			user_image_src.src = reader.result;
		}
		reader.readAsDataURL(event.target.files[0]);
	}

	user_image_input.addEventListener('change',change_image_when_user_uploaded_image);
	switcher.addEventListener('click',go_to_login_page);
}