<?php

	/**************************************/
	/********  OPEN DATABASE.SQL **********/
	/**************************************/

	try{
	$file = new PDO('sqlite:database.sql');
	// SET ERRORMODE TO EXCEPTIONS
	$file->setAttribute(PDO::ATTR_ERRMODE, 
                            PDO::ERRMODE_EXCEPTION);
	} catch(PDOException $e){
		die($e->getMessage());
	}

?>