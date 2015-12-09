<?php 
	session_start();

	include_once('process.php');
	include_once('getSet.php');

	function response($value){
		$data = ['invite' => $value];
		header('Content-Type: application/json');
		echo json_encode($data);
	}
	
	$params = [ 'idEvent', 'idUser'];
	
	foreach ($params as $param) {
		if (isset($_POST[$param])) {
			$params[$param] = $_POST[$param];
			continue;
		}
	}
	
	if (!(invite($params['idUser'],$params['idEvent']))) {
		response("error");
	}
	else{
		$inviteList = getInviteList($params['idEvent']);
		
		echo '<div class="invite-list">';
			echo '<form id="inviteEventForm">';
				
				foreach($inviteList as $inv){
					echo '<div class="hiddenDividUser">' . $inv['idUser'] . '</div>';			
					echo '<label><p>' . $inv['username'] . '</p></label>';
					echo '<button id="inviteIcon"><i class="fa fa-user-plus"></i></button>';
				}
				
				echo '<button id="invite" type="submit">invite</button>';	
			echo '</form>';
		echo '</div>';
	}

	
?>