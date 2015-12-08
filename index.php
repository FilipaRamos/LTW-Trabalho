<?php 
		session_start();
		if (isset($_SESSION["username"])) {
			header("Location: HTML/user.php");
		}	
		else header("Location: HTML/log in.php");			
?>