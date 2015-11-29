$("window").ready(function () {

	$( "#events-list-Admin" ).click(function(ev) {
			ev.preventDefault();
			$.post(
 			 	swal("Here's a message!")).fail(function (error) {
				return false;
	});
	});
	
	$( "#events-list-Attending" ).click(function(ev) {
			ev.preventDefault();
			$.post(
 			 	swal("Here's a message!", "error")).fail(function (error) {
				return false;
	});
	});
});