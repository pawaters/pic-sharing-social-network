<?php

include('connection.php');

$user_id = $_SESSION['id'];

$stmt = $conn->prepare("SELECT other_user_id FROM followings 
                        WHERE user_id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();

$ids = array();

$result = $stmt->get_result();
while($row = $result->fetch_array(MYSQLI_NUM))
{
    foreach($row as $r)
    {
        $ids[] = $r; //review that in detail to really understand
    }
}

$following_ids = join("','", $ids);

$stmt = $conn->prepare("SELECT * FROM users WHERE id not in ($following_ids) ORDER BY RAND() LIMIT 4");

$stmt->execute();
$suggestions = $stmt->get_result();

?>