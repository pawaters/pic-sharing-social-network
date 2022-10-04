<?php

$user_id = $_SESSION['id'];
$post_id = $post['id'];
try {
    $conn = connect_PDO();
    $stmt = $conn->prepare("SELECT * FROM likes WHERE user_id = ? AND post_id = ? ");
    $stmt->bindParam(1, $user_id, PDO::PARAM_INT);
    $stmt->bindParam(2, $post_id, PDO::PARAM_INT);

    $stmt->execute();

    $result = $stmt->fetchAll();
}
catch (PDOException $e) {
		echo $e->getMessage();
}

 if($result){
     $user_liked_this_post = true;
 }else{
     $user_liked_this_post = false;
 }



?>