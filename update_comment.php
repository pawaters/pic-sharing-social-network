<?php

include("connection.php");

if(isset($_POST['update_comment_btn'])){


    $comment_id = $_POST['comment_id'];
    $comment_text = $_POST['comment_text'];
    $post_id = $_POST['post_id'];

    if(strlen($comment_text) > 200){
        header("location: single_post.php?post_id=".$post_id."&error_message?comment is too long");
        exit;

    }
        try {
            $conn = connect_PDO();
            $stmt = $conn->prepare("UPDATE comments SET comment_text = ?  WHERE id = ?");
            // $stmt->bind_param("si",$comment_text,$comment_id);
            $stmt->bindParam(1, $comment_text, PDO::PARAM_STR);
            $stmt->bindParam(2, $comment_id, PDO::PARAM_INT);

            if($stmt->execute()){

            
                header("location: single_post.php?post_id=".$post_id."&success_message?Post has been updated successfully");
                exit;

            }else{
                header("location: single_post.php?post_id=".$post_id."&error_message?error occured, try again");
                exit;

            }
        }
        catch (PDOException $e) {
                echo $e->getMessage();
        }

    




}else{

    header("location: index.php");
    exit;


}
