<?php

include('connection.php');

//check the user came here the right way, ie: clicked on login btn
// if ok, take the info of the form (POST var) and save it in PHP vars

if(isset($_POST['login_btn'])) 
{
    $email = $_POST['email'];
    $password = md5($_POST['password']); 
    
    //now use SQL to get all data if login is successful
    //prepare the statement (prepared statements protect from injections)
    $stmt = $conn->prepare("SELECT id, username, email, image, followers, following, posts
                            FROM users
                            WHERE email = ? AND password = ?");
    //bind_param clarifies what to put for ?
    $stmt->bind_param("ss", $email, $password);
    $stmt->execute();
    // store result locally
    $stmt->store_result();

    // with if num rows, check if there is an existing user
    if($stmt->num_rows() > 0) 
    {
        //bind_result is use to bind columns of a result to variables
        //after that, fetch is used to get the values without iteration
        $stmt->bind_result($id, $username, $email, $image, $followers, $following, $post);
        $stmt->fetch();
        
        //now store values in SESSION
        $_SESSION['id'] =  $id;
        $_SESSION['username'] =  $username;
        $_SESSION['email'] =  $email;
        $_SESSION['image'] =  $image;
        $_SESSION['followers'] =  $followers;
        $_SESSION['following'] =  $following;
        $_SESSION['post'] =  $post;

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