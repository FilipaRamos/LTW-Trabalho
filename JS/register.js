$("window").ready(function () {
	$("#regiterForm").submit(function (ev) {
		ev.preventDefault();
		var username = $("#regiterForm #username").val();
		var password = $("#regiterForm #password").val();
		var name = $("#regiterForm #name").val();
		var email =  $("#regiterForm #email").val();

		$.post(
		//nome do ficheiro
			'../PHP/register.php',
			{
				'username': username,
				'password': password,
				'name' : name,
				'email' : email
			},

			//argumentos
			
			function (data) {
				var resposta = data['register'];
			
				switch (resposta) {
					case 'error':
						sweetAlert("Oops...", "User or password wrong!", "error");
						break;
					case 'success':
						swal("Login successful", "", "success")
						break;
					default:
						break;
				}
			}).fail(function (error) {
				return false;
			});
	});
});