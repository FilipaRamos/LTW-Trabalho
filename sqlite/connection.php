<?php

	/**************************************/
	/********  OPEN DATABASE.SQL **********/
	/**************************************/

	$file = new PDO('sqlite:database.sql');
	// SET ERRORMODE TO EXCEPTIONS
	$file->setAttribute(PDO::ATTR_ERRMODE, 
                            PDO::ERRMODE_EXCEPTION);

	

	/****************************************/
	/************ INSERT INTO ***************/
	/****************************************/

	$insert = "INSERT INTO messages (title, message, time) 
                VALUES (:title, :message, :time)";
    $stmt = $file->prepare($insert);

   	

?>