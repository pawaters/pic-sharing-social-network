<?php

include("connection.php");

if(isset($_POST['update_comment_btn'])){

    $comment_id = htmlspecialchars($_POST['comment_id']);
    $post_id = htmlspecialchars($_POST['post_id']);
    if (is_numeric(trim($comment_id)) == false){
        header("location: index.php?error_message=error - comment_id is not a number.");
        exit;
    }
    if (is_numeric(trim($post_id)) == false){
        header("location: index.php?error_message=error - post_id is not a number.");
        exit;
    }
    if($comment_id > 1000 || $post_id > 100){
		header('location: index.php?error_message= max post_id is 100, max comment_id is 1000.');
		exit;
	}
    $comment_text = $_POST['comment_text'];
    $emp_comment =trim($_POST['comment_text']);
    if($emp_comment == "")
    {
        header("location: index.php?error_message=Please enter a comment");
        exit; 
    } 
    if(preg_match("/[<>=\{\}'\/]/", $emp_comment)) 
    {
        header("location: index.php?error_message=Please enter valid comment (no special characters)");
        exit; 
    }

    if(strlen($comment_text) > 200){
        header("location: single_post.php?post_id=".$post_id."&error_message?comment is too long");
        exit;

    }
        try {
            $conn = connect_PDO();
            $stmt = $conn->prepare("UPDATE comments SET comment_text = ?  WHERE id = ?");
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
