<?php

include('connection.php');

$user_id = $_SESSION['id'];

$stmt = $conn->prepare("SELECT * FROM followings WHERE user_id = ? AND other_user_id = ?");
$stmt->bind_param("ii", $user_id, $other_user_id);
$stmt->execute();

$stmt->store_result();

    if($stmt->num_rows() > 0)
    {
        $following_status = true;
    }
    else
    {
        $following_status = false;
    }

//

?>