<?php

session_start();

include("connection.php");

if(isset($_POST['signup_btn']))
{
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $password_confirm = $_POST['password_confirm'];
    $vkey = md5(time().$username);

    if ($password != $password_confirm)
    {
        header('location: signup.php?error_message=passwords do not match');
        exit;
    }
    
    $conn = connect_PDO();
    $stmt = $conn->prepare( "SELECT id FROM users WHERE username = ? OR email = ?");
    
    $stmt->bindParam(1, $username, PDO::PARAM_STR);
    $stmt->bindParam(2, $email, PDO::PARAM_STR);
    $stmt->execute();
    $data = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if($data) 
    {
        header("location: signup.php?error_message=User already exists");
        exit;
    }
    else
    {
        try 
        {
            $stmt =  $conn->prepare(
                "INSERT INTO users (username, email, password, vkey) 
                VALUES (? ,? ,? ,?)");
            $stmt->bindParam(1, $username, PDO::PARAM_STR);
            $stmt->bindParam(2, $email, PDO::PARAM_STR);
            $stmt->bindParam(3, md5($password), PDO::PARAM_STR);
            $stmt->bindParam(4, $vkey, PDO::PARAM_STR);
            $stmt->execute();
        } 
        catch (PDOException $error) {
            echo $error->getMessage(); 
            exit;
        }
        
        try 
        {
            $stmt = $conn->prepare("SELECT id, username, email, image, following, followers, posts, bio
                                    FROM users 
                                    WHERE username = ?");
            $stmt->bindParam(1, $username, PDO::PARAM_STR);
            $stmt->execute();
            $data = $stmt->fetch(PDO::FETCH_ASSOC);
            
            $_SESSION['id'] =  $data['id'];
            $_SESSION['username'] =  $data['username'];
            $_SESSION['email'] =  $data['email'];
            $_SESSION['image'] =  $data['image'];
            $_SESSION['followers'] =  $data['followers'];
            $_SESSION['following'] =  $data['following'];
            $_SESSION['post'] =  $data['post'];
            $_SESSION['bio'] =  $data['bio'];


            //return to homepage
            header("location: index.php");
            
        }
        catch (PDOException $error) 
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