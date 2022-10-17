<?php

session_start();
include('connection.php');


if(isset($_POST['delete_comment_btn']) && !empty($_POST['comment_id']) && !empty($_POST['post_id'])){

    $comment_id = $_POST['comment_id'];
    $post_id = $_POST['post_id'];
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

    //check user id from POST is the same as SESSION ID
    $post_user_id = $_POST['user_id'];
	$session_id = $_SESSION['id'];
    if ($session_id != $post_user_id)
    {
        header("location: index.php?error_message=error - user id from post(". $post_user_id .") and from session (".$session_id.")do not coincide.");
        exit;
    }

    //check in db if there is a comment with the same user id from session
    try{
		$conn = connect_PDO();
		$stmt = $conn->prepare("SELECT id FROM comments WHERE user_id = ? AND id = ?");
		$stmt->bindParam(1, $session_id, PDO::PARAM_INT);
		$stmt->bindParam(2, $comment_id, PDO::PARAM_INT);
		$stmt->execute();
		$comment_from_db = $stmt->fetch(PDO::FETCH_ASSOC);
	} catch (PDOException $error) {
		echo $error->getMessage(); 
		exit;
	}

    if ($comment_from_db['id'] != $comment_id)
    {
        header("location: index.php?error_message=error - comment id from post(". $comment_id .") and from db (".$comment_from_db['id']."session id =".$session_id);
        exit;
    }

    //delete comment
    try {
        $conn = connect_PDO();
        $stmt = $conn->prepare("DELETE FROM comments WHERE id = ?");
        $stmt->bindParam(1, $comment_id, PDO::PARAM_INT);

        if($stmt->execute()){
            header("location: single_post.php?post_id=".$post_id."&success_message=Comment deleted successfully");
            exit;
        }else{
            header("location: single_post.php?post_id=".$post_id."&error_message=Could not delete comment");
            exit;
        }

    }
    catch (PDOException $e) {
            echo $e->getMessage();
            exit;
    }

}else{
    header("location: index.php?error_message=error");
    exit;
}



?>