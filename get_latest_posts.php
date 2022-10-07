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
try {
    $conn = connect_PDO();
    $stmt = $conn->prepare("SELECT COUNT(*) FROM posts");
    $stmt->execute();
    $total_posts = $stmt->fetchColumn();

    $total_posts_per_page = 1;

    $offset = ($page_no - 1) * $total_posts_per_page;

    $total_no_of_pages = ceil($total_posts / $total_posts_per_page);

    $stmt = $conn->prepare("SELECT * 
                            FROM posts 
                            ORDER BY date DESC
                            LIMIT $offset, $total_posts_per_page"); 
    $stmt->execute();

    $posts = $stmt->fetchAll();
}
catch (PDOException $e) {
		echo $e->getMessage();
}
?>

