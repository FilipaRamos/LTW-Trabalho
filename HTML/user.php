<?php
	 include_once('../PHP/process.php');
	 $eventsAdmin = userEventsAdmin($_GET['idUser']);
	 $eventsAttending = userEventsAdmin($_GET['idUser']);
	 $userName = getUser($_GET['idUser']);
?>
<!DOCTYPE html>
	<html>
		<head>
			<title>COUNT ME IN </title>
			 <link type="text/css" rel="stylesheet" href="../CSS/user.css"/>
			 <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
			 <link rel="stylesheet" type="text/css" href="../sweetalert-master/dist/sweetalert.css">
			 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
			 <link href='https://fonts.googleapis.com/css?family=Raleway:400,700,500,600' rel='stylesheet' type='text/css'>
			 <script src="../JS/user.js"></script>
		</head>
		<body>
			<div class="nav-bar">
				<!--<button id="back" type="submit"><i class="fa fa-arrow-left fa-2x"></i></button>	-->
					<input type="text" value="" placeholder="Search by name" id="search">			
					<button id="search-icon" type="submit"><i class="fa fa-search fa-2x"></i></button>
					<a href= "log in.php"><button id="logOut" onclick="logout()" type="submit"><i class="fa fa-sign-out fa-2x"></i></button> </a>
					<button id="settings" type="submit"><i class="fa fa-cog fa-fw fa-2x"></i></button>	
					<button id="createEvent" type="submit"><i class="fa fa-plus-square fa-2x"></i></button>
					<label id="profile"><?php echo $userName[0]['name']; ?></label>
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
				<div class="event-block">
					<?php
						echo '<h3> Admin </h3>';
						foreach($eventsAdmin as $event){
							echo '<div class="events-list-Admin" id="events-list-Admin">';
							//echo '<h3> Admin </h3>';
							echo '<h4>' . $event["name"] . '</h4>';
							echo '<p>' . $event["local"] . '</p>';
							echo '<p>' . $event["eventDate"] . ' ' . $event["startHour"] . '</p>';
							echo '<p>' . $event["type"] . '</p>';
							echo '<p>' . $event["description"] . '</p>';
							//echo '<img src=' . $event["image"] . '>';		
							echo '</div>';				
						}
						
						echo '<h3> Attending </h3>';
						foreach($eventsAttending as $event){
							echo '<div class="events-list-Attending" id="events-list-Attending">';
							//echo '<h3> Attending </h3>';
							echo '<h4>' . $event["name"] . '</h4>';
							echo '<p>' . $event["local"] . '</p>';
							echo '<p>' . $event["eventDate"] . ' ' . $event["startHour"] . '</p>';
							echo '<p>' . $event["type"] . '</p>';
							echo '<p>' . $event["description"] . '</p>';
							//echo '<img src=' . $event["image"] . '>';
							echo '</div>';	
						}
					?>
				</div>
				<script src="../sweetalert-master/dist/sweetalert.min.js"></script> 
		</body>
	</html>