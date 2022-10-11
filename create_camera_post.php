<?php

session_start();

require_once("connection.php");

// Check if user clicked the publish button
if(isset($_POST['webcam_img_btn'])){
	$id = $_SESSION['id'];
	$profile_image = $_SESSION['image']; 
	$caption = htmlspecialchars($_POST['caption']);
	$hashtags = htmlspecialchars($_POST['hashtags']);
	$likes = 0;
	$tz = 'Europe/Helsinki';
	$timestamp = time();
	$date = new DateTime("now", new DateTimeZone($tz));
	$date->setTimestamp($timestamp);
	$date = $date->format('Y-m-d H:i:s');
	$username = $_SESSION['username'];
	$webcam = true;

	// Create a unique image name by using strval function that converts the timestamp into a string
	$image_name = strval(time()) . ".jpg";

	// Grab the photo with the stickers
	if (!isset($_POST['webcam_file']) || empty($_POST['webcam_file'])){
		header("location: camera.php?error_message=Please enter a valid image (webcam file is empty)");
        exit; 
	}

	$webcam_file = $_POST['webcam_file'];
	
	list($type, $data_url) = explode(';', $webcam_file);
	list(, $data_url) = explode(',', $data_url); 
	$decoded_url = base64_decode($data_url);
	$destination = imagecreatefromstring($decoded_url);

	if (!isset($_POST['sticker-canvas']) || empty($_POST['sticker-canvas'])){
		header("location: camera.php?error_message=error - stickers not set ");
        exit; 
	}
	$stickers_canvas = $_POST['sticker-canvas'];
	list($type, $data) = explode(';', $stickers_canvas);
	list(, $data) = explode(',', $data); 
	$decoded_stickers_url = base64_decode($data);
	$dest = imagecreatefromstring($decoded_stickers_url);

	imagecopy($destination, $dest, 0, 0, 0, 0, 700, 500);

	//server-side form validation

	$emp_caption=trim($caption);
	$emp_hash=trim($hashtags);

    if($emp_caption == "")
    {
        header("location: camera.php?error_message=Please enter a caption");
        exit; 
    } 
	if($emp_hash == "")
    {
        header("location: camera.php?error_message=Please enter a hashtag");
        exit; 
    } 
    if(preg_match("/[<>=\{\}\/]/", $emp_caption)) 
    {
        header("location: camera.php?error_message=Please enter valid caption (no special characters)");
        exit; 
    }
	if(preg_match("/[<>=\{\}\/]/", $emp_hash)) 
    {
        header("location: camera.php?error_message=Please enter valid hashtag (no special characters)");
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
			imagepng($destination, "assets/img/".$image_name);
			
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
	
			$_SESSION['post'] = $_SESSION['post']+1;
	
			header('location: camera.php?success_message=Post created&image_name='.$image_name);
			exit;
		}else{
			header('location: camera.php?error_message=Error occured.');
			exit;
		}
	} catch (PDOException $error) {
		echo $error->getMessage(); 
		exit;
	}
	$conn = null;

	if(strlen($caption) > 300 || strlen($hashtags) > 100){
		header('location: camera.php?error_message=Caption or hashtags too long.');
		exit;
	}
	
}else{
	header('location: camera.php?error_message=Error occured.');
	exit;
}

?>