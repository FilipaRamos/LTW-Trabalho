$("window").ready(function () {
	$("#registerForm").submit(function (ev) {
		ev.preventDefault();
		var username = $("#registerForm #username").val();
		var password = $("#registerForm #password").val();
		var nome = $("#registerForm #name").val();
		var email =  $("#registerForm #email").val();
		
		
		$.post(
			'../PHP/register.php',
			{
				'username': username,
				'password': password,
				'name' : nome,
				'email' : email
			},
			function (data) {
				var resposta = data['register'];
				
				switch (resposta) {
					case 'error':
						sweetAlert("Oops...", "User already exists!", "error");
						break;
					case 'success':
						window.location.replace('user.php');
						break;
					default:
						break;
				}
			}).fail(function (error) {
				return false;
			});
	});	
});