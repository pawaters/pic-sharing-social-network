<?php 

//access to user session: session_start is always needed before any $_SESSION
session_start();

//access to DB: connection is always needed 
include('connection.php');

//make sure the user got there after button
if(isset($_POST['unfollow_btn'])){
    //prepare the variables to store locally before sending to DB
    $user_id = $_SESSION['id'];
    $other_user_id = $_POST['other_user_id'];

    //how to store in DB
    $stmt = $conn->prepare("DELETE FROM followings (user_id, other_user_id)
                            VALUES (?,?)");
    $stmt->bind_param("ii",$user_id, $other_user_id);

    $stmt1 = $conn->prepare("UPDATE users 
                            SET following=following+1
                            WHERE id= ?");
    $stmt1->bind_param("i",$user_id);
    
    $stmt2 = $conn->prepare("UPDATE users 
                            SET followers=followers+1
                            WHERE id= ?");
    $stmt2->bind_param("i",$other_user_id);            
    
    $stmt->execute();
    $stmt1->execute();
    $stmt2->execute();

    //update session
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

 