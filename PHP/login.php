<?php 
	include_once('process.php');

	
	function response($value){
		$data = ['login' => $value];
		header('Content-Type: application/json');
		echo json_encode($data);
	}
	
	$params = [ 'username', 'password'];
	
	foreach ($params as $param) {
		if (isset($_POST[$param])) {
			$params[$param] = $_POST[$param];
			continue;
		}
	}
	if (!(checkLogIn($params['username'], $params['password']))) {
		response("error");
	}
	else{
		$_SESSION["username"] = $params['username'];
		 response("success");
	}

	
?>