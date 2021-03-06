<?php

require_once('../sqlite/connection.php');
require_once('getSet.php');

function existsUser($username){
	$file=new PDO('sqlite:../sqlite/database.db');
	
	$stmt = $file->prepare('SELECT * FROM User WHERE username = :username;');
	$stmt->bindParam(':username', $username, PDO::PARAM_STR);
	$stmt->execute();
	$result = $stmt->fetchAll();

	if(count($result) === 0){
		return false;
	}  
	return true;
}

function checkLogIn($username, $password){
	$file=new PDO('sqlite:../sqlite/database.db');

	if(!(existsUser($username)))
		return false;
		
	$stmt = $file->prepare('SELECT password FROM User WHERE username = :username');
	$stmt->bindParam(':username', $username, PDO::PARAM_STR);
	$stmt->execute();
	$result = $stmt->fetchAll();
	
	if (count($result) === 0) {
		return false;
	}
	
	$hashed = $result[0]['password'];
	
	if(!function_exists('hash_equals')){
		function hash_equals($str1, $str2)
		{
			if(strlen($str1) != strlen($str2))
			{
				return false;
			}
			else
			{
				$res = $str1 ^ $str2;
				$ret = 0;
				for($i = strlen($res) - 1; $i >= 0; $i--)
				{
					$ret |= ord($res[$i]);
				}
				return !$ret;
			}
		}
	}

	
	/*if(hash_equals($hashed, crypt($password, $hashed))){
		return true;
	}
	return false;	*/
	
	return decrypt($password, $hashed);
}


function encrypt($password, $cost) {

		if (defined("CRYPT_BLOWFISH") && CRYPT_BLOWFISH) {
	        $salt = '$2y$11$' . substr(md5(uniqid(rand(), true)), 0, 22);
	        return crypt($password, $salt);
    	}
}

function decrypt($password, $hashedPass) {
	return crypt($password, $hashedPass) == $hashedPass;
}



function createUser($username, $password, $name, $email){
	$file=new PDO('sqlite:../sqlite/database.db');
	
	if(existsUser($username))
		return false;
		
	$options = [
    		'cost' => 12,
		];
		
	/*$pass = password_hash($password, PASSWORD_BCRYPT, $options);*/
	$pass =  encryptPassword($password, $options);
	
		
	$stmt = $file->prepare('INSERT INTO User(username, password, name, email) VALUES (:username, :password, :name, :email)');
	$stmt->bindParam(':username', $username, PDO::PARAM_STR);
	$stmt->bindParam(':password', $pass, PDO::PARAM_STR);
	$stmt->bindParam(':name', $name, PDO::PARAM_STR);
	$stmt->bindParam(':email', $email, PDO::PARAM_STR);
	$stmt->execute();
	$result = $stmt->fetchAll();
	
	return true;
}

function changePassword($username, $password, $newpassword){
	$file=new PDO('sqlite:../sqlite/database.db');

	if(!existsUser($username))
		return false;
	else{
		$stmt = $file->prepare('SELECT password FROM User WHERE username = :username');
		$stmt->bindParam(':password', $password, PDO::PARAM_STR);
		$stmt->execute();
		$result = $stmt->fetchAll();
		
		if($result[0]['password'] !== $password){
			return false;
		}

		$stmt = $file->prepare('UPDATE User SET password = :newpassword');
		$stmt->bindParam(':newpassword', $newpassword, PDO::PARAM_STR);
		$stmt->execute();
		$result = $stmt->fetchAll();

		if(!$result)
			return false;

		else return true;

	}		
}

function changeName($username, $name, $newname){
	$file=new PDO('sqlite:../sqlite/database.db');

	if(!existsUser($username))
		return false;
	else{
		$stmt = $file->prepare('SELECT name FROM User WHERE username = :username');
		$stmt->bindParam(':name', $name, PDO::PARAM_STR);
		$stmt->execute();
		$result = $stmt->fetchAll();
		
		if($result['name'] !== $name){
			return false;
		}

		$stmt = $file->prepare('UPDATE User SET name = :newname');
		$stmt->bindParam(':newname', $newname, PDO::PARAM_STR);
		$stmt->execute();
		$result = $stmt->fetchAll();

		if(!$result)
			return false;

		else return true;

	}		
}

function changeEmail($username, $email, $newemail){
	$file=new PDO('sqlite:../sqlite/database.db');

	if(!existsUser($username))
		return false;
	else{
		$stmt = $file->prepare('SELECT email FROM User WHERE username = :username');
		$stmt->bindParam(':email', $email, PDO::PARAM_STR);
		$stmt->execute();
		$result = $stmt->fetchAll();
		
		if($result['email'] !== $email){
			return false;
		}

		$stmt = $file->prepare('UPDATE User SET email = :newemail WHERE username = :username');
		$stmt->bindParam(':newemail', $newemail, PDO::PARAM_STR);
		$stmt->execute();
		$result = $stmt->fetchAll();

		if(!$result)
			return false;

		else return true;
	}		
}

