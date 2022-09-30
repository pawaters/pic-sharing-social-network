<?php

session_start();

include('connection.php');

//check the user came here the right way, ie: clicked on login btn
// if ok, take the info of the form (POST var) and save it in PHP vars

if(isset($_POST['login_btn'])) 
{
    $email = $_POST['email'];
    $password = md5($_POST['password']); 
    
    $conn = connect_PDO();
    $stmt = $conn->prepare("SELECT id, username, email, image, followers, following, posts, bio
                            FROM users
                            WHERE email = ? AND password = ? LIMIT 1");

    $stmt->bindParam(1, $email, PDO::PARAM_STR);
    $stmt->bindParam(2, $password, PDO::PARAM_STR);
    $stmt->execute();

    $data = $stmt->fetch(PDO::FETCH_ASSOC);

    if($data) 
    {
        if ($data['verified'] == 0)
        {
            header('location: login.php?error_message=Please verify your email via the link sent to you, then login.');
            exit;
        } else {
        //now store values in SESSION
        $_SESSION['id'] =  $data['id'];
        $_SESSION['username'] =  $data['username'];
        $_SESSION['email'] =  $data['email'];
        $_SESSION['image'] =  $data['image'];
        $_SESSION['followers'] =  $data['followers'];
        $_SESSION['following'] =  $data['following'];
        $_SESSION['post'] =  $data['post'];
        $_SESSION['bio'] =  $data['bio'];
        $_SESSION['verified'] =  $data['verified'];

        //take user to homepage
        header('location: index.php');
        }
    }
    else 
    {
    header('location: login.php?error_message=Email/password incorrect');
    exit;
    } 
} else {
    header('location: login.php?error_message=Error');
    exit;
}

?>