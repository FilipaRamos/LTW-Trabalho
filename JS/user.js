$("window").ready(function () {


	$("#nav #createEvent").click(function () {
		$(".createEvent").css("visibility", "visible")
	});

	$("#nav #search-icon").click(function (ev) {
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

	$("#nav #logOut").click(function () {

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

	$(".createEvent #cancel").click(function () {
		$(".createEvent").css("visibility", "hidden")
	});


	$(".events-card-interesting #registerEvent").click(function (e) {

		var idEvent = $(".hiddenDiv").html();
		$.post(
			'../PHP/registerEvent.php',
			{
				'idEvent': idEvent
			},

			function (data) {
				var resposta = data['register'];

				switch (resposta) {
					case 'error':
						swal("Oops...", "Already registed!", "error");
						break;
					case 'success':
						swal("Registed");
						break;
					default:
						break;
				}
			}).fail(function (error) {
				swal("FAILED!!");
				return false;
			});
	});


	$("#background-block").on("click", "#name", function (e) {
		e.preventDefault();
		var idEvent = $(".hiddenDiv").html();

		window.location.href = "eventPage.php?idEvent=" + idEvent;
	});

	$("#background-block #interestingEvents").click(function () {

		$.post(
			'../PHP/decide.php',
			{
				'option': "interesting"
			},

			function (data) {
				$("#event-block").replaceWith(data);
			}).fail(function (error) {
				swal("FAILED!!");
				return false;
			});

	});

	$("#background-block #AdminEvents").click(function () {

		$.post(
			'../PHP/decide.php',
			{
				'option': "admin"
			},

			function (data) {
				$("#event-block").replaceWith(data);
			}).fail(function (error) {
				swal("FAILED!!");
				return false;
			});

	});

	$("#background-block #AttendingEvents").click(function () {

		$.post(
			'../PHP/decide.php',
			{
				'option': "attending"
			},

			function (data) {
				$("#event-block").replaceWith(data);
			}).fail(function (error) {
				swal("FAILED!!");
				return false;
			});

	});
	
	$("#background-block #InvitedEvents").click(function () {

		$.post(
			'../PHP/decide.php',
			{
				'option': "invited"
			},

			function (data) {
				$("#event-block").replaceWith(data);
			}).fail(function (error) {
				swal("FAILED!!");
				return false;
			});

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

	$("#createEventForm").submit(function (ev) {
		ev.preventDefault();
				
		 formData = new FormData(this);
        
	$.ajax({
            type: "POST",
            url: "../PHP/userPage.php",
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
				console.log(response);
                var data=JSON.parse(response);
                if(data["fileuload"]!="success"){
                  console.log(data["fileupload"]); 
           
                }
            },
            error: function(errResponse) {
                console.log(errResponse);
            },
            complete: function() 
            {
                location.reload();
            }
        });
		
	});

	$("#editProfileForm").submit(function (ev) {
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
						$("#createEventForm").css("visibility", "hiden");
						location.reload();
						break;
					default:
						break;
				}
			}).fail(function (error) {
				return false;
			});
	});

	$("#nav #search").bind('keypress', function (e) {
		var code = e.keyCode || e.which;
		if (code == 13) {
			var text = $('#nav #search').val();
			$.post(
				'../PHP/search.php',
				{
					'text': text
				},

			function (data) {
				console.log(data);
				$("#event-block").replaceWith(data);
			}).fail(function (error) {
				swal("FAILED!!");
				return false;
			});
		}
	});

	$("#search-icon").click(function (ev) {
		ev.preventDefault();
		var text = $('#nav #search').val();
		$.post(
			'../PHP/search.php',
			{
				'text': text
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
				swal("LOG OUT FAILED!!");
				return false;
			});
	});


});