function deleteEvent($idEvent){
	$file=new PDO('sqlite:../sqlite/database.db');
	
	$stmt = $file->prepare('DELETE FROM AttendEvent WHERE idEvent = :idEvent');
	$stmt->bindParam(':idEvent', $idEvent, PDO::PARAM_INT);
	$stmt->execute();
	$result = $stmt->fetchAll(); 
	
	$stmt = $file->prepare('DELETE FROM Comentario WHERE idEvent = :idEvent');
	$stmt->bindParam(':idEvent', $idEvent, PDO::PARAM_INT);
	$stmt->execute();
	$result = $stmt->fetchAll();	

	$stmt = $file->prepare('DELETE FROM Event WHERE idEvent = :idEvent');
	$stmt->bindParam(':idEvent', $idEvent, PDO::PARAM_INT);
	$stmt->execute();
	$result = $stmt->fetchAll();

	return true;
}

function deleteUser($idUser){
	$file=new PDO('sqlite:../sqlite/database.db');
	
	$stmt = $file->prepare('DELETE FROM Event WHERE idUser = :idUser');
	$stmt->bindParam(':idUser', $idUser, PDO::PARAM_INT);
	$stmt->execute();
	$result = $stmt->fetchAll();

	if(!$result)
		return false;
	else return true; 

	$stmt = $file->prepare('DELETE FROM AttendEvent WHERE idUser = :idUser');
	$stmt->bindParam(':idUser', $idUser, PDO::PARAM_INT);
	$stmt->execute();
	$result = $stmt->fetchAll();

	if(!$result)
		return false;
	else return true; 
	
	$stmt = $file->prepare('DELETE FROM Comentario WHERE idUser = :idUser');
	$stmt->bindParam(':idUser', $idUser, PDO::PARAM_INT);
	$stmt->execute();
	$result = $stmt->fetchAll();

	if(!$result)
		return false;
	else return true;  

	$stmt = $file->prepare('DELETE FROM User WHERE idUser = :idUser');
	$stmt->bindParam(':idUser', $idUser, PDO::PARAM_INT);
	$stmt->execute();
	$result = $stmt->fetchAll();

	if(!$result)
		return false;
	else return true;  
	
}

function createEvent($idUser, $name, $image, $eventDate, $startHour, $description, $local, $partyType, $type){
	
	$file=new PDO('sqlite:../sqlite/database.db');
	
	$stmt = $file->prepare('INSERT INTO Event(idUser, name, image, eventDate, startHour, description, local, partyType, type) VALUES (:idUser, :name, :image, :eventDate, :startHour, :description, :local, :partyType, :type)');
	$stmt->bindParam(':idUser', $idUser, PDO::PARAM_INT);
	$stmt->bindParam(':name', $name, PDO::PARAM_STR);
	$stmt->bindParam(':image', $image, PDO::PARAM_STR);
	$stmt->bindParam(':eventDate', $eventDate, PDO::PARAM_STR);
	$stmt->bindParam(':startHour', $startHour, PDO::PARAM_STR);
	$stmt->bindParam(':description', $description, PDO::PARAM_STR);
	$stmt->bindParam(':local', $local, PDO::PARAM_STR);
	$stmt->bindParam(':partyType', $partyType, PDO::PARAM_STR);
	$stmt->bindParam(':type', $type, PDO::PARAM_STR);
	$stmt->execute();

	$result = $file->lastInsertId('idEvent');

	return $result;
}

