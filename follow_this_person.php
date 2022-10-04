<?php 

session_start();

include('connection.php');

if(isset($_POST['follow_btn'])){
    try {
        $conn = connect_PDO();
        $user_id = $_SESSION['id'];
        $other_user_id = $_POST['other_user_id'];

        $stmt = $conn->prepare("INSERT INTO followings (user_id, other_user_id)
                                VALUES (?,?)");
        // $stmt->bind_param("ii",$user_id, $other_user_id);
        $stmt->bindParam(1, $user_id, PDO::PARAM_INT);
        $stmt->bindParam(2, $other_user_id, PDO::PARAM_INT);

        $stmt1 = $conn->prepare("UPDATE users 
                                SET following=following+1
                                WHERE id= ?");
        // $stmt1->bind_param("i",$user_id);
        $stmt1->bindParam(1, $user_id, PDO::PARAM_INT);
        
        $stmt2 = $conn->prepare("UPDATE users 
                                SET followers=followers+1
                                WHERE id= ?");
        // $stmt2->bind_param("i",$other_user_id);     
        $stmt2->bindParam(1, $other_user_id, PDO::PARAM_INT);
        
        $stmt->execute();
        $stmt1->execute();
        $stmt2->execute();
    }
    catch (PDOException $e) {
            echo $e->getMessage();
    }

    $_SESSION['following'] = $_SESSION['following']+1; 

    header("location:profile.php?success_message=New Follow Successful");
    exit;
}
else
{
    header("location:index.php");
    exit;
}

?>

 