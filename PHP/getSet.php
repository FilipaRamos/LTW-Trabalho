<?php

include_once('../sqlite/connection.php');

function getUserName($idUser){
	$file=new PDO('sqlite:../sqlite/database.db');
	
	$stmt = $file->prepare('SELECT name FROM User WHERE idUser = :idUser;');
	$stmt->bindParam(':idUser', $idUser, PDO::PARAM_INT);
	$stmt->execute();
	$result = $stmt->fetchAll();
	
	return $result;
}

function getUserEmail($idUser){
	$file=new PDO('sqlite:../sqlite/database.db');
	
	$stmt = $file->prepare('SELECT email FROM User WHERE idUser = :idUser;');
	$stmt->bindParam(':idUser', $idUser, PDO::PARAM_INT);
	$stmt->execute();
	$result = $stmt->fetchAll();
	
	return $result;
}

function getidUSer($username){
	$file=new PDO('sqlite:../sqlite/database.db');
	
	$stmt = $file->prepare('SELECT idUser FROM User WHERE username = :username;');
	$stmt->bindParam(':username', $username, PDO::PARAM_STR);
	$stmt->execute();
	$result = $stmt->fetchAll();
	
	return $result;
}


function getEvent($idEvent){
	$file=new PDO('sqlite:../sqlite/database.db');
	
	$stmt = $file->prepare('SELECT * FROM Event WHERE idEvent = :idEvent;');
	$stmt->bindParam(':idEvent', $idEvent, PDO::PARAM_INT);
	$stmt->execute();
	$result = $stmt->fetchAll();
	
	return $result;
	
}


function getEventHost($idEvent){
	$file=new PDO('sqlite:../sqlite/database.db');
	
	$stmt = $file->prepare('SELECT idUser FROM Event WHERE idEvent = :idEvent;');
	$stmt->bindParam(':idEvent', $idEvent, PDO::PARAM_INT);
	$stmt->execute();
	$result = $stmt->fetchAll();
	
	return $result;
	
}

function getAttendState($idEvent, $idUser){
	$file=new PDO('sqlite:../sqlite/database.db');
	
	$stmt = $file->prepare('SELECT attend FROM AttendEvent WHERE idEvent = :idEvent AND idUser = :idUser;');
	$stmt->bindParam(':idEvent', $idEvent, PDO::PARAM_INT);
	$stmt->bindParam(':idUser', $idUser, PDO::PARAM_INT);
	$stmt->execute();
	$result = $stmt->fetchAll();
	
	return $result;

}

function getAllGoingEvent($idEvent){
	$file=new PDO('sqlite:../sqlite/database.db');
	
	$stmt = $file->prepare('SELECT idUser FROM AttendEvent WHERE idEvent = :idEvent AND attend = 1');
	$stmt->bindParam(':idEvent', $idEvent, PDO::PARAM_INT);
	$stmt->execute();
	$result = $stmt->fetchAll();
	
	$resultado = array();
	foreach($result as $r){
		$res = getUserName($r['idUser']);
		array_push($resultado, $res);
	}
	return $resultado;
}

function getInvitedEvents($idUSer){
	$file=new PDO('sqlite:../sqlite/database.db');
	
	$stmt = $file->prepare('SELECT idEvent FROM AttendEvent WHERE idUser = :idUser AND attend = -1');
	$stmt->bindParam(':idUser', $idUSer, PDO::PARAM_INT);
	$stmt->execute();
	$result = $stmt->fetchAll();
	
	$retorno = array();
	
	foreach($result as $row) {
		$stmt = $file->prepare('SELECT * FROM Event WHERE idEvent = :idEvent');
		$stmt->bindParam(':idEvent', $row['idEvent'], PDO::PARAM_INT);
		$stmt->execute();
		$resultado = $stmt->fetchAll();
		
		foreach($resultado as $r) {
			array_push($retorno, $r);
		}
	}
	
	return $retorno;
}


function getComentarios($idEvent){
	$file=new PDO('sqlite:../sqlite/database.db');
	
	$stmt = $file->prepare('SELECT * FROM Comentario WHERE idEvent = :idEvent');
	$stmt->bindParam(':idEvent', $idEvent, PDO::PARAM_INT);
	$stmt->execute();
	$result = $stmt->fetchAll();
	
	return $result;
	
}




?>