function editEvent($idEvent, $newname, $newImage, $neweventDate, $newstartHour, $newdescription, $newlocal, $newpartyType, $newType){
		
	$file=new PDO('sqlite:../sqlite/database.db');
	
	$stmt = $file->prepare('UPDATE Event SET name = :newname WHERE idEvent = :idEvent');
	$stmt->bindParam(':idEvent', $idEvent, PDO::PARAM_INT);
	$stmt->bindParam(':newname', $newname, PDO::PARAM_STR);
	$stmt->execute();
	$result = $stmt->fetch();

if(!($newImage === "")){
	$stmt = $file->prepare('UPDATE Event SET image = :newImage WHERE idEvent = :idEvent');
	$stmt->bindParam(':idEvent', $idEvent, PDO::PARAM_INT);
	$stmt->bindParam(':newImage', $newImage, PDO::PARAM_STR);
	$stmt->execute();
	$result = $stmt->fetch();
}
	$stmt = $file->prepare('UPDATE Event SET eventDate = :neweventDate WHERE idEvent = :idEvent');
	$stmt->bindParam(':idEvent', $idEvent, PDO::PARAM_INT);
	$stmt->bindParam(':neweventDate', $neweventDate, PDO::PARAM_STR);
	$stmt->execute();
	$result = $stmt->fetch();

	$stmt = $file->prepare('UPDATE Event SET startHour = :newstartHour WHERE idEvent = :idEvent');
	$stmt->bindParam(':idEvent', $idEvent, PDO::PARAM_INT);
	$stmt->bindParam(':newstartHour', $newstartHour, PDO::PARAM_STR);
	$stmt->execute();
	$result = $stmt->fetch();

	$stmt = $file->prepare('UPDATE Event SET description = :newdescription WHERE idEvent = :idEvent');
	$stmt->bindParam(':idEvent', $idEvent, PDO::PARAM_INT);
	$stmt->bindParam(':newdescription', $newdescription, PDO::PARAM_STR);
	$stmt->execute();
	$result = $stmt->fetch();

	$stmt = $file->prepare('UPDATE Event SET local = :newlocal WHERE idEvent = :idEvent');
	$stmt->bindParam(':idEvent', $idEvent, PDO::PARAM_INT);
	$stmt->bindParam(':newlocal', $newlocal, PDO::PARAM_STR);
	$stmt->execute();
	$result = $stmt->fetch();

	$stmt = $file->prepare('UPDATE Event SET type = :newtype WHERE idEvent = :idEvent');
	$stmt->bindParam(':idEvent', $idEvent, PDO::PARAM_INT);
	$stmt->bindParam(':newtype', $newtype, PDO::PARAM_STR);
	$stmt->execute();
	$result = $stmt->fetch();
	
	$stmt = $file->prepare('UPDATE Event SET partyType = :newpartyType WHERE idEvent = :idEvent');
	$stmt->bindParam(':idEvent', $idEvent, PDO::PARAM_INT);
	$stmt->bindParam(':newpartyType', $newpartyType, PDO::PARAM_STR);
	$stmt->execute();
	$result = $stmt->fetch();

	return true;
}

function searchEvent($name){
	$file=new PDO('sqlite:../sqlite/database.db');

	$stmt = $file->prepare('SELECT * FROM Event WHERE name = :name AND type = "public"');
	$stmt->bindParam(':name', $name, PDO::PARAM_STR);
	$stmt->execute();
	$result = $stmt->fetchAll();
	
	return $result;
	
}	

function userEventsAdmin($idUser){
	$file=new PDO('sqlite:../sqlite/database.db');
	
	$stmt = $file->prepare('SELECT * FROM Event WHERE idUser = :idUser');
	$stmt->bindParam(':idUser', $idUser, PDO::PARAM_INT);
	$stmt->execute();
	$result = $stmt->fetchAll();
	
	$retorno = array();
	
	foreach($result as $row) {
		array_push($retorno, $row);
	}
	
	return $retorno;
}

function userEventsAttending($idUser){
	$file=new PDO('sqlite:../sqlite/database.db');
	
	$stmt = $file->prepare('SELECT idEvent FROM AttendEvent WHERE idUser = :idUser AND attend = 1');
	$stmt->bindParam(':idUser', $idUser, PDO::PARAM_INT);
	$stmt->execute();
	$result = $stmt->fetchAll();
	
	$retorno = array();
	
	foreach($result as $row) {
		$stmt = $file->prepare('SELECT * FROM Event WHERE idEvent = :idEvent AND idUser <> :idUser');
		$stmt->bindParam(':idEvent', $row['idEvent'], PDO::PARAM_INT);
		$stmt->bindParam(':idUser', $idUser, PDO::PARAM_INT);
		$stmt->execute();
		$resultado = $stmt->fetchAll();
		
		foreach($resultado as $r) {
			array_push($retorno, $r);
		}
	}
	
	return $retorno;
}

function isAdminEvent($idUser, $idEvent){
	$file=new PDO('sqlite:../sqlite/database.db');	
	
	$stmt = $file->prepare('SELECT * FROM Event WHERE idUser = :idUser AND idEvent= :idEvent');
	$stmt->bindParam(':idUser', $idUser, PDO::PARAM_INT);
	$stmt->bindParam(':idEvent', $idEvent, PDO::PARAM_INT);
	$stmt->execute();
	$result = $stmt->fetchAll();
	
	if (count($result) === 0) {
		return false;
	}
	
	return true;
}

function isAttendingEvent($idUser, $idEvent){
	$file=new PDO('sqlite:../sqlite/database.db');
	
	
	$stmt = $file->prepare('SELECT * FROM AttendEvent WHERE idUser = :idUser AND idEvent = :idEvent');
	$stmt->bindParam(':idEvent', $idEvent, PDO::PARAM_INT);
	$stmt->bindParam(':idUser', $idUser, PDO::PARAM_INT);
	$stmt->execute();
	$result = $stmt->fetchAll();
	
	if (count($result) === 0) {
		return false;
	}
	
	return true;
}



function eventRelatedtoUser($idUser, $idEvent){
	$file=new PDO('sqlite:../sqlite/database.db');
	
	if(!(isAdminEvent($idUser, $idEvent)))
		if(!(isAttendingEvent($idUser, $idEvent)))
			return false;
		else return true;
			
	return true;
}

function addComment($idUser, $idEvent, $comentario){
	$file=new PDO('sqlite:../sqlite/database.db');
	
	if(!(eventRelatedtoUser($idUser, $idEvent)))
		return false;
	
	$stmt = $file->prepare('INSERT INTO Comentario(idUser, idEvent, comentario) VALUES (:idUser, :idEvent, :comentario)');
	$stmt->bindParam(':idUser', $idUser, PDO::PARAM_INT);
	$stmt->bindParam('idEvent', $idEvent, PDO::PARAM_INT);
	$stmt->bindParam(':comentario', $comentario, PDO::PARAM_STR);
	$stmt->execute();
	$result = $stmt->fetchAll();
	
		
	return true;
}

function userCanRegister($idUser){
	$file=new PDO('sqlite:../sqlite/database.db');

	$retorno = array();
	
	$stmt = $file->prepare('select idEvent from Event where idEvent Not in ( select attendEvent.idEvent from AttendEvent where idUser = :idUser)');
	$stmt->bindParam(':idUser', $idUser, PDO::PARAM_INT);
	$stmt->execute();
	$result = $stmt->fetchAll();
	
	foreach($result as $row) {
		$stmt = $file->prepare('SELECT * FROM Event WHERE idEvent = :idEvent AND type = "public"');
		$stmt->bindParam(':idEvent', $row['idEvent'], PDO::PARAM_INT);
		$stmt->execute();
		$resultado = $stmt->fetchAll();
		
		foreach($resultado as $r) {
			array_push($retorno, $r);
		}
	}
	
	return $retorno;
}

function registed($idEvent, $idUser){
	$file=new PDO('sqlite:../sqlite/database.db');
	
	$stmt = $file->prepare('SELECT * FROM AttendEvent WHERE idUser = :idUser AND  idEvent = :idEvent ;');
	$stmt->bindParam(':idUser', $idUser, PDO::PARAM_INT);
	$stmt->bindParam(':idEvent', $idEvent, PDO::PARAM_INT);
	$stmt->execute();
	$result = $stmt->fetchAll();

	if(count($result) === 0){
		return false;
	}  
	return true;
}


function registerEvent($idEvent, $idUser){
	$file=new PDO('sqlite:../sqlite/database.db');
	
	if(registed($idEvent, $idUser)){
		return false;
	}
	
	$stmt = $file->prepare('SELECT * FROM Event WHERE idEvent = :idEvent AND type = "public"');
	$stmt->bindParam(':idEvent', $idEvent, PDO::PARAM_INT);
	$stmt->execute();
	$result = $stmt->fetchAll();
	
	if (count($result) === 0) {
		return false;
	}
	
	$attend = 1;
	$stmt = $file->prepare('INSERT INTO AttendEvent(idEvent, idUser, attend) VALUES (:idEvent, :idUser, :attend)');
	$stmt->bindParam(':idEvent', $idEvent, PDO::PARAM_INT);
	$stmt->bindParam(':idUser', $idUser, PDO::PARAM_INT);
	$stmt->bindParam(':attend', $attend, PDO::PARAM_INT);
	$stmt->execute();
	$result = $stmt->fetchAll();

	return true;
}

function getInviteList($idEvent){
	$file=new PDO('sqlite:../sqlite/database.db');
	
	$stmt = $file->prepare('SELECT DISTINCT User.* FROM User,Event WHERE User.idUser <> Event.idUser AND 
	User.idUser NOT IN(SELECT idUser FROM AttendEvent WHERE idEvent=:idEvent)');
	$stmt->bindParam(':idEvent', $idEvent, PDO::PARAM_INT);
	$stmt->execute();
	$result = $stmt->fetchAll();


	return $result;
}

function invite($idUser, $idEvent){
	$file=new PDO('sqlite:../sqlite/database.db');
	
	$attend = -1;
	$stmt = $file->prepare('INSERT INTO AttendEvent(idEvent, idUser, attend) VALUES (:idEvent, :idUser, :attend)');
	$stmt->bindParam(':idEvent', $idEvent, PDO::PARAM_INT);
	$stmt->bindParam(':idUser', $idUser, PDO::PARAM_INT);
	$stmt->bindParam(':attend', $attend, PDO::PARAM_INT);
	$stmt->execute();
	$result = $stmt->fetchAll();

	return true;
	
	
}

?>