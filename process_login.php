<?php

session_start();

include_once('connection.php');

if(isset($_POST['login_btn'])) 
{
    
    $password = md5($_POST['password']); 
    
    $emp_uname=trim($_POST["username"]);
    if(preg_match("/[<>=\{\}\/]/", $emp_uname)) 
    {
        header("location: edit_profile.php?error_message=Please enter valid username (no special characters)");
        exit; 
    }
    $username = htmlspecialchars($_POST['username']);

    try {
        $conn = connect_PDO();
        $stmt = $conn->prepare("SELECT id, username, email, image, followers, following, posts, bio, verified, createdate, notify
                                FROM users
                                WHERE username = ? AND password = ? LIMIT 1");

        $stmt->bindParam(1, $username, PDO::PARAM_STR);
        $stmt->bindParam(2, $password, PDO::PARAM_STR);
        $stmt->execute();

        $data = $stmt->fetch(PDO::FETCH_ASSOC);
    }
    catch (PDOException $e) {
            echo $e->getMessage();
    }

    if($data) 
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
        $_SESSION['username'] =  $data['username'];
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