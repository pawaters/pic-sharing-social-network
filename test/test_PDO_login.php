<?php
//get all users DB or just one row
require ("connection.php");
$email = "pierre.alban.waters@gmail.com";
$password = md5("p");

$conn = connect_PDO();
$stmt = $conn->prepare("SELECT id, username, email, image, followers, following, posts, bio
                            FROM users
                            WHERE email = ? AND password = ?");
$stmt->bindParam(1, $email, PDO::PARAM_STR);
$stmt->bindParam(2, $password, PDO::PARAM_STR);
echo "stmt->execute: <br />\n";
$stmt->execute();
print_r($stmt);
echo "<br />\n";

echo "Nb_rows: <br />\n";
$data = $stmt->fetch(PDO::FETCH_ASSOC);
$nb_rows = count($data);
echo $nb_rows."<br />\n";

echo "Nb_rows: <br />\n";
echo $nb_rows."<br />\n";
echo "<br />\nFETCH - Print_r(data): <br />\n";
print_r($data);



echo "<br />\n";
echo "<br />\n";
echo $data['username'];


?>