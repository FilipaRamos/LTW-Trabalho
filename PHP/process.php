<?php

include_once('../sqlite/connection.php');

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

function getUser($idUser){
	$file=new PDO('sqlite:../sqlite/database.db');
	
	$stmt = $file->prepare('SELECT name FROM User WHERE idUser = :idUser;');
	$stmt->bindParam(':idUser', $idUser, PDO::PARAM_STR);
	$stmt->execute();
	$result = $stmt->fetchAll();
	
	return $result;
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
	
	if(hash_equals($hashed, crypt($password, $hashed))){
		return true;
	}
	return false;	
}

function createUser($username, $password, $name, $email){
	$file=new PDO('sqlite:../sqlite/database.db');
	
	if(existsUser($username))
		return false;
		
	$options = [
    		'cost' => 12,
		];
		
	$pass = password_hash($password, PASSWORD_BCRYPT, $options);
	
		
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

	if(!$result)
		return false;
	else return true;  
	
	$stmt = $file->prepare('DELETE FROM Comentario WHERE idEvent = :idEvent');
	$stmt->bindParam(':idEvent', $idEvent, PDO::PARAM_INT);
	$stmt->execute();
	$result = $stmt->fetchAll();

	if(!$result)
		return false;
	else return true;  		

	$stmt = $file->prepare('DELETE FROM Event WHERE idEvent = :idEvent');
	$stmt->bindParam(':idEvent', $idEvent, PDO::PARAM_INT);
	$stmt->execute();
	$result = $stmt->fetchAll();

	if(!$result)
		return false;
	else return true;
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

function editEvent($idEvent, $name, $newname, $image, $newImage, $eventDate, $neweventDate, $startHour, $newstartHour, 
	$description, $newdescription, $local, $newlocal, $type, $newtype){

	$stmt = $file->prepare('UPDATE Event SET name = :newname WHERE idEvent = :idEvent');
	$stmt->bindParam(':idEvent', $idEvent, PDO::PARAM_INT);
	$stmt->bindParam(':newname', $newname, PDO::PARAM_STR);
	$stmt->execute();
	$result = $stmt->fetch();
	
	$stmt = $file->prepare('UPDATE Event SET image = :newImage WHERE idEvent = :idEvent');
	$stmt->bindParam(':idEvent', $idEvent, PDO::PARAM_INT);
	$stmt->bindParam(':newimage', $newimage, PDO::PARAM_STR);
	$stmt->execute();
	$result = $stmt->fetch();

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

}

function searchEvent($name){
		$file=new PDO('sqlite:../sqlite/database.db');

		$stmt = $file->prepare('SELECT * FROM Event WHERE name = :name AND type = "public"');
		$stmt->bindParam(':name', $name, PDO::PARAM_STR);
		$stmt->execute();
		$result = $stmt->fetch();
		
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
	
	$stmt = $file->prepare('SELECT idEvent FROM AttendEvent WHERE idUser = :idUser');
	$stmt->bindParam(':idUser', $idUser, PDO::PARAM_INT);
	$stmt->execute();
	$result = $stmt->fetchAll();
	
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



?>