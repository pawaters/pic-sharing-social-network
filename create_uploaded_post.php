<?php

session_start();

require_once("connection.php");

if(isset($_POST['upload_img_btn'])){
	$id = $_SESSION['id'];
	$profile_image = $_SESSION['image']; 
	if($_FILES['image']['size'] == 0 || $_FILES['image']['tmp_name'] == null) 
	{
		header("location: upload.php?error_message=No image was selected for upload");
    	exit;
	}
	$valid_file_size = 3*1024*1024;
	$file_size = $_FILES['image']['size'];
	$image = $_FILES['image']['tmp_name'];

	$file_type = $_FILES['image']['type'];
	if($file_type != 'image/png' && $file_type != 'image/jpeg')
    {
        header('location: upload.php?error_message=File must be png or jpeg.');
		exit;
    }
	$ext = pathinfo($image, PATHINFO_EXTENSION);
	if($ext != "png" && $ext != "jpeg") 
	{
        header('location: upload.php?error_message=File must be png or jpeg.');
		exit;
    }
	if($file_size > $valid_file_size)
	{
		header('location: upload.php?error_message=File size must not be more that 3Mb.');
		exit;
	}

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

	$upload_file = $_POST['upload_file'];
	if($upload_file){
		list($type, $data_url) = explode(';', $upload_file);
		list(, $data_url) = explode(',', $data_url); 
		$decoded_url = base64_decode($data_url);
		$dest = imagecreatefromstring($decoded_url);
		imagecopy($destination, $dest, 0, 0, 25, 30, 700, 500);
	}
	//server-side form validation
	if(strlen($caption) > 200 || strlen($hashtags) > 50){
		header('location: upload.php?error_message=Caption or hashtags too long.');
		exit;
	}
	
	$emp_caption=trim($caption);
	$emp_hash=trim($hashtags);

    if($emp_caption == "")
    {
        header("location: upload.php?error_message=Please enter a caption");
        exit; 
    } 
	if($emp_hash == "")
    {
        header("location: upload.php?error_message=Please enter a hashtag");
        exit; 
    } 
    if(preg_match("/[<>=\{\}'\/]/", $emp_caption)) 
    {
        header("location: upload.php?error_message=Please enter valid caption (no special characters)");
        exit; 
    }
	if(preg_match("/[<>=\{\}'\/]/", $emp_hash)) 
    {
        header("location: upload.php?error_message=Please enter valid hashtag (no special characters)");
        exit; 
    }

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
	
			header('location: upload.php?success_message=Post created&image_name='.$image_name);
			exit;
		}else{
			header('location: upload.php?error_message=Error.');
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