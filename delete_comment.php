<?php


include('connection.php');


if(isset($_POST['delete_comment_btn'])){

    $comment_id = $_POST['comment_id'];
    $post_id = $_POST['post_id'];

    $stmt = $conn->prepare("DELETE FROM comments WHERE id = ?");
    $stmt->bind_param("i",$comment_id);

    if($stmt->execute()){
        header("location: single_post.php?post_id=".$post_id."&success_message=Comment deleted successfully");
    }else{
        header("location: single_post.php?post_id=".$post_id."&error_message=Could not delete comment");
    }

    exit;
    

}else{
    header("location: index.php");
    exit;
}



?>