<?php
	 include_once('../PHP/process.php');
	 include_once('../PHP/getSet.php');
	 $eventsAdmin = userEventsAdmin($_GET['idUser']);
	 $eventsAttending = userEventsAttending($_GET['idUser']);
	 $userName = getUserName($_GET['idUser']);
	 $userEmail = getUserEmail($_GET['idUser']);
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
			<div class="nav-bar" id="nav">
				
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
			<div id="background-block">
				<div class="event-block" id= "event-block">
					<?php
						echo '<h3> Admin </h3>';
						echo '<div class="events-list-Admin" id="events-list-Admin">';
						foreach($eventsAdmin as $event){
							echo '<div class="events-card-Admin" id="events-card-Admin">';
							//echo '<h3> Admin </h3>';
							echo '<h4>' . $event["name"] . '</h4>';
							echo '<p>' . $event["local"] . '</p>';
							echo '<p>' . $event["eventDate"] . ' ' . $event["startHour"] . '</p>';
							echo '<p>' . $event["type"] . '</p>';
							echo '<p>' . $event["description"] . '</p>';
							//echo '<img src=' . $event["image"] . '>';		
							echo '</div>';			
						}
						echo '</div>';
							
						echo '<h3> Attending </h3>';
						echo '<div class="events-list-Attending" id="events-list-Attending">';
						foreach($eventsAttending as $event){
							echo '<div class="events-card-Attending" id="events-card-Attending">';
							//echo '<h3> Attending </h3>';
							echo '<h4>' . $event["name"] . '</h4>';
							echo '<p>' . $event["local"] . '</p>';
							echo '<p>' . $event["eventDate"] . ' ' . $event["startHour"] . '</p>';
							echo '<p>' . $event["type"] . '</p>';
							echo '<p>' . $event["description"] . '</p>';
							//echo '<img src=' . $event["image"] . '>';
							echo '</div>';	
						}
						echo '</div>';
					?>
				</div>
			</div>
			<div class= "createEvent">
						<form id="createEventForm">
							<input type="text" value="" placeholder="Name" id="name" required>					
							<input type="file" placeholder="holi1.jpg" id="image">
							<input type="date" value="" placeholder="Date" id="eventDate" required>					
							<input type="time" value="" placeholder="Hour" id="startHour" required>
							<input type="text" value="" placeholder="Description" id="description">					
							<input type="text" value="" placeholder="Local" id="local" required>
							<input type="text" value="" placeholder="Party type eg: party" id="partyType" required>	
							<input type="radio"  value="public" name="type" id="typePublic" checked>public
							<input type="radio" value="private"  name="type" id="typePrivate">private	
							<button id="create" type="submit">create</button>	
						</form>
						<button id="cancel" type="submit">cancel</button>
			</div>
			<div class= "editProfile">
						<form id="editProfileForm">
							<input type="text" value=<?php echo $userName[0]['name']; ?> placeholder=<?php echo $userName[0]['name']; ?> id="name">	
							<input type="text" value=<?php echo $userEmail[0]['name']; ?> placeholder="Email" id="email">		
							<input type="text" value="" placeholder="Password" id="password">					
							<input type="text" value="" placeholder="New Password" id="newPassword">
							<button id="edit" type="submit">edit</button>
						</form>
						<button id="cancel" type="submit">cancel</button>
			</div>	
				<script src="../sweetalert-master/dist/sweetalert.min.js"></script> 
		</body>
	</html>