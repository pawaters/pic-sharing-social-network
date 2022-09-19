<?php

// include('connection.php');

$user_id = $_SESSION['id'];

$conn = connect_PDO();
$stmt = $conn->prepare("SELECT other_user_id FROM followings 
                        WHERE user_id = ?");
// $stmt->bind_param("i", $user_id);
$stmt->bindParam(1, $user_id, PDO::PARAM_INT);
$stmt->execute();

// $result = $stmt->get_result();
// while($row = $result->fetch_array(MYSQLI_NUM))
// {
//     foreach($row as $r)
//     {
//         $ids[] = $r; //review that in detail to really understand
//     }
// }
while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
    foreach($row as $r){
        $ids[] = $r;
    }
}


if (empty($ids)){
    $ids = [$user_id];
}

$following_ids = join(",", $ids);

$stmt = $conn->prepare("SELECT * FROM users WHERE id not in ($following_ids) ORDER BY RAND() LIMIT 4");

$stmt->execute();
$suggestions = $stmt->fetchAll();

?>