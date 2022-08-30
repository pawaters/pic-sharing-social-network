<?php

session_start();

include('connection.php');

if(isset($_POST['signup_btn']))
{
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $password_confirm = $_POST['password_confirm'];

    if ($password != $password_confirm)
    {
        header('location: signup.php?error_message=passwords do not match');
        exit;
    }

    $stmt = $conn->prepare(
    "SELECT id 
    FROM users 
    WHERE username = ? OR email = ?");
    
    $stmt->bind_param("ss", $username, $email);
    $stmt->execute();
    //store_result : downloads all rows and when you fetch first row. 
    //next fetch() calls will iterate without having to call a loop.
    $stmt->store_result();

    if($stmt->num_rows() > 0)
    {
        header("location: signup.php?error_message=User already exists");
        exit;
    }
    else
    {
        $stmt =  $conn->prepare(
            "INSERT INTO users (username,email,password) 
            VALUES (?,?,?)");
        $stmt->bind_param("sss", $username, $email, md5($password));
        
        //if user created successfully, return user info
        if ($stmt->execute())
        {
            //select from database the lines that match, the following info
            $stmt = $conn->prepare("SELECT id, username, email, image, following, followers, posts, bio
            FROM users 
            WHERE username = ?");
            //obligatory when using prepare, define var names for each var
            $stmt->bind_param("s", $username);
            //obligatory to run it
            $stmt->execute();
            //now we have the data as PHP array stored in my SQL, lets save each as a variable in PHP
            $stmt->bind_result($id, $username, $email, $image, $following, $followers, $posts, $bio);
            //fetch() stores the result (no need to iterate thanks to previous store_result)
            $stmt->fetch();
            
            //store user info in the session
            $_SESSION['id'] = $id;
            $_SESSION['username'] = $username;
            $_SESSION['email'] = $email;
            $_SESSION['image'] = $image;
            $_SESSION['following'] = $following;
            $_SESSION['followers'] = $followers;
            $_SESSION['posts'] = $posts;
            $_SESSION['bio'] = $bio;


            //return to homepage
            header("location: index.php");
            
        }
        else
        {
            header("location: signup.php?error_message=error occurred");
            exit;
        }
    }
}
else
{
    header("location: signup.php?error_message=error occurred");

}

?>