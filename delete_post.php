<?php

include('connection.php');

if(isset($_POST['delete_post_btn'])) 
{
    $post_id = $_POST['post_id'];

    $stmt = $conn->prepare("DELETE FROM posts WHERE id = ?");
    $stmt->bind_param("i", $post_id);
    if($stmt->execute())
    {
        header("location: profile.php?success_message=Post deleted");
    }
    else
    {
        header("location: profile.php?error_message=Could not delete post");
    }
    exit;
}
else
{
    header("location: index.php");
    exit;
}

?>