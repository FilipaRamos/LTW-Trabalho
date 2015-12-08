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
				<div class="innerNav">
					<ul class="nav-horizontal-bar" id="elemsRight">
						<li class="li-hor"><label id="profile"><?php echo ($_SESSION["name"]); ?></label></li>
						<li class="li-hor"><button id="createEvent" type="submit"><i class="fa fa-plus-square fa-2x"></i></button></li>
						<li class="li-hor"><button id="settings" type="submit"><i class="fa fa-cog fa-fw fa-2x"></i></button></li>
						<li class="li-hor"><button id="logOut" type="submit"><i class="fa fa-sign-out fa-2x"></i></button></li>
					</ul>
					<ul class="nav-horizontal-bar" id="elemsLeft">
						<li class="li-hor"><button id="home" type="submit"><i class="fa fa-home fa-2x"></i></button></li>
						<li class="li-hor"><input id="search" type="text" value="" placeholder="Search by name"></li>	
						<li class="li-hor"><button id="search-icon" type="submit"><i class="fa fa-search fa-2x"></i></button></li>
					</ul>
				</div>
			</div>
			<div id="background-block">
				
				<div class="innerNav2">
					<ul class="nav-horizontal-bar2">
						<li class="li-hor"><button id="interestingEvents">Interesting Events</button></li>
						<li class="li-hor"><button id="AdminEvents">Admin Events</button></li>
						<li class="li-hor"><button id="AttendingEvents">Attending Events</button></li>
						<li class="li-hor"><button id="InvitedEvents">Invited Events</button></li>
					</ul>
				</div>
				<div class="event-block" id= "event-block">
					<?php
					echo '<div class="events-list-Interesting" id="events-list-Interesting">';		
					echo '<label class="event-block-h3"> Interesting Events </label>';	
						foreach($eventsInteresting as $event){
							echo '<div class="hiddenDiv">'. $event['idEvent'] . '</div>'; 
							echo '<div class="events-card" >';
							echo '<button id="registerEvent" type="submit"><i class="fa fa-calendar-check-o fa-4x"></i></button>';
							echo '<h4 id="nameEvent">' . $event["name"] . '</h4>';
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
			<div class= "createEvent" id="createEvent">
				<form id="createEventForm" method="post" enctype="multipart/form-data">
					<input type="text" value="" placeholder="Name" id="name" name="name" required>	
					<input type="file" name="image" id="image">
					<input type="date" value="" placeholder="Date" id="eventDate" name="eventDate" required>					
					<input type="time" value="" placeholder="Hour" id="startHour" name="startHour" required>
					<input type="text" value="" placeholder="Description" id="description" name="description" required>					
					<input type="text" value="" placeholder="Local" id="local" name="local" required>
					<input type="text" value="" placeholder="Party type eg: party" id="partyType" name="partyType" required>	
					<input type="radio"  value="public" name="type" id="typePublic" checked><label class="publicRB">public</label>
					<input type="radio" value="private"  name="type" id="typePrivate"><label class="privateRB">private</label>	
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