<?php
	 include_once('../PHP/process.php');
	 $eventsAdmin = userEventsAdmin($_GET['idUser']);
	 $eventsAttending = userEventsAdmin($_GET['idUser']);
?>
<!DOCTYPE html>
	<html>
		<head>
			<title>COUNT ME IN </title>
			 <link type="text/css" rel="stylesheet" href="../CSS/user.css"/>
			 <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
			 <link rel="stylesheet" type="text/css" href="../sweetalert-master/dist/sweetalert.css">
		</head>
		<body>
			<div class="options">
				<button id="createEvent" type="submit">create event</button>
				<button id="settings" type="submit">settings</button>
				<a href= "log in.php"><button id="logOut" onclick="logout()" type="submit">log out</button> </a>	
				<?php
					function logout(){
						// remove all session variables
						session_unset(); 

					// destroy the session 
					session_destroy(); 
						echo 'pintou';
					}
				?>
			</div>
			<div class="side-bars">
				<div class="event-block">
					<div class="events-list">
					<h3> Admin </h3>
					<?php
						foreach($eventsAdmin as $event){
							echo '<p>' . $event["name"] . '</p>';
							echo '<p>' . $event["local"] . '</p>';
							echo '<p>' . $event["eventDate"] . ' ' . $event["startHour"] . '</p>';
							echo '<p>' . $event["type"] . '</p>';
							echo '<p>' . $event["description"] . '</p>';
							echo '<img src=' . $event["image"] . '>';						
						}
					?>
					<h3> Attending </h3>
					<?php 
						foreach($eventsAttending as $event){
							echo '<p>' . $event["name"] . '</p>';
							echo '<p>' . $event["local"] . '</p>';
							echo '<p>' . $event["eventDate"] . ' ' . $event["startHour"] . '</p>';
							echo '<p>' . $event["type"] . '</p>';
							echo '<p>' . $event["description"] . '</p>';
							echo '<img src=' . $event["image"] . '>';	
						}
					?>
					</div>
				</div>
			</div>
				<script src="../sweetalert-master/dist/sweetalert.min.js"></script> 
		</body>
	</html>