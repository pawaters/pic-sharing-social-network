<?php


include('connection.php');


if(isset($_POST['delete_comment_btn']) && !empty($_POST['comment_id']) && !empty($_POST['post_id'])){

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
		header('location: camera.php?error_message= max post_id is 100, max comment_id is 1000.');
		exit;
	}

    try {
    $conn = connect_PDO();
    $stmt = $conn->prepare("DELETE FROM comments WHERE id = ?");
    $stmt->bindParam(1, $comment_id, PDO::PARAM_INT);

    if($stmt->execute()){
        header("location: single_post.php?post_id=".$post_id."&success_message=Comment deleted successfully");
    }else{
        header("location: single_post.php?post_id=".$post_id."&error_message=Could not delete comment");
    }

    exit;
    }
    catch (PDOException $e) {
            echo $e->getMessage();
    }

}else{
    header("location: index.php?error_message=error");
    exit;
}



?>