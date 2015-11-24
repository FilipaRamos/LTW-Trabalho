<?php

	/****************************************/
	/************ INSERT INTO ***************/
	/****************************************/

	function insertUser($file, $username, $password, $name, $email) {
	$stmt = $file->$prepare = ('INSERT INTO User (username, password, name, email) 
                VALUES (:username, :password, :name, :email');
    $stmt->execute(array($username, $password, $name, $email));
	}

	function insertEvent($file, $id, $name, $image, $eventDate, $description, $local, $type) {
	$stmt = $file->$prepare = ('INSERT INTO Event (id, name, image, eventDate, description, local, type) 
                VALUES (:id, :name, :image, :eventDate, :description, :local, :type');
    $stmt->execute(array($id, $name, $image, $eventDate, $description, $local, $type));
	}

	function insertBelong($file, $userID, $idEvent, $Usertype) {
	$stmt = $file->$prepare = ('INSERT INTO Belong (userID, idEvent, Usertype) 
                VALUES (:userID, :idEvent, :Usertype');
    $stmt->execute(array($userID, $idEvent, $Usertype));
	}

	/****************************************/
	/************** GET INFO ***************/
	/***************************************/
	function getUsers($file) {
    $stmt = $file->prepare('SELECT * FROM User');
    $stmt->execute();
    return $stmt->fetchAll();
  	}

  	function getEvents($file) {
    $stmt = $file->prepare('SELECT * FROM Event');
    $stmt->execute();
    return $stmt->fetchAll();
  	}

  	function getBelongs($file) {
    $stmt = $file->prepare('SELECT * FROM Belong');
    $stmt->execute();
    return $stmt->fetchAll();
  	}

?>