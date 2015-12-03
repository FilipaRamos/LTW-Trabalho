<?php 
	
	session_start();
	
	function response($value){
		$data = ['logout' => $value];
		header('Content-Type: application/json');
		echo json_encode($data);
	}
	
	$params = [];
	
	foreach ($params as $param) {
		if (isset($_POST[$param])) {
			$params[$param] = $_POST[$param];
			continue;
		}
	}
	
	function logout(){
		// remove all session variables
		session_unset(); 

		// destroy the session 
		session_destroy(); 
		return true;
		
	}

	if (!(logout())) {
		response("error");
	}
	else{
		 response("success");
	}

	
?>