<?php

	/****************************************/
	/************ INSERT INFO ***************/
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

	/*********** GET COMPLETE TABLES ***********/
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
  	/*******************************************/

  	/************* GET USER ATRIBUTES ************/

  	// GET USER BY USERNAME
  	function getUser($file, $username){
		$stmt = $file->prepare('SELECT * FROM User WHERE username = ?');
  		$stmt->execute(array($username));
    	return $stmt->fetch();
  	}

  	// GET PASSWORD BY USERNAME
  	function getUserPassword($file, $username) {
  		$stmt = $file->prepare('SELECT password FROM User WHERE username = ?');
  		$stmt->execute(array($username));
    	return $stmt->fetch();
  	}

  	// GET NAME BY USERNAME
  	function getUserName($file, $username) {
  		$stmt = $file->prepare('SELECT name FROM User WHERE username = ?');
  		$stmt->execute(array($username));
    	return $stmt->fetch();
  	}

  	// GET EMAIL BY USERNAME
  	function getUserEmail($file, $username) {
  		$stmt = $file->prepare('SELECT email FROM User WHERE username = ?');
  		$stmt->execute(array($username));
    	return $stmt->fetch();
  	}
  	/**************************************/

  	/*************** GET EVENT ATTRIBUTES *************/

  	// GET EVENT BY ID
  	function getEvent($file, $id) {
  		$stmt = $file->prepare('SELECT * FROM Event WHERE id = ?');
  		$stmt->execute(array($id));
    	return $stmt->fetch();
  	}

  	// GET NAME BY ID
  	function getEventName($file, $id) {
  		$stmt = $file->prepare('SELECT name FROM Event WHERE id = ?');
  		$stmt->execute(array($id));
    	return $stmt->fetch();
  	}

  	// GET IMAGE BY ID
  	function getEventImage($file, $id) {
  		$stmt = $file->prepare('SELECT image FROM Event WHERE id = ?');
  		$stmt->execute(array($id));
    	return $stmt->fetch();
  	}

  	// GET EVENT DATE BY ID
  	function getEventDate($file, $id) {
  		$stmt = $file->prepare('SELECT eventDate FROM Event WHERE id = ?');
  		$stmt->execute(array($id));
    	return $stmt->fetch();
  	}

  	// GET DESCRIPTION BY ID
  	function getEventDescription($file, $id) {
  		$stmt = $file->prepare('SELECT description FROM Event WHERE id = ?');
  		$stmt->execute(array($id));
    	return $stmt->fetch();
  	}

  	// GET LOCAL BY ID
  	function getEventLocal($file, $id) {
  		$stmt = $file->prepare('SELECT local FROM Event WHERE id = ?');
  		$stmt->execute(array($id));
    	return $stmt->fetch();
  	}

  	// GET TYPE BY ID
  	function getEventType($file, $id) {
  		$stmt = $file->prepare('SELECT type FROM Event WHERE id = ?');
  		$stmt->execute(array($id));
    	return $stmt->fetch();
  	}
  	/****************************************************/

  	/*************** GET BELONG ATTRIBUTES ******************/

  	// GET BELONG TABLE FROM USER ID
  	function getBelongbyUserID($file, $userID) {
  		$stmt = $file->prepare('SELECT * FROM Belong WHERE userID = ?');
  		$stmt->execute(array($userID));
    	return $stmt->fetch();
  	}

  	// GET BELONG TABLE FROM EVENT ID
  	function getBelongbyUserID($file, $idEvent) {
  		$stmt = $file->prepare('SELECT * FROM Belong WHERE idEvent = ?');
  		$stmt->execute(array($idEvent));
    	return $stmt->fetch();
  	}

  	// GET USER TYPE BY USER ID AND EVENT ID
  	function getBelongUserType($file, $userID, $idEvent) {
  		$stmt = $file->prepare('SELECT Usertype FROM Belong WHERE userID = ? AND idEvent = ?');
  		$stmt->execute(array($userID, $idEvent);
    	return $stmt->fetch();
  	}
  	/********************************************************/

?>