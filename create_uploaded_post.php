<?php

session_start();

require_once("connection.php");

// Check if user clicked the publish button
if(isset($_POST['upload_img_btn'])){
	$id = $_SESSION['id'];
	$profile_image = $_SESSION['image']; 
	if($_FILES['image']['size'] == 0) 
	{
		// No file was selected for upload
		header("location: signup.php?error_message=No image was selected for upload");
    	exit;
	}
	$image = $_FILES['image']['tmp_name'];
	$caption = $_POST['caption'];
	$hashtags = $_POST['hashtags'];
	$likes = 0;
	$tz = 'Europe/Helsinki';
	$timestamp = time();
	$date = new DateTime("now", new DateTimeZone($tz));
	$date->setTimestamp($timestamp);
	$date = $date->format('Y-m-d H:i:s');
	$username = $_SESSION['username'];
	$webcam = false;
	$image_name = strval(time()) . ".jpg";

	$max_height = 500;
	$max_width = 500;


	list($orig_width, $orig_height) = getimagesize($image);
	if ($orig_width > $max_width || $orig_height > $max_height) {
		$ratio = $orig_width/$orig_height;
		if($ratio > 1) {
			$width = $max_width;
			$height = $max_height/$ratio;
		} else {
			$width = $max_width*$ratio;
			$height = $max_height;
		}
	  $source = imagecreatefromstring(file_get_contents($image));
	  $destination = imagecreatetruecolor($width, $height);
	  imagecopyresampled($destination, $source, 0, 0, 0, 0, $width, $height, $orig_width, $orig_height);
	}

	// Grab the stickers, if no stickers selected by user, this if statement will be skipped
	$upload_file = $_POST['upload_file'];
	if($upload_file){
		list($type, $data_url) = explode(';', $upload_file);
		list(, $data_url) = explode(',', $data_url); 
		//$data_url = explode(',', $upload_file);
		$decoded_url = base64_decode($data_url);
		$dest = imagecreatefromstring($decoded_url);
		// $src = imagecreatefromstring(file_get_contents($image));
		imagecopy($destination, $dest, 0, 0, 25, 30, 700, 500);
	}

/* 	header('Content-Type: image/png');
	imagepng($src); */

	if(strlen($caption) > 300 || strlen($hashtags) > 100){
		header('location: upload.php?error_message=Caption or hashtags too long.');
		exit;
	}
	
	// Create post
	try {
		$conn = connect_PDO();
		$stmt = $conn->prepare("INSERT INTO posts (user_id,likes,image,caption,hashtags,date,username,profile_image,webcam) VALUES (?,?,?,?,?,?,?,?,?)");
		$stmt->bindParam(1, $id, PDO::PARAM_INT);
		$stmt->bindParam(2, $likes, PDO::PARAM_INT);
		$stmt->bindParam(3, $image_name, PDO::PARAM_STR);
		$stmt->bindParam(4, $caption, PDO::PARAM_STR);
		$stmt->bindParam(5, $hashtags, PDO::PARAM_STR);
		$stmt->bindParam(6, $date, PDO::PARAM_STR);
		$stmt->bindParam(7, $username, PDO::PARAM_STR);
		$stmt->bindParam(8, $profile_image, PDO::PARAM_STR);
		$stmt->bindParam(9, $webcam, PDO::PARAM_STR);
		if($stmt->execute()){
			// do we stil use this $src?
            if($src){
				imagepng($src, "assets/img/".$image_name); //Store image in folder
			} else {
				imagepng($destination, "assets/img/".$image_name);
			}
			
			//increase the number of posts and update session with the new number of posts
			try {
				$conn = connect_PDO();
				$stmt = $conn->prepare("UPDATE users SET posts = posts+1 WHERE id = ?");
				$stmt->bindParam(1, $id, PDO::PARAM_INT);
				$stmt->execute();
			} catch (PDOException $error) {
				echo $error->getMessage(); 
				exit;
			}
			$conn = null;

			$_SESSION['posts'] = $_SESSION['posts']+1;
	
			header('location: upload.php?success_message=Post created&image_name='.$image_name);
			exit;
		}else{
			header('location: upload.php?error_message=Error occured.');
			exit;
		}
	} catch (PDOException $error) {
		echo $error->getMessage(); 
		exit;
	}
	$conn = null;
}else{
	header('location: upload.php?error_message=Error occured.');
	exit;
}

?>