<?php 
	include_once('process.php');

	session_start();
	
	function response($value){
		$data = ['comment' => $value];
		header('Content-Type: application/json');
		echo json_encode($data);
	}
	
	$params = [ 'idUser', 'idEvent', 'comentario'];
	
	foreach ($params as $param) {
		if (isset($_POST[$param])) {
			$params[$param] = $_POST[$param];
			continue;
		}
	}
	if (!(createComment($params["idUser"], $params["idEvent"], $params["comentario"]))) {
		response("error");
	}
	else{
		 response("success");
	}

	
?>