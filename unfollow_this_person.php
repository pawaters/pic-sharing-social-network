<?php 

session_start();

include('connection.php');

if(isset($_POST['unfollow_btn'])){
    $user_id = $_SESSION['id'];
    $other_user_id = htmlspecialchars($_POST['other_user_id']);
    if (is_numeric(trim($other_user_id)) == false){
        header("location: index.php?error_message=error - other_user_id is not a number.");
        exit;
    }
    if($other_user_id > 100){
		header('location: index.php?error_message= max user_id is 100.');
		exit;
	}

    try {
        $conn = connect_PDO();
        $stmt = $conn->prepare("DELETE FROM followings 
                                WHERE user_id = ? AND other_user_id = ?");
    
        $stmt->bindParam(1, $user_id, PDO::PARAM_INT);
        $stmt->bindParam(2, $other_user_id, PDO::PARAM_INT);

        $stmt1 = $conn->prepare("UPDATE users 
                                SET following=following-1
                                WHERE id= ?");
        
        $stmt1->bindParam(1, $user_id, PDO::PARAM_INT);
        
        $stmt2 = $conn->prepare("UPDATE users 
                                SET followers=followers-1
                                WHERE id= ?");
        
        $stmt2->bindParam(1, $other_user_id, PDO::PARAM_INT);         
        
        $stmt->execute();
        $stmt1->execute();
        $stmt2->execute();
    }
    catch (PDOException $e) {
            echo $e->getMessage();
    }

    $_SESSION['following'] = $_SESSION['following']-1; 

    header("location:profile.php?success_message=New Unfollow Successful");
    exit;
}
else
{
    header("location:index.php");
    exit;
}

?>

 