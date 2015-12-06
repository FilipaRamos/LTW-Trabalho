<?php
   session_start();
   if (isset($_SESSION["username"])) {
			header("Location: user.php");
	}	
 ?>
 
<!DOCTYPE html>
	<html>
		<head>
			 <title>REGISTER </title>
			 <link type="text/css" rel="stylesheet" href="../CSS/register.css"/>
			 <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
			 <script src="../JS/register.js"></script>
			 <link rel="stylesheet" type="text/css" href="../sweetalert-master/dist/sweetalert.css">
			 <link href='https://fonts.googleapis.com/css?family=Raleway:400,700,500,600' rel='stylesheet' type='text/css'>
		</head>
		<body>
			<div class="register"></div>
				<div class="register-block">
					<form id="registerForm">
						<h1>Count me in</h1>
						<input type="text" value="" placeholder="Username" id="username" required>						
						<input type="password" value="" placeholder="Password" id="password" required>
						<input type="text" value="" placeholder="Name" id="name" required>
						<input type="email" value="" placeholder="Email" id="email" required>
						<button id="register" type="submit">register</button>
					</form>
					<a href= "log in.php"> <button id="cancel">cancel</button> </a>
				</div>
				<script src="../sweetalert-master/dist/sweetalert.min.js"></script>
		</body>
	</html>