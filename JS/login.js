$("window").ready(function () {
	$("#LogIn").submit(function (ev) {
		ev.preventDefault();
		var username = $("#LogIn #username").val();
		var password = $("#LogIn #password").val();

		$.post(
		//nome do ficheiro
			'../PHP/login.php',
			{
				'username': username,
				'password': password
			},

			//argumentos
			
			function (data) {
				var resposta = data['login'];
			
				switch (resposta) {
					case 'error':
						sweetAlert("Oops...", "User or password wrong!", "error");
						break;
					case 'success':
						 window.location.href = "user.php";
						break;
					default:
						break;
				}
			}).fail(function (error) {
				return false;
			});
	});
	

	
	
});