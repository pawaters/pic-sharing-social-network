<?php

include('connection.php'); 
// 1) get the user_id of the post owner thanks to the post_ID
$post_id = 32;
$conn = connect_PDO();  
$stmt = $conn->prepare("SELECT user_id FROM posts WHERE id = ? LIMIT 1");
$stmt->bindParam(1, $post_id, PDO::PARAM_INT);
$stmt->execute();
$data1 = $stmt->fetch(PDO::FETCH_ASSOC);
$post_owner_id = $data1['user_id'];
echo $post_id;
echo $post_owner_id;
print_r($data1);

// if($data1) 
// {
//     $post_owner_id = "13";

//     // 2) get the post owner email thanks to id
//     $stmt = $conn->prepare("SELECT * FROM users WHERE id = ? LIMIT 1");
//     $stmt->bindParam(1, $post_owner_id, PDO::PARAM_INT);
//     $stmt->execute();
//     $data2 = $stmt->fetch(PDO::FETCH_ASSOC);
//     $post_owner_email = $data2['email'];
// }   else {
//     header('location: single_post.php?$post_owner_id='.$post_owner_id."&error_message=could not retrieve the post owner id");
// }

// $to = $post_owner_email;
// $subject = "Your image has received a comment";
// $message = "This is a notification to inform one of your posts / images has received a comment.";

// $headers = "From: Pierre Waters <pierrealbanwaters@proton.com>\r\n";
// $headers .= "Reply-To: pierrealbanwaters@proton.com\r\n";
// $headers .= "Content-type: text/html\r\n";

// mail($to, $subject, $message, $headers);

?>