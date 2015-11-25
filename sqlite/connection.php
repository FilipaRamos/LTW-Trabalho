<?php

	/**************************************/
	/********  OPEN DATABASE.DB **********/
	/**************************************/
	
	function load(){
		$file = new PDO('sqlite:database.db');
	}
?>