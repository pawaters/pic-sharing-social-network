<?php


session_start();

include("connection.php");

if(isset($_POST['upload_image_btn'])){

    $id = $_SESSION['id'];
    $username = $_SESSION['username'];
    $profile_image = $_SESSION['image'];
    $caption = $_POST['caption'];
    $hashtags = $_POST['hashtags'];
    $image = $_FILES['image']['tmp_name'];  //file
    $likes = 0;
    $date = date("Y-m-d H:i:s");

    if(strlen($caption) > 200 || strlen($hashtags) > 200){
        header("location: camera.php?error_message=caption/text is too long");
        exit;
    }

  
    $image_name = strval(time()) . ".jpeg"; //5654564545.jpeg
  

    //create the post
    $stmt = $conn->prepare("INSERT INTO posts (user_id,likes,image,caption,hashtags,date,username,profile_image)
                            VALUES (?,?,?,?,?,?,?,?)");
    $stmt->bind_param("iissssss",$id,$likes,$image_name,$caption,$hashtags,$date,$username,$profile_image);

    if($stmt->execute()){

        
        //store image in folder
        move_uploaded_file($image,"assets/img/".$image_name);
       
        //increase number of posts
        $stmt= $conn->prepare("UPDATE users SET posts=posts+1 WHERE id = ?");
        $stmt->bind_param("i",$id);
        $stmt->execute();

        $_SESSION['posts'] = $_SESSION['posts'] + 1;
        

        header("location: camera.php?success_message=Post has been created successfully&image_name=".$image_name);
        exit;

    }else{
        header("location: camera.php?error_message=error occured, try again");
        exit;

    }


    




}else{

    header("location: camera.php?error_message=error occured, try again");
    exit;


}




?>