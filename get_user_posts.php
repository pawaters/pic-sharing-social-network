<?php

include_once('connection.php'); 

if(isset($_GET['page_no']) && $_GET['page_no'] != "")
{
    $page_no = $_GET['page_no'];
} 
else 
{
    $page_no = 1;
}

if(!isset($_SESSION['id'])){
    header('location: login.php?error_message=Please log in');
    exit;
}

$user_id = $_SESSION['id'];

try{
    $conn = connect_PDO();
    $stmt = $conn->prepare("SELECT COUNT(*) as total_posts FROM posts WHERE user_id = ?");
    $stmt->bindParam(1, $user_id, PDO::PARAM_INT);
    $stmt->execute();
    $total_posts = $stmt->fetchColumn();
}
catch (PDOException $e) {
		echo $e->getMessage();
}

$total_posts_per_page = 6;

$offset = ($page_no - 1) * $total_posts_per_page;

$total_no_of_pages = ceil($total_posts / $total_posts_per_page);

try {
    $stmt = $conn->prepare("SELECT * FROM posts WHERE user_id = ? ORDER BY id DESC LIMIT $offset, $total_posts_per_page"); 

    $stmt->bindParam(1, $user_id, PDO::PARAM_INT);
    $stmt->execute();
    $posts = $stmt->fetchAll();
}
catch (PDOException $e) {
		echo $e->getMessage();
}

?>