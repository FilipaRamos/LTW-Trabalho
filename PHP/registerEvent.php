<?php 
	session_start();
	
	include_once('process.php');
    include_once('getSet.php');

	
	function response($value){
		$data = ['register' => $value];
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
	
    $idUser = $_SESSION["idUser"];
	if (!(registerEvent($params['idEvent'], $idUser))) {
		response("error");
	}
	else{
		 response("success");
	}
?>