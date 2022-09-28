<?php

include('connection.php'); 



if(isset($_GET['page_no']) && $_GET['page_no'] != "")
{
    $page_no = $_GET['page_no'];
} 
else 
{
    $page_no = 1;
}

$user_id = $_SESSION['id'];
$conn = connect_PDO();
$stmt = $conn->prepare("SELECT COUNT(*) as total_posts FROM posts WHERE user_id = ?");
$stmt->bindParam(1, $user_id, PDO::PARAM_INT);
// $stmt->bind_param("i", $user_id);
$stmt->execute();
// $stmt->bind_result($total_posts);
$total_posts = $stmt->fetchColumn();
// $stmt->store_result();
// $stmt->fetch();

$total_posts_per_page = 6;

$offset = ($page_no - 1) * $total_posts_per_page;

$total_no_of_pages = ceil($total_posts / $total_posts_per_page);

$stmt = $conn->prepare("SELECT * FROM posts WHERE user_id = ? ORDER BY id DESC LIMIT $offset, $total_posts_per_page"); 
// $stmt->bind_param("i", $user_id);
$stmt->bindParam(1, $user_id, PDO::PARAM_INT);
$stmt->execute();
$posts = $stmt->fetchAll();


?>