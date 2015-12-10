<?php
session_start();
include_once('process.php');
include_once('getSet.php');

$target_dir = "static/event/".$_SESSION['idUser'].'/';
if(!is_dir($target_dir)){
    mkdir($target_dir,0777,true);
}

if(basename($_FILES["image"]["name"]) !== ""){
$target_file = $target_dir . basename($_FILES["image"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image_type_to_extension
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if($check !== false) {
        echo json_encode("File is an image - " . $check["mime"] . ".");
        $uploadOk = 1;
    } else {
        echo json_encode("File is not an image.");
        $uploadOk = 0;
    }
}
if ($_FILES["image"]["size"] > 500000) {
    echo json_encode("Sorry, your file is too large.");
    $uploadOk = 0;
}

if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
    echo json_encode("Sorry, only JPG, JPEG, PNG & GIF files are allowed.");
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo json_encode("Sorry, your file was not uploaded.");
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
        //echo "The file ". basename( $_FILES["image"]["name"]). " has been uploaded.";
    } else {
        echo json_encode("Sorry, there was an error uploading your file.");
    }
}
$photoId=1;
if($uploadOk==1)
    $photoId=htmlspecialchars($target_file);
} 
else  $photoId = ""; 
   
if (isset($_POST["name"],$_POST["description"],$_POST["eventDate"],$_POST["startHour"],$_POST["local"],$_POST["partyType"],$_POST["type"])) {
	$newname=$_POST["name"];
	$newdescription=$_POST["description"];
	$eventDate=$_POST["eventDate"];
    $hour=$_POST["startHour"];
	$newlocal=$_POST["local"];
	$newpartyType=$_POST["partyType"];
	$newType=$_POST["type"];
	
    $newFormat_creationDate = date('Y-m-d', strtotime($eventDate));
    $newstartHour = date('H:m:s', strtotime($hour));
    
	//$id=createEvent($_SESSION['idUser'],$name, $photoId, $newFormat_creationDate, $new_Hours, $description, $local, $partyType, $type);
     
      editEvent($_POST["idEvent"], $newname, $photoId, $newFormat_creationDate, $newstartHour, $newdescription, $newlocal, $newpartyType, $newType);  
      echo json_encode("success");
}else{ 
    echo json_encode("error");
}
?>