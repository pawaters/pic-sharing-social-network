<?php

session_start();

include("connection.php");

if (isset($_POST['upload_image_btn'])){

    $id = $_SESSION['id']; //id is unchageable for user
    $username = $_SESSION['username'];
    $profile_image = $_SESSION['image'];
    $caption = $_POST['caption'];
    $hashtags = $_POST['hastags'];
    $image = $_FILES['image']['tmp_name'];
    //check if image is empty
    $image_name = strval(time()) . ".jpeg";
    $date = date("Y-m-d H:i:s");
    
}
    
    // create the post
    $stmt = $conn->prepare("INSERT INTO posts (user_id, likes, image, caption, hashtags, date, username, profile_image)
                            VALUES (?,?,?,?,?,?,?,?)");
    //bind_param clarifies what to put for ?
    $stmt->bind_param("iissssss", $id, $likes, $image, $caption, $hashtags, $date, $username, $profile_image);
    
    if ($stmt->execute()){
        move_uploaded_file($image, "assets/img/" . $image_name);
        
        header("location: camera.php?success_message=Post updated&image_name=".$image_name);
        exit;

    } else {
        header("location: camera.php?error_message=error");
        exit;
    };

} else {
    header("location: index.php?error_message=error");
    exit;
}
?>