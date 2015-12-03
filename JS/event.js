$("window").ready(function () {

	$("#createEventForm").submit(function(ev) {
		ev.preventDefault();

		var nome = $("#createEventForm #name").val();
		var imagem = $("#createEventForm #image").val();
		var eventDate = $("#createEventForm #eventDate").val();
		var eventHour =  $("#createEventForm #startHour").val();
		var descricao =  $("#createEventForm #description").val();
		var local =  $("#createEventForm #local").val();
		var tipo =  $("#createEventForm").find("input[type='radio'][name='type']:checked").val();
		var partyType =  $("#createEventForm #partyType").val();
		
		$.post(
			'../PHP/uploadfile.php',
			{
				'idUser': idUser,
				'name': nome,
				'image': imagem,
				'eventDate' : eventDate,
				'startHour' : eventHour,
				'description' : descricao,
				'local' : local,
				'partyType' : partyType,
				'type' : tipo
			},
			
			function (data) {
				var resposta = data['userpage'];
				
				switch (resposta) {
					case 'error':
						swal("Oops...", "User already exists!", "error");
						break;
					case 'success':
						swal("YAY NEW EVENT!!");
						$(".createEvent").css("visibility","hidden");
						break;
					default:
						break;
				}
			}).fail(function (error) {
				swal("FAILED!!");
				return false;
			});
	});	
});