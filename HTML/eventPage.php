<?php
	 include_once('../PHP/process.php');
	 include_once('../PHP/getSet.php');
	 $userName = getUserName($_GET['idUser']);
	 $event = getEvent($_GET['idEvent']);
	 $eventHost = getUserName(getEventHost($_GET['idEvent'])[0]['idUser']);
	  if (count (getAttendState($_GET['idEvent'],$_GET['idUser'])) === 0) {
		 $eventAttend = "";
	  } else   $eventAttend = getAttendState($_GET['idEvent'],$_GET['idUser'])[0]['attend'];
	  
	 $goingList = getAllGoingEvent($_GET['idEvent']);
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
			<div class= "image-block">
				<h1><?php echo $event[0]['name'] ?></h1>
				<div id= "type-host-attend">
					<?php 
						echo '<h4>' . $event[0]['type'] . '</h4>';
						echo '<h4>' . ' Hosted by '. $eventHost[0]['name'] . '</h4>';
						echo '<h4>' . $eventAttend . '</h4>';
						
					?>
				</div>
				<div id= "event-info">
					<?php
						echo '<p>' . $event[0]['eventDate'] . '</p>';
						echo '<p>' . $event[0]['startHour'] . '</p>';
						echo '<p>' . $event[0]['local'] . '</p>';
						echo '<p>' . $event[0]['partyType'] . '<p>';
						echo '<p>' . $event[0]['description'] . '</p>';
					?>
				</div>
				<div id="Going-list">
					<?php
						foreach($goingList as $gl){
							echo '<p>' . $gl[0]['name'] . '</p>';
						} 
					?>
				</div>
				<div class= "comments">
				</div>				
			</div>
			<div class= "editEvent">
				<form id="editEventForm" enctype="multipart/form-data">
					<input type="text" value=<?php echo $event[0]['name'] ?> placeholder="Name" id="name" required>					
					<input type="file" name="fileToUpload" value=<?php echo $event[0]['image'] ?> placeholder="file" id="image">
					<input type="date" value=<?php echo $event[0]['eventDate'] ?> placeholder="Date" id="eventDate" required>					
					<input type="time" value=<?php echo $event[0]['startHour'] ?> placeholder="Hour" id="startHour" required>
					<input type="text" value=<?php echo $event[0]['description']?> placeholder="Description" id="description">					
					<input type="text" value=<?php echo $event[0]['local'] ?> placeholder="Local" id="local" required>
					<input type="text" value=<?php echo $event[0]['partyType'] ?> placeholder="Party type eg: party" id="partyType" required>
					<input type="file" name="fileToUpload" id="fileToUpload">
    				<input type="submit" value="Upload Image" name="submit">	
					<input type="radio"  value="public" name="type" id="typePublic" checked>public
					<input type="radio" value="private"  name="type" id="typePrivate">private	
					<button id="edit" type="submit">save</button>	
				</form>
				<button id="cancel" type="submit">cancel</button>
			</div>
		</body>
	</html>