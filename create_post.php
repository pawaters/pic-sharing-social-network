<?php


session_start();

include("connection.php");
include("sticker.php");

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
        header("location: upload.php?error_message=caption/text is too long");
        exit;
    }

  
    $image_name = strval(time()) . ".jpeg";
    stamp_to_img($image);

    try {
        $conn = connect_PDO();
        $stmt = $conn->prepare("INSERT INTO posts (user_id,likes,image,caption,hashtags,date,username,profile_image)
                                VALUES (?,?,?,?,?,?,?,?)");
        $stmt->bindParam(1, $id, PDO::PARAM_INT);
        $stmt->bindParam(2, $likes, PDO::PARAM_INT);
        $stmt->bindParam(3, $image_name, PDO::PARAM_STR);
        $stmt->bindParam(4, $caption, PDO::PARAM_STR);
        $stmt->bindParam(5, $hashtags, PDO::PARAM_STR);
        $stmt->bindParam(6, $date, PDO::PARAM_STR);
        $stmt->bindParam(7, $username, PDO::PARAM_STR);
        $stmt->bindParam(8, $profile_image, PDO::PARAM_STR);

        $stmt->execute();

            
        //store image in folder
        move_uploaded_file($image,"assets/img/".$image_name);
        
        //increase number of posts
        $stmt= $conn->prepare("UPDATE users SET posts=posts+1 WHERE id = ?");
        // $stmt->bind_param("i",$id);
        $stmt->bindParam(1, $id, PDO::PARAM_INT);
        $stmt->execute();

        $_SESSION['posts'] = $_SESSION['posts'] + 1;
        

        header("location: upload.php?success_message=Post has been created successfully&image_name=".$image_name);
        exit;

    }
    catch (PDOException $e) {
        echo $e->getMessage();
    }
    

}else{

    header("location: upload.php?error_message=error occured, try again");
    exit;


}



?>