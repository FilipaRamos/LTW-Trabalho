<?php
	session_start();
	 include_once('../PHP/process.php');
	 include_once('../PHP/getSet.php');
	 
	 $idUser = $_SESSION["idUser"];
	 $event = getEvent($_GET['idEvent']);
	 
	 if(!eventRelatedtoUser($idUser, $_GET['idEvent'])){
	 	header("Location: error.php");
	 }
	 
	 
	$eventHost = getUserName(getEventHost($_GET['idEvent'])[0]['idUser']);
	if (count (getAttendState($_GET['idEvent'],$idUser)) === 0) {
			$eventAttend = "";
	} else   $eventAttend = getAttendState($_GET['idEvent'],$idUser)[0]['attend'];
		
	$goingList = getAllGoingEvent($_GET['idEvent']);
	 
	$comentarios = getComentarios($_GET['idEvent']);
	
	$inviteList = getInviteList($_GET['idEvent']);

	 
?>
<!DOCTYPE html>
	<html>
		<head>
			<title>COUNT ME IN </title>
			 <link type="text/css" rel="stylesheet" href="../CSS/eventPage.css"/>
			 <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
			 <link rel="stylesheet" type="text/css" href="../sweetalert-master/dist/sweetalert.css">
			 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
			 <link href='https://fonts.googleapis.com/css?family=Raleway:400,700,500,600' rel='stylesheet' type='text/css'>
			 <script src="../JS/event.js"></script>
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
			<div class= "image-block">
				<div class="event">
					<div class="event-block">
						<div class="buttons">
							<li class="li-hor"><button id="editPencil"><i class="fa fa-pencil fa-4x"></i></button></li>
							<li class="li-hor"><button id="inviteMail"><i class="fa fa-envelope fa-4x"></i></button></li>
							<li class="li-hor"><div class="hiddenDivEvent"><?php echo $_GET['idEvent']?></div></li> 
							<?php 
							if(isAdminEvent($idUser, $_GET['idEvent']))
								echo '<li class="li-hor"><button id="deleteEvent"><i class="fa fa-trash fa-4x"></i></button>';
							?>
						</div>
						
						<h1><?php echo $event[0]['name'] ?></h1>
						<div id= "type-host-attend">
							<?php 								
								if ($event[0]['type'] === "private")
									echo '<label id="type"><i class="fa fa-lock fa-2x "></i></label>';
								else 
									echo '<label id="type"><i class="fa fa-unlock fa-2x"></i></label>';
								echo '<label class="hostedBy">' . ' Hosted by '. $eventHost[0]['name'] . '</label>';
								if($eventAttend == 1)
									echo '<label class="yes"> yes </label>';
								else	
									echo '<label class="no"> no </label>';
								
							?>
						</div>
						<div class="union">
						<div id= "event-info">
							<?php
								echo '<p>' . $event[0]['eventDate'] . '</p>';
								echo '<p>' . $event[0]['startHour'] . '</p>';
								echo '<p>' . $event[0]['local'] . '</p>';
								echo '<p>' . $event[0]['partyType'] . '</p>';
								echo '<p>' . $event[0]['description'] . '</p>';
							?>
						</div>
						<div class="event-image">
							<?php echo '<img src=../PHP/'.$event[0]['image'].'>'; ?>
						</div>
						</div>
					</div>
						<div id="Going-list">
							<label class="Going-list">Going list</label>
							<?php
								foreach($goingList as $gl){
									echo '<p>' . $gl[0]['name'] . '</p>';
								} 
							?>
						</div>		
			<div class="comments-block">		
				<div class= "list-comments">
					<label class="Comments">Comments</label>
						<?php 
						foreach($comentarios as $com){
							$name = getUserName($com['idUser']);
							echo '<p>' . $name[0]['name'] . '</p>';
							echo '<label class="commentBody">' . $com['comentario'] . '</label>';
						}
						?>					
				</div>	
					<div id= "addComment" idUser=<?php echo $idUser ?> idEvent=<?php echo $_GET['idEvent'] ?>>
							<textarea id="comentario" rows="4" cols="50" value="" placeholder="Add a comment"></textarea>
							<button id="add" type="submit">add</button>
					</div>	
			</div>
			<div class= "editEvent">
				<form id="editEventForm" method="post" enctype="multipart/form-data">
					<input type="text" value=<?php echo $event[0]['name'] ?>  placeholder="Name" id="name" name="name" required>	
					<input type="file" name="image" value=<?php echo $event[0]['image'] ?> id="image" >
					<input type="date" value=<?php echo $event[0]['eventDate'] ?> placeholder="Date" id="eventDate" name="eventDate" required>					
					<input type="time" value=<?php echo $event[0]['startHour'] ?> placeholder="Hour" id="startHour" name="startHour" required>
					<input type="text" value=<?php echo $event[0]['description']?> placeholder="Description" id="description" name="description" required>					
					<input type="text" value=<?php echo $event[0]['local'] ?> placeholder="Local" id="local" name="local" required>
					<input type="text" value=<?php echo $event[0]['partyType'] ?> placeholder="Party type eg: party" id="partyType" name="partyType" required>	
					<input type="radio"  value="public" name="type" id="typePublic" checked><label class="publicRB">public</label>
					<input type="radio" value="private"  name="type" id="typePrivate"><label class="privateRB">private</label>	
					<button id="save" type="submit">save</button>	
				</form>
				<button id="cancel" type="submit">cancel</button>
			</div>
				<div class="invite-list">
					<form id="inviteEventForm">
					<?php 
						foreach($inviteList as $inv){
							echo '<div class="hiddenDividUser">' . $inv['idUser'] . '</div>';			
							echo '<label class="username">' . $inv['username'] . '</label>';
							echo '<button id="inviteIcon"><i class="fa fa-user-plus"></i></button>';
						}
					?>
					<button id="invite" type="submit">invite</button>	
					</form>
				</div>
			</div>
		</body>
		<script src="../sweetalert-master/dist/sweetalert.min.js"></script> 
	</html>