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
	
	$("#nav #search").bind('keypress',function(e){
		var code = e.keyCode || e.which;
 	if(code == 13) { 
		var text = $('#nav #search').val();
		$.post(
			'../PHP/search.php',
			{
				'text' : text
			},
			
			function (data) {
				var resposta = data['search'];
				
				switch (resposta) {
					case 'error':
						swal("Oops...", "something went wrong!", "error");
						break;
					case 'success':
						swal("Success searching...");
						break;
					default:
						break;
				}
			}).fail(function (error) {
				swal("SEARCH FAILED!!");
				return false;
			});
		}
	});
	
	$("#search-icon").click(function(ev){
		ev.preventDefault();
		var text = $('#nav #search').val();
		$.post(
			'../PHP/search.php',
			{
				'text' : text
			},
			
			function (data) {
				var resposta = data['search'];
				
				switch (resposta) {
					case 'error':
						swal("Oops...", "something went wrong!", "error");
						break;
					case 'success':
						swal("Success searching...");
						break;
					default:
						break;
				}
			}).fail(function (error) {
				swal("SEARCH FAILED!!");
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
			$(".createEvent").css("visibility","visible");
	});	
	
	$(".createEvent #cancel").click(function(){
			$(".createEvent").css("visibility","hidden");
	});
	
	$(".image-block").click(function() {
			$(".editEvent").css("visibility","visible");
	});	
	
	$(".editEvent #cancel").click(function(){
			$(".editEvent").css("visibility","hidden");
	});
	
	
	$("#addComment #add").click(function(ev){
		ev.preventDefault();
		
		var idUser = $('#addComment').attr('idUser');
		var idEvent = $('#addComment').attr('idEvent');
		var comentario = $("#addComment #comentario").val();
		var nome = $("#nav .hiddenDiv").html();
		
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
						$( ".list-comments" ).append(
												"<p>" +  nome + "</p>" +
												"<p>" +  comentario + "</p>"
													);
						$("#addComment #comentario").val("");
						break;
					default:
						break;
				}
			}).fail(function (error) {
				swal("FAILED!!");
				return false;
			});
	});
	
	
	$(".image-block #deleteEvent").click(function(ev){
		ev.preventDefault();
		
		swal({  title: "Are you sure?",   
				text: "You will not be able to recover this event!",  
		 		type: "warning",   
		 		showCancelButton: true,   confirmButtonColor: "#DD6B55",  
		  		confirmButtonText: "Yes, delete it!",  
		   		closeOnConfirm: false 
			 }, function(){ 
				 
		
		
		var idEvent = $(".hiddenDivEvent").html();
		
				$.post(
					'../PHP/deleteEvent.php',
					{
						'idEvent': idEvent
					},
					
					function (data) {
						var resposta = data['delete'];
						
						switch (resposta) {
							case 'error':
								swal("Oops...", "Something went wrong!", "error");
								break;
							case 'success':
								break;
							default:
								break;
						}
					}).fail(function (error) {
						swal("Oops...", "Something went wrong!", "error");
						return false;
					});
				
				swal("Deleted!", "Your Event has been deleted.", "success"); 
				
				window.location.href ="user.php";
			});
			
	});
	
	
	$(".invite-list #inviteIcon").click(function(ev){
		ev.preventDefault();
		
		var idEvent = $(".hiddenDivEvent").html();
		var idUser = $(".hiddenDividUser").html();
		
		$.post(
			'../PHP/invite.php',
			{
				'idEvent': idEvent,
				'idUser': idUser
			},
			
			function (data) {
				var resposta = data['invite'];
				switch (resposta) {
					case 'error':
						swal("Oops...This is embarrassing", "You're already registed!", "error");
						break;
					default:
						$(".invite-list").replaceWith(data);
						break;
				}
			}).fail(function (error) {
				swal("FAILED!!");
				return false;
			});
	});
	

	$(".image-block #inviteMail").click(function(){
		
		$(".invite-list").css("visibility","visible");	
		
	});
	
	$(".invite-list #invite").click(function(ev){
		ev.preventDefault();
		
		$(".invite-list").css("visibility","hidden");	
		
	});


});