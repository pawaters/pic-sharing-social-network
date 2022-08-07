<?php

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
    $stmt->store_result();

    if($stmt->num_rows() > 0)
    {
        header("location: signup.php?error_message=User already exists");
        exit;
    }
    else
    {
        $stmt =  $conn->prepare(
            "INSERT INTO users (username,email,password)"
    }
}
else
{


}

?>