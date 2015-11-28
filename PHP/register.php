<?php 
	include_once('process.php');
		
	function response($value){
		$data = ['register' => $value];
		header('Content-Type: application/json');
		echo json_encode($data);
	}
	
	$params = [ 'username', 'password', 'name', 'email'];
	
	foreach ($params as $param) {
		if (isset($_POST[$param])) {
			$params[$param] = $_POST[$param];
			continue;
		}
	}
	if (!(createUser($params['username'], $params['password'], $params['name'], $params['email']))) {
		response("error");
	}
	else{
		 response("success");
	}

	
?>