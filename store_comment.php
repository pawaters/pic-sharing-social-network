<?php 

session_start();

include('connection.php'); 

if(isset($_POST['comment_btn'])) 
{
    $user_id = $_SESSION['id'];
    $profile_image = $_SESSION['image'];
    $username = $_SESSION['username'];
    $post_id = $_POST['post_id'];
    $comment_text = $_POST['comment_text'];
    $date = date("Y-m-d H:i:s");
    $conn = connect_PDO();
    $stmt =  $conn->prepare(
        "INSERT INTO comments (post_id, user_id, username, profile_image, comment_text, date)
        VALUES (?,?,?,?,?,?)");
    // $stmt->bind_param("iissss", $post_id, $user_id, $username, $profile_image, $comment_text, $date);
    $stmt->bindParam(1, $post_id, PDO::PARAM_INT);
    $stmt->bindParam(2, $user_id, PDO::PARAM_INT);
    $stmt->bindParam(3, $username, PDO::PARAM_STR);
    $stmt->bindParam(4, $profile_image, PDO::PARAM_STR);
    $stmt->bindParam(5, $comment_text, PDO::PARAM_STR);
    $stmt->bindParam(6, $date, PDO::PARAM_STR);

    if($stmt->execute())
    {
        header('location: single_post.php?post_id='.$post_id."&success_message=comment submitted successfully");
    }
    else
    {
        header('location: single_post.php?post_id='.$post_id."&error_message=comment submission failed");
    }
    exit;

}
else
{
    header('location: index.php');
    exit;
}
 
?>


