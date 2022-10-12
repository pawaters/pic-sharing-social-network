<?php

session_start();

include_once('connection.php');

if(isset($_POST['login_btn']) && !empty($_POST['username']) && !empty($_POST['password'])) 
{
    $password = $_POST['password'];
    
    $username = htmlspecialchars($_POST['username']);
    if(preg_match("/[<>=\{\}'\/]/", $username)) 
    {
        header("location: login.php?error_message=Please enter valid username (no special characters)");
        exit; 
    }

    if(preg_match("/[<>=\{\}'\/]/", $password)) 
    {
        header("location: login.php?error_message=Please enter valid password (no special characters)");
        exit; 
    }
    

    if(strlen($username) > 20){
        header("location: login.php?error_message?error: username is too long or has special characters.");
        exit;

    }

    if(strlen($password) < 8){
		header('location: login.php?error_message=Password is shorter than 8 characters');
		exit;
	}

	if(strlen($password) > 20){
		header('location: login.php?error_message=Password too long, maximum 20 characters allowed.');
		exit;
	}

    try {
		$conn = connect_PDO();
		$stmt = $conn->prepare("SELECT password FROM users WHERE username = ?");
		$stmt->bindParam(1, $username, PDO::PARAM_STR);
		$stmt->execute();
		$password_hash = $stmt->fetchColumn();
	} catch (PDOException $error) {
		echo $error->getMessage(); 
		exit;
	}

    try {
        $conn = connect_PDO();
        $stmt = $conn->prepare("SELECT id, username, email, image, followers, following, posts, bio, verified, createdate, notify
                                FROM users
                                WHERE username = ? LIMIT 1");

        $stmt->bindParam(1, $username, PDO::PARAM_STR);
        $stmt->execute();

        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        $checked_password = password_verify($password, $password_hash);
    }
    catch (PDOException $e) {
            echo $e->getMessage();
    }

    if($data && $checked_password) 
    {
        $verified = $data['verified'];
        $createdate = date('d M Y', strtotime($data['createdate']));

        if ($verified == 0)
        {
            header('location: login.php?error_message=Please verify your username via the link sent to you on '.  $createdate . ', then login.');
            exit;
        } else {
        //now store values in SESSION
        $_SESSION['id'] =  $data['id'];
        $_SESSION['username'] =  $data['username'];
        $_SESSION['email'] =  $data['email'];
        $_SESSION['image'] =  $data['image'];
        $_SESSION['followers'] =  $data['followers'];
        $_SESSION['following'] =  $data['following'];
        $_SESSION['post'] =  $data['posts'];
        $_SESSION['bio'] =  $data['bio'];
        $_SESSION['verified'] =  $data['verified'];
        $_SESSION['notify'] =  $data['notify'];


        //take user to homepage
        header('location: index.php?success_message=Welcome back! you are now logged in.');
        }
    }
    else 
    {
    header('location: login.php?error_message=Username/password incorrect');
    exit;
    } 
} else {
    header('location: login.php?error_message=Error');
    exit;
}

?>