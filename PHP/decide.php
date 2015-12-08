<?php 
	
	session_start();
	 include_once('../PHP/process.php');
	 include_once('../PHP/getSet.php');
	 
	 $idUser = $_SESSION["idUser"];
	
	if ($_POST['option'] === "interesting") {
	 $eventsInteresting = userCanRegister($idUser);
		echo '<div class="event-block" id= "event-block">';
		echo '<div class="events-list-Interesting" id="events-list-Interesting">';
		echo '<label class="event-block-h3"> Interesting Events </label>';	
			foreach($eventsInteresting as $event){
				echo '<div class="events-card" >';
				echo '<div class="hiddenDiv">'. $event['idEvent'] . '</div>'; 
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
		echo '</div>';
	}
	else if ($_POST['option'] === "admin"){
	 $eventsAdmin = userEventsAdmin($idUser);
		echo '<div class="event-block" id= "event-block">';
		echo '<div class="events-list-Admin" id="events-list">';
		echo '<label class="event-block-h3"> Admin </label>';
			foreach($eventsAdmin as $event){
				echo '<div class="events-card">';
				echo '<div class="hiddenDiv">'. $event['idEvent'] . '</div>'; 
				echo '<h4 id="nameEvent">' . $event["name"] . '</h4>';
				echo '<p><i class="fa fa-location-arrow"></i>' . $event["local"] . '</p>';
				echo '<p><i class="fa fa-calendar"></i>'. ' ' . $event["eventDate"] . '  ' . '<i class="fa fa-clock-o"></i>' .' ' .$event["startHour"] . '</p>';
				if ($event["type"] === "private")
					echo '<label id="type"><i class="fa fa-lock fa-2x "></i></label>';
				else 
					echo '<label id="type"><i class="fa fa-unlock fa-2x"></i></label>';
				echo '<p>' . $event["description"] . '</p>';
				//echo '<img src=' . $event["image"] . '>';		
				echo '</div>';			
			}
			echo '</div>';
		echo '</div>';
	}
	else if  ($_POST['option'] === "attending"){
	 $eventsAttending = userEventsAttending($idUser);
		echo '<div class="event-block" id= "event-block">';
		echo '<div class="events-list-Attending" id="events-list-Attending">';
		echo '<label class="event-block-h3"> Attending </label>';
			foreach($eventsAttending as $event){
				echo '<div class="events-card">';
				echo '<div class="hiddenDiv">'. $event['idEvent'] . '</div>'; 
				echo '<h4 id="nameEvent">'. $event["name"] . '</h4>';
				echo '<p><i class="fa fa-location-arrow"></i> ' . $event["local"] . '</p>';
				echo '<p><i class="fa fa-calendar"></i>'. ' ' . $event["eventDate"] . '  ' . '<i class="fa fa-clock-o"></i>' .' ' .$event["startHour"] . '</p>';
				if ($event["type"] === "private")
					echo '<label id="type"><i class="fa fa-lock fa-2x "></i></label>';
				else 
					echo '<label id="type"><i class="fa fa-unlock fa-2x"></i></label>';
				echo '<p>' . $event["description"] . '</p>';
				//echo '<img src=' . $event["image"] . '>';
				echo '</div>';	
			}
		echo '</div>';
		echo '</div>';
	} else{
		$eventsInvited = getInvitedEvents($idUser);
		echo '<div class="event-block" id= "event-block">';
		echo '<div class="events-list-Invited" id="events-list-Invited">';
		echo '<label class="event-block-h3"> Invited </label>';
			foreach($eventsInvited as $event){
				echo '<div class="events-card">';
				echo '<div class="hiddenDiv">'. $event['idEvent'] . '</div>'; 
				echo '<h4 id="nameEvent">'. $event["name"] . '</h4>';
				echo '<p><i class="fa fa-location-arrow"></i> ' . $event["local"] . '</p>';
				echo '<p><i class="fa fa-calendar"></i>'. ' ' . $event["eventDate"] . '  ' . '<i class="fa fa-clock-o"></i>' .' ' .$event["startHour"] . '</p>';
				if ($event["type"] === "private")
					echo '<label id="type"><i class="fa fa-lock fa-2x "></i></label>';
				else 
					echo '<label id="type"><i class="fa fa-unlock fa-2x"></i></label>';
				echo '<p>' . $event["description"] . '</p>';
				//echo '<img src=' . $event["image"] . '>';
				echo '</div>';	
			}
		echo '</div>';
		echo '</div>';
		
	}
	
	

	
?>