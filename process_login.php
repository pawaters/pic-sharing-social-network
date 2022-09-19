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
                            WHERE email = ? AND password = ?");

    $stmt->bindParam(1, $email, PDO::PARAM_STR);
    $stmt->bindParam(2, $password, PDO::PARAM_STR);
    $stmt->execute();
    // store result locally
    //$stmt->store_result();
    $data = $stmt->fetch(PDO::FETCH_ASSOC);
    // with if num rows, check if there is an existing user
    if($data) 
    {
        //bind_result is use to bind columns of a result to variables
        //after that, fetch is used to get the values without iteration
        // $stmt->bind_result($id, $username, $email, $image, $followers, $following, $post, $bio);
        // $stmt->fetch();
        
        //now store values in SESSION
        $_SESSION['id'] =  $data['id'];
        $_SESSION['username'] =  $data['username'];
        $_SESSION['email'] =  $data['email'];
        $_SESSION['image'] =  $data['image'];
        $_SESSION['followers'] =  $data['followers'];
        $_SESSION['following'] =  $data['following'];
        $_SESSION['post'] =  $data['post'];
        $_SESSION['bio'] =  $data['bio'];

        //take user to homepage
        header('location: index.php');
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