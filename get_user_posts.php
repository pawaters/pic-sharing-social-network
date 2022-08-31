<?php

session_start();

include('connection.php');

$user_id = $_SESSION['user_id'];

$stmt = $conn->prepare("SELECT * FROM posts WHERE user_id = ?");
$stmt->bind_param("i",$user_id);

if($stmt->execute())
{
    $posts = $stmt->get_result();
}else{
    $posts = [];
}


?>