<?php

// include('connection.php');

$user_id = $_SESSION['id'];

$stmt = $conn->prepare("SELECT * FROM followings WHERE user_id = ? AND other_user_id = ?");
// $stmt->bind_param("ii", $user_id, $other_user_id);
$stmt->bindParam(1, $user_id, PDO::PARAM_INT);
$stmt->bindParam(2, $other_user_id, PDO::PARAM_INT);
$stmt->execute();

// $stmt->store_result();
$result = $stmt->fetchAll();
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