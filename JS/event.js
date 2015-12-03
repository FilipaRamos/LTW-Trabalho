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
	
	$("#nav #logOut").click(function() {
		
			$.post(
			'../PHP/logout.php',
			{},
			
			function (data) {
				var resposta = data['logout'];
				
				switch (resposta) {
					case 'error':
						swal("Oops...", "something went wrong!", "error");
						break;
					case 'success':
						window.location.href = "log in.php";
						break;
					default:
						break;
				}
			}).fail(function (error) {
				swal("LOG OUT FAILED!!");
				return false;
			});
	});
	
	
		
	$("#nav #createEvent").click(function() {
			$(".createEvent").css("visibility","visible")
	});	
	
	$(".createEvent #cancel").click(function(){
			$(".createEvent").css("visibility","hidden")
	});
	
	$(".image-block").click(function() {
			$(".editEvent").css("visibility","visible")
	});	
	
	$(".editEvent #cancel").click(function(){
			$(".editEvent").css("visibility","hidden")
	});
	
	
	$("#addComment #add").click(function(ev){
		ev.preventDefault();
		
		var idUser = $('#addComment').attr('idUser');
		var idEvent = $('#addComment').attr('idEvent');
		var comentario = $("#addComment #comentario").val();
		
		
		$.post(
			'../PHP/comment.php',
			{
				'idUser': idUser,
				'idEvent': idEvent, 
				'comentario': comentario
			},
			
			function (data) {
				var resposta = data['comment'];
				
				switch (resposta) {
					case 'error':
						swal("Oops...", "User already exists!", "error");
						break;
					case 'success':
						swal("YAY NEW COMMENT!!");
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