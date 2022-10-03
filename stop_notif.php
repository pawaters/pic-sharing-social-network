<?php

session_start();
require_once 'connection.php';

$user_id = $_SESSION['id'];

try {
    $conn = connect_PDO();
    $sql = "UPDATE users SET notify = 0 WHERE id = ? LIMIT 1";
    if (!$stmt = $conn->prepare($sql)) 
    {
        header("Location: verify.php?error_message=SQL error");
        exit();
    } else {
        $stmt->bindParam(1, $user_id, PDO::PARAM_STR);  
        $stmt->execute();
        header("Location: index.php?success_message=You will no longer be notified!");
        exit();
    } 
} catch (PDOException $error) {
    echo $error->getMessage(); 
    exit;
}
$conn = null;

?>

?>