<?php

session_start();

include('connection.php');

if(isset($_POST['heart_btn'])){

    $user_id = $_SESSION['id'];
    $post_id = $_POST['post_id'];

    try {
        $conn = connect_PDO();
        
        $stmt = $conn->prepare("DELETE FROM likes WHERE user_id = ? AND post_id = ?");

        $stmt->bindParam(1, $user_id, PDO::PARAM_INT);
        $stmt->bindParam(2, $post_id, PDO::PARAM_INT);


        //decrease number of likes of this post
        $stmt1 = $conn->prepare("UPDATE posts SET likes=likes-1 WHERE id = ?");
        
        $stmt1->bindParam(1, $post_id, PDO::PARAM_INT);


        $stmt->execute();
        $stmt1->execute();
    }
    catch (PDOException $e) {
            echo $e->getMessage();
    }



    header("location: index.php?success_message=You unliked this post");




}else{
    header("location: index.php");
    exit;
}

?>