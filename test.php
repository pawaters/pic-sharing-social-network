<?php

include("connection.php");


$session_id = $_SESSION['id'];

try{
    $conn = connect_PDO();
    $stmt = $conn->prepare("SELECT * FROM comments WHERE user_id = 6 AND id = 10");
    $stmt->bindParam(1, $session_id, PDO::PARAM_INT);
    $stmt->bindParam(2, $comment_id, PDO::PARAM_INT);
    $stmt->execute();
    $comment_from_db = $stmt->fetch(PDO::FETCH_ASSOC);
} catch (PDOException $error) {
    echo $error->getMessage(); 
    exit;
}

// var_dump($comment_from_db);
echo $comment_from_db['id'];