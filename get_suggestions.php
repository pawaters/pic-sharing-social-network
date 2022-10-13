<?php

require_once("connection.php");

if(!isset($_SESSION['id'])){
    header('location: login.php?error_message=Please log in');
    exit;
}

$user_id = $_SESSION['id'];

try {
    $conn = connect_PDO();
    $stmt = $conn->prepare("SELECT other_user_id FROM followings 
                            WHERE user_id = ?");
    $stmt->bindParam(1, $user_id, PDO::PARAM_INT);
    $stmt->execute();

    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        foreach($row as $r){
            $ids[] = $r;
        }
    }
}
catch (PDOException $e) {
		echo $e->getMessage();
}

if (empty($ids)){
    $ids = [$user_id];
}

$following_ids = join(",", $ids);

try {
    $stmt = $conn->prepare("SELECT * FROM users WHERE id not in ($following_ids) ORDER BY RAND() LIMIT 4");

    $stmt->execute();
    $suggestions = $stmt->fetchAll();
}
catch (PDOException $e) {
		echo $e->getMessage();
}
?>