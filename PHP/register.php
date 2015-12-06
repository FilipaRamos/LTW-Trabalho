<?php 
	session_start();

	include_once('process.php');
	include_once('getSet.php');

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
		$_SESSION["username"] = $params['username'];
		$_SESSION["idUser"] = getidUSer($params['username'])[0]['idUser'];
		$_SESSION["name"] = getUserName($_SESSION["idUser"])[0]['name'];
		 response("success");
	}

	
?>