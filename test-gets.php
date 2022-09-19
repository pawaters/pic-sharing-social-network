<?php

include('connection.php');

$user_id = 2;

$conn = connect_PDO();
$stmt = $conn->prepare("SELECT other_user_id FROM followings 
                        WHERE user_id = ?");
// $stmt->bind_param("i", $user_id);
$stmt->bindParam(1, $user_id, PDO::PARAM_INT);
$stmt->execute();

$ids = array();

// $result = $stmt->get_result();
$ids = $stmt->fetch();

print_r($ids);
// while($row = $result->fetch_array(MYSQLI_NUM))
// {
//     foreach($row as $r)
//     {
//         $ids[] = $r; //review that in detail to really understand
//     }
// }

if (empty($ids)){
    $ids = [$user_id];
}

$following_ids = join(",", $ids);
echo "<br />\n";
print_r($following_ids);

$stmt = $conn->prepare("SELECT * FROM users WHERE id not in ($following_ids) ORDER BY RAND() LIMIT 4");

$stmt->execute();
$suggestions = $stmt->fetch();
echo "<br />\n";
print_r($suggestions);
echo "<br />\n";
echo $suggestions['id'];
echo "<br />\n";
echo $suggestions['id'];

$_SESSION['id'] = 5;

?>

<?php foreach($suggestions as $suggestion){ ?>
    
    <?php if($suggestion['id'] != $_SESSION['id']) { ?>
    
        <div class="suggestion-card">
            <div class="suggestion-pic">
                <form id='suggestion_form<?php echo $suggestion['id'];?>' method="POST" action="other_user_profile.php">
                    <input type="hidden" name="other_user_id" value="<?php echo $suggestion['id'] ?>">
                    <img onclick="document.getElementById('suggestion_form<?php echo $suggestion['id'];?>').submit();" src="<?php echo "assets/img/".$suggestion['image'];?>" >
                </form>
            </div>
            <div>
                <p class="username"><?php echo $suggestion['username'];?> <?php echo $suggestion['id'];?></p>
                <p class="sub-text"><?php echo substr($suggestion['bio'], 0, 15);?></p>
            </div>
            <form action="follow_this_person.php" method="POST">
                <input type="hidden" name="other_user_id" value="<?php echo $suggestion['id'];?>">
                <button class="follow-btn" name="follow_btn" type="submit">follow</button>
            </form>
        </div>
    <?php } ?>

<?php } ?>