<?php

include('connection.php');
session_start();

if(isset($_POST['delete_post_btn'])) 
{
    $post_id = $_POST['post_id'];
    $post_user_id = $_POST['user_id'];
    if (is_numeric(trim($post_id)) == false){
        header("location: index.php?error_message=error - post_id is not a number.");
        exit;
    }
    if (is_numeric(trim($post_user_id)) == false){
        header("location: index.php?error_message=error - post_id is not a number.");
        exit;
    }
    if($post_id > 100){
		header('location: index.php?error_message= max post_id is 100');
		exit;
	}
    
     //check user id from POST is the same as SESSION ID
     $post_user_id = $_POST['user_id'];
     $session_id = $_SESSION['id'];
     if ($session_id != $post_user_id)
     {
         header("location: index.php?error_message=error - user id from post(". $post_user_id .") and from session (".$session_id.")do not coincide.");
         exit;
     }


    try {
   
   //check in db if there is a post with the same user id from session
   try{
    $conn = connect_PDO();
    $stmt = $conn->prepare("SELECT id FROM posts WHERE user_id = ? AND id = ?");
    $stmt->bindParam(1, $session_id, PDO::PARAM_INT);
    $stmt->bindParam(2, $post_id, PDO::PARAM_INT);
    $stmt->execute();
    $post_from_db = $stmt->fetch(PDO::FETCH_ASSOC);
} catch (PDOException $error) {
    echo $error->getMessage(); 
    exit;
}

if ($post_from_db['id'] != $post_id)
{
    header("location: index.php?error_message=error - id from post(". $post_id .") and from db (".$post_from_db['id']."session id =".$session_id);
    exit;
}
   
   
   //DELETE POST
    $conn = connect_PDO();
    //GET THE PATH TO DELETE THE FILE
    $stmt = $conn->prepare("SELECT * FROM posts WHERE id = ?");
    $stmt->bindParam(1, $post_id, PDO::PARAM_INT);
    $stmt->execute();
    $img_info = $stmt->fetch();
    $img_path = $img_info['image'];
    } catch (PDOException $error) {
        echo $error->getMessage(); 
        exit;
    }
    unlink("assets/img/".$img_path);

    try {
    $stmt = $conn->prepare("DELETE FROM posts WHERE id = ?");
    $stmt->bindParam(1, $post_id, PDO::PARAM_INT);
    if($stmt->execute())
    {
        header("location: profile.php?success_message=Post deleted. Image:".$img_path.".");
    }
    else
    {
        header("location: profile.php?error_message=Could not delete post");
    }
    exit;
    }
    catch (PDOException $e) {
            echo $e->getMessage();
    }
}
else
{
    header("location: index.php");
    exit;
}

?>