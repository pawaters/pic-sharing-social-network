<?php
//get all users DB or just one row
require ("connection.php");

//1) understand what bind_result does in SQLi
$conn = connect_PDO();
$stmt = $conn->prepare("SELECT COUNT(*) FROM posts");
$stmt->execute();
$nb_of_results = $stmt->fetchColumn();


echo "RESULT: <br />\n";
echo($nb_of_results);
echo "<br />\n";


?>