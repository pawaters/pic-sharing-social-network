<?php

include('connection.php');

$user_id = $other_user_id;

$stmt = $conn->prepare("SELECT * FROM posts WHERE user_id = ? LIMIT 6");
$stmt->bind_param("i",$user_id);

if($stmt->execute())
{
    $posts = $stmt->get_result();
}else{
    $posts = [];
}


?>