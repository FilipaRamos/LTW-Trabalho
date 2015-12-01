<?php

include_once('../sqlite/connection.php');

function getUserName($idUser){
	$file=new PDO('sqlite:../sqlite/database.db');
	
	$stmt = $file->prepare('SELECT name FROM User WHERE idUser = :idUser;');
	$stmt->bindParam(':idUser', $idUser, PDO::PARAM_STR);
	$stmt->execute();
	$result = $stmt->fetchAll();
	
	return $result;
}

function getUserEmail($idUser){
	$file=new PDO('sqlite:../sqlite/database.db');
	
	$stmt = $file->prepare('SELECT email FROM User WHERE idUser = :idUser;');
	$stmt->bindParam(':idUser', $idUser, PDO::PARAM_STR);
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


?>
