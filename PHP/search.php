<?php 
	session_start();

	include_once('process.php');

	$res = searchEvent($_POST['text']);

	echo '<div class="event-block" id= "event-block">';
	echo '<div class="events-list-Interesting" id="events-list-Interesting">';			
	echo '<label class="event-block-h3"> Searched Events </label>';	
			foreach($res as $event){
				echo '<div class="hiddenDiv">'. $event['idEvent'] . '</div>'; 
				echo '<div class="events-card" >';
				echo '<h4>' . $event["name"] . '</h4>';
				echo '<p><i class="fa fa-location-arrow"></i>' . $event["local"] . '</p>';
				echo '<p><i class="fa fa-calendar"></i>'. ' ' . $event["eventDate"] . '  ' . '<i class="fa fa-clock-o"></i>' .' ' .$event["startHour"] . '</p>';
				echo '<p>' . $event["type"] . '</p>';
				echo '<p>' . $event["description"] . '</p>';	
				echo '</div>';			
			}
		echo '</div>';
	echo '</div>';

					
?>