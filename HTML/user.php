<?php
   session_start();
	 include_once('../PHP/process.php');
	 include_once('../PHP/getSet.php');
	 
	 $idUser = $_SESSION["idUser"];
	 $eventsAdmin = userEventsAdmin($idUser);
	 $eventsAttending = userEventsAttending($idUser);
	 $eventsInteresting = userCanRegister($idUser);
	 $eventsInvited = getInvitedEvents($idUser);
	 $userName = getUserName($idUser);
	 $userEmail = getUserEmail($idUser);
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
					<input id="search" type="text" value="" placeholder="Search by name">	
					<button id="search-icon" type="submit"><i class="fa fa-search fa-2x"></i></button>
					<button id="logOut" type="submit"><i class="fa fa-sign-out fa-2x"></i></button>
					<button id="settings" type="submit"><i class="fa fa-cog fa-fw fa-2x"></i></button>
					<button id="createEvent" type="submit"><i class="fa fa-plus-square fa-2x"></i></button>
					<label id="profile"><?php echo ($_SESSION["name"]); ?></label>
			</div>
			<div id="background-block">
				<button id="interestingEvents">Interesting Events</button>
				<button id="AdminEvents">Admin Events</button>
				<button id="AttendingEvents">Attending Events</button>
				<button id="InvitedEvents">Invited Events</button>
				<div class="event-block" id= "event-block">
					<?php
					echo '<h3> Interesting Events </h3>';
					echo '<div class="events-list" id="events-list">';			
						foreach($eventsInteresting as $event){
							echo '<div class="hiddenDiv">'. $event['idEvent'] . '</div>'; 
							echo '<div class="events-card-interesting" >';
							echo '<button id="registerEvent" type="submit"><i class="fa fa-calendar-check-o fa-4x"></i></button>';
							echo '<h4 id="name">' . $event["name"] . '</h4>';
							echo '<p><i class="fa fa-location-arrow"></i>' . $event["local"] . '</p>';
							echo '<p><i class="fa fa-calendar"></i>'. ' ' . $event["eventDate"] . '  ' . '<i class="fa fa-clock-o"></i>' .' ' .$event["startHour"] . '</p>';
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
				<form id="createEventForm" enctype="multipart/form-data">
					<input type="text" value="" placeholder="Name" id="name" required>	
					<input type="file" name="image" id="image">
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