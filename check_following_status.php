<?php

if(!isset($_SESSION['id'])){
    header('location: login.php?error_message=Please log in');
    exit;
}

$user_id = $_SESSION['id'];

try { 
    $conn = connect_PDO();
    $stmt = $conn->prepare("SELECT * FROM followings WHERE user_id = ? AND other_user_id = ?");

    $stmt->bindParam(1, $user_id, PDO::PARAM_INT);
    $stmt->bindParam(2, $other_user_id, PDO::PARAM_INT);
    $stmt->execute();

    $result = $stmt->fetchAll();
}
catch (PDOException $e) {
		echo $e->getMessage();
}

if($result)
{
    $following_status = true;
}
else
{
    $following_status = false;
}

//

?>