<?php

session_start();

include('connection.php');

if(isset($_POST['heart_btn'])){

    $user_id = $_SESSION['id'];
    $post_id = htmlspecialchars($_POST['post_id']);
    if (is_numeric(trim($post_id)) == false){
        header("location: index.php?error_message=error - post_id is not a number.");
        exit;
    }
    if($post_id > 100){
		header('location: index.php?error_message= max post_id is 100');
		exit;
	}

    try {
        $conn = connect_PDO();
        
        $stmt = $conn->prepare("DELETE FROM likes WHERE user_id = ? AND post_id = ?");

        $stmt->bindParam(1, $user_id, PDO::PARAM_INT);
        $stmt->bindParam(2, $post_id, PDO::PARAM_INT);

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