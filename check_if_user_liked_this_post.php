<?php

// include('connection.php');

$user_id = $_SESSION['id'];
$post_id = $post['id'];

$stmt = $conn->prepare("SELECT * FROM likes WHERE user_id = ? AND post_id = ? ");
$stmt->bindParam(1, $user_id, PDO::PARAM_INT);
$stmt->bindParam(2, $post_id, PDO::PARAM_INT);

// $stmt->bind_param("ii",$user_id,$post_id);
$stmt->execute();

$result = $stmt->fetchAll();
 if($result){
     $user_liked_this_post = true;
 }else{
     $user_liked_this_post = false;
 }



?>