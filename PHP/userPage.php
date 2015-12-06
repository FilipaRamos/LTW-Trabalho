<?php
session_start();
include_once('process.php');
include_once('getSet.php');
$target_dir = "static/event/".$_SESSION['idUser'].'/';
if(!is_dir($target_dir)){
    mkdir($target_dir,0777,true);
}
$target_file = $target_dir . basename($_FILES["image"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}
if ($_FILES["image"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
        //echo "The file ". basename( $_FILES["image"]["name"]). " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
$photoId=1;
if($uploadOk==1)
    $photoId=htmlspecialchars($target_file);
if (isset($_POST["name"],$_POST["description"],$_POST["eventDate"],$_POST["startHour"],$_POST["local"],$_POST["partyType"],$_POST["type"])) {
	$nameEvent=$_POST["name"];
	$description=$_POST["description"];
	$creationDate=$_POST["eventDate"];
    $hour=$_POST["startHour"];
	$local=$_POST["local"];
	$type=$_POST["partyType"];
	$public=$_POST["type"];
	
	if($public=="public"){
		$public=true;
	}else{
		$public=false;
	}
	$newFormat_creationDate = date('Y-m-d', strtotime($creationDate));
    
	$id=createEvent($_SESSION['idUser'],$nameEvent, $photoId, $newFormat_creationDate, $hour, $description, $local, $type, $public);
    
    header("Location:event.php?idEvent=".$id);
}else{ 
    echo "error";
}
?>