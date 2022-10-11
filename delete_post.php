<?php

include('connection.php');

if(isset($_POST['delete_post_btn'])) 
{
    $post_id = htmlspecialchars($_POST['post_id']);
    if (is_numeric(trim($post_id)) == false){
        header("location: index.php?error_message=error - post_id is not a number.");
        exit;
    }
    
    try {
    $conn = connect_PDO();
    $stmt = $conn->prepare("DELETE FROM posts WHERE id = ?");
    $stmt->bindParam(1, $post_id, PDO::PARAM_INT);
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