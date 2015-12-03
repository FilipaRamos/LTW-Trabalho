<?php 
	session_start();
	
	include_once('process.php');

	
	function response($value){
		$data = ['userpage' => $value];
		header('Content-Type: application/json');
		echo json_encode($data);
	}
	
	$params = [ 'idUser' ,'name', 'image', 'eventDate', 'startHour', 'description' , 'local', 'partyType', 'type'];
	
	
	
	foreach ($params as $param) {
		if (isset($_POST[$param])) {
			$params[$param] = $_POST[$param];
			continue;
		}
	}

	if (!(createEvent($params['idUser'], $params['name'], $params['image'], $params['eventDate'], $params['startHour'], $params['description'], $params['local'],$params['partyType'], $params['type']))) {
		response("error");
	}
	else{
		 response("success");
	}

	
?>