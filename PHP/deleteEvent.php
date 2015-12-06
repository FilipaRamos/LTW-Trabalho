<?php 
	session_start();
	
	include_once('process.php');

	
	function response($value){
		$data = ['delete' => $value];
		header('Content-Type: application/json');
		echo json_encode($data);
	}
	
	$params = ['idEvent'];


	foreach ($params as $param) {
		if (isset($_POST[$param])) {
			$params[$param] = $_POST[$param];
			continue;
		}
	}
	
	if (!(deleteEvent($params['idEvent']))) {
		response("error");
	}
	else{
		 response("success");
	}
?>