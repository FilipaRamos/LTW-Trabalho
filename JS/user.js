$("window").ready(function () {
	
	
	$("#nav #createEvent").click(function() {
			$(".createEvent").css("visibility","visible")
	});	
	
	$("#nav #search-icon").click(function(ev) {
		ev.preventDefault();
		
		var text = $("#nav #search").val();
		
		$.post(
			'../PHP/search.php',
			{
				'text': text
			},
			
			function (data) {
				var resposta = data['search'];
				
				switch (resposta) {
					case 'error':
						swal("Oops...", "That event doesn't exist", "error");
						break;
					case 'success':
						swal("YAY NEW Search!!");
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
	
	$(".createEvent #cancel").click(function(){
			$(".createEvent").css("visibility","hidden")
	});
	
	$(".events-card-Admin").click(function(e){	
		var element = e.toElement || event.relatedTarget;
		window.location.href = "eventPage.php?idEvent=" + element.getAttribute("idEvent");
	});
	
	$(".events-card-Attending").click(function(e){	
		var element = e.toElement || event.relatedTarget;
		window.location.href = "eventPage.php?idEvent=" + element.getAttribute("idEvent");
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

		var nome = $("#createEventForm #name").val();
		var imagem = $("#createEventForm #image").val();
		var eventDate = $("#createEventForm #eventDate").val();
		var eventHour =  $("#createEventForm #startHour").val();
		var descricao =  $("#createEventForm #description").val();
		var local =  $("#createEventForm #local").val();
		var tipo =  $("#createEventForm").find("input[type='radio'][name='type']:checked").val();
		var partyType =  $("#createEventForm #partyType").val();
		
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
				var resposta = data['createUser'];
				
				switch (resposta) {
					case 'error':
						swal("Oops...", "User already exists!", "error");
						break;
					case 'success':
						swal("YAY NEW EVENT!!");
						$("#createEventForm").css("visibility","hiden");
						location.reload();
						break;
					default:
						break;
				}
			}).fail(function (error) {
				return false;
			});
	});	


});



