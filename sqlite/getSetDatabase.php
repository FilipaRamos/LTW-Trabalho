<?php

	include_once('connection.php');

	/****************************************/
	/************** GET INFO ***************/
	/***************************************/

	/*********** GET COMPLETE TABLES ***********/
	
	function getAllUsers(){
		global $file;
		$stmt = $file->prepare('SELECT * FROM User');
		$stmt->execute();
		$result = $stmt->fetchAll();
	}
	
	function getAllEvents() {
		global $file;
    	$stmt = $file->prepare('SELECT * FROM Event');
    	$stmt->execute();
    	$result = $stmt->fetchAll();
  	}

  	function getAllBelongs() {
		global $file;
   	 	$stmt = $file->prepare('SELECT * FROM Belong');
   	 	$stmt->execute();
   	 	$result = $stmt->fetchAll();
  	}
	  
	  function getUser($username){
		global $file;
		$stmt = $file->prepare('SELECT * FROM User WHERE username = :username');
		$stmt->bindParam(':username', $_GET['username'], PDO::PARAM_INT);
		$stmt->execute();
		$result = $stmt->fetch();
		if(count($result) === 0){
			return false;
		}  
		return true;
	  }
	  
	  
	   function checkLogIn($username, $password){
		global $file;
		
		if(!getUser($username))
			return false;
		else{
			$stmt = $file->prepare('SELECT password FROM User WHERE username = :username');
			$stmt->bindParam(':password', $password, PDO::PARAM_STR);
			$stmt->execute();
			$result = $stmt->fetch();
		
			if($result['password'] !=== $password){
				return false;
			}
			else return true;
		}		
	  }
	  
	  function changePassword($username, $password, $newpassword){
		  global $file;
		
		if(!getUser($username))
			return false;
		else{
			$stmt = $file->prepare('SELECT password FROM User WHERE username = :username');
			$stmt->bindParam(':password', $password, PDO::PARAM_STR);
			$stmt->execute();
			$result = $stmt->fetch();
		
			if($result['password'] !=== $password){
				return false;
			}

			$stmt = $file->prepare('UPDATE User SET password = :newpassword');
			$stmt->bindParam(':newpassword', $newpassword, PDO::PARAM_STR);
			$stmt->execute();
			$result = $stmt->fetch();
			
		}		
	  }
	  
	  function changeName($username, $name, $newname){
		  global $file;
		
		if(!getUser($username))
			return false;
		else{
			$stmt = $file->prepare('SELECT name FROM User WHERE username = :username');
			$stmt->bindParam(':name', $name, PDO::PARAM_STR);
			$stmt->execute();
			$result = $stmt->fetch();
		
			if($result['name'] !=== $name){
				return false;
			}

			$stmt = $file->prepare('UPDATE User SET name = :newname');
			$stmt->bindParam(':newname', $newname, PDO::PARAM_STR);
			$stmt->execute();
			$result = $stmt->fetch();
			
		}		
	  }
	  
	   function changeEmail($username, $email, $newemail){
		  global $file;
		
		if(!getUser($username))
			return false;
		else{
			$stmt = $file->prepare('SELECT email FROM User WHERE username = :username');
			$stmt->bindParam(':email', $email, PDO::PARAM_STR);
			$stmt->execute();
			$result = $stmt->fetch();
		
			if($result['email'] !=== $email){
				return false;
			}

			$stmt = $file->prepare('UPDATE User SET email = :newemail');
			$stmt->bindParam(':newemail', $newemail, PDO::PARAM_STR);
			$stmt->execute();
			$result = $stmt->fetch();
			
		}		
	  }
	  
	  
	  function deleteEvent(){
		  
	  }
	  
	

?>