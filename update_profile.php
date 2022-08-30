<?php

session_start();

include("connection.php");

if (isset($_POST['update_profile_btn'])){

    $id = $_SESSION['id']; //id is unchageable for user
    $username = $_POST['username'];
    $bio = $_POST['bio'];
    $image = $_FILES['image']['tmp_name'];
    //check if image is empty
    if($image != ""){
        $image_name = $username . ".jpeg";
    } else {
        $image_name = $SESSION['image'];
    }
}
    


    //ensure username is unique
    if($username != $_SESSION['username'])
    {
        $stmt = $conn->prepare("SELECT username
                                FROM users
                                WHERE username = ?");
        //bind_param clarifies what to put for ?
        $stmt->bind_param("s", $username);
        $stmt->execute();
        // store result locally
        $stmt->store_result();

        // with if num rows, check if there is an existing user
        if($stmt->num_rows() > 0) 
        {
            header("location: edit_profile.php?error_message=username was already taken");
            exit;
        }
        else
        {
        // update info, not insert or select
        $stmt = $conn->prepare("UPDATE users 
                                SET username = ?, bio = ?, image = ?
                                WHERE id = ?");
        //bind_param clarifies what to put for ?
        $stmt->bind_param("sssi", $username, $bio, $image_name, $id);
        
        if ($stmt->execute()){

            if ($image != ""){
                move_uploaded_file($image, "assets/img/" . $image_name);
            }
            
            //update session
            $_SESSION['username'] = $username;
            $_SESSION['bio'] = $bio;
            $_SESSION['image'] = $image;
            
            header("location: profile.php?success_message=Profile updated");
            exit;
        } else {
            header("location: edit_profile.php?error_message=error");
            exit;
        };
        
        }

    } else {
        header("location: index.php?error_message=error");
        exit;
    }
?>