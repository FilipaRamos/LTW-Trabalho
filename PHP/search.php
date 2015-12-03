<?php 
	session_start();

	include_once('process.php');

	function response($value){
		$data = ['search' => $value];
		header('Content-Type: application/json');
		echo json_encode($data);
	}
	
	$params = [ 'text'];
	
	foreach ($params as $param) {
		if (isset($_POST[$param])) {
			$params[$param] = $_POST[$param];
			continue;
		}
	}
	if (!(searchEvent($params['text']))) {
		response("error");
	}
	else{
		 response("success");
	}

	
?>