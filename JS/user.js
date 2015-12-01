$("window").ready(function () {
	
	
	$("#nav #createEvent").click(function() {
			$(".createEvent").css("visibility","visible")
	});	
	
	$(".createEvent #cancel").click(function(){
			$(".createEvent").css("visibility","hidden")
	});
	
	$("#events-list-Admin #events-card-Admin").click(function(){
			swal("yay!!");
	});
	
	$("#events-list-Attending #events-card-Attending").click(function(){
			swal("NO!!");
	});
	
	
/*
	FUNCAO DA NET!!!
*/	
	var getUrlParameter = function getUrlParameter(sParam) {
    var sPageURL = decodeURIComponent(window.location.search.substring(1)),
        sURLVariables = sPageURL.split('&'),
        sParameterName,
        i;

    for (i = 0; i < sURLVariables.length; i++) {
        sParameterName = sURLVariables[i].split('=');

        if (sParameterName[0] === sParam) {
            return sParameterName[1] === undefined ? true : sParameterName[1];
        }
    }
	
};	

	$("#createEventForm").submit(function(ev) {
		ev.preventDefault();
		var idUser = getUrlParameter('idUser');

		swal(idUser);
		var nome = $("#createEventForm #name").val();
		var imagem = $("#createEventForm #image").val();
		var eventDate = $("#createEventForm #eventDate").val();
		var eventHour =  $("#createEventForm #startHour").val();
		var descricao =  $("#createEventForm #description").val();
		var local =  $("#createEventForm #local").val();
		var tipo =  $("#createEventForm").find("input[type='radio'][name='type']:checked").val();
		
		$.post(
			'../PHP/userPage.php',
			{
				'idUser': idUser,
				'name': nome,
				'image': imagem,
				'eventDate' : eventDate,
				'startHour' : eventHour,
				'description' : descricao,
				'local' : local,
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
						$("#createEventForm").css("visibility","hiden");
						break;
					default:
						break;
				}
			}).fail(function (error) {
				return false;
			});
	});	
	
	$("#editProfileForm").submit(function(ev) {
		ev.preventDefault();
		var idUser = getUrlParameter('idUser');

		swal(idUser);
		var nome = $("#editProfileForm #name").val();
		var password = $("#editProfileForm #password").val();
		var newpassword = $("#editProfileForm #newpassword").val();
		
		$.post(
			'../PHP/userPage.php',
			{
				'idUser': idUser,
				'name': nome,
				'password': newpassword,
				
				
			},
			
			function (data) {
				var resposta = data['userpage'];
				
				switch (resposta) {
					case 'error':
						swal("Oops...", "User already exists!", "error");
						break;
					case 'success':
						swal("YAY NEW EVENT!!");
						$("#createEventForm").css("visibility","hiden");
						break;
					default:
						break;
				}
			}).fail(function (error) {
				return false;
			});
	});	


});



