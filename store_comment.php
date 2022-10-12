<?php 

session_start();

include('connection.php'); 

if(isset($_POST['comment_btn'])) 
{
    $user_id = $_SESSION['id'];
    $profile_image = $_SESSION['image'];
    $username = $_SESSION['username'];
    $post_id = htmlspecialchars($_POST['post_id']);
    $comment_text = $_POST['comment_text'];
    $date = date("Y-m-d H:i:s");

    //server-side form validation

	$emp_comment=trim($_POST['comment_text']);

    if($emp_comment == "")
    {
        header("location: index.php?error_message=Please enter a comment");
        exit; 
    } 
    if(preg_match("/[<>=\{\}\/]/", $emp_comment)) 
    {
        header("location: index.php?error_message=Please enter valid comment (no special characters)");
        exit; 
    }
    if (is_numeric(trim($post_id)) == false){
        header("location: index.php?error_message=error - post_id is not a number.");
        exit;
    }
    
    try {
    $conn = connect_PDO();
    $stmt =  $conn->prepare(
        "INSERT INTO comments (post_id, user_id, username, profile_image, comment_text, date)
        VALUES (?,?,?,?,?,?)");
    $stmt->bindParam(1, $post_id, PDO::PARAM_INT);
    $stmt->bindParam(2, $user_id, PDO::PARAM_INT);
    $stmt->bindParam(3, $username, PDO::PARAM_STR);
    $stmt->bindParam(4, $profile_image, PDO::PARAM_STR);
    $stmt->bindParam(5, $comment_text, PDO::PARAM_STR);
    $stmt->bindParam(6, $date, PDO::PARAM_STR);
    $stmt->execute();

  
    $stmt = $conn->prepare("SELECT user_id FROM posts WHERE id = ? LIMIT 1");
    $stmt->bindParam(1, $post_id, PDO::PARAM_INT);
    $stmt->execute();
    $data1 = $stmt->fetch(PDO::FETCH_ASSOC);
    if($data1) 
    {
        $post_owner_id = $data1['user_id'];
        $stmt = $conn->prepare("SELECT email, notify FROM users WHERE id = ? LIMIT 1");
        $stmt->bindParam(1, $post_owner_id, PDO::PARAM_INT);
        $stmt->execute();
        $data2 = $stmt->fetch(PDO::FETCH_ASSOC);
        $post_owner_email = $data2['email'];
        $notify = $data2['notify'];
        if ($notify == 0)
        {
            header('location: single_post.php?post_id='.$post_id."&post_owner_id=".$post_owner_id."&success_message=comment submitted successfully. User was not notified, as defined by user.& ");
            exit;
        }

    }   else {
        header('location: single_post.php?$post_owner_id='.$post_owner_id."&error_message=could not retrieve the post owner id");
    }
    } catch (PDOException $error) {     
        echo $error->getMessage(); 
        exit;
        }

    $to = $post_owner_email;
    $subject = "Your image has received a comment";
    $message = "This is a notification to inform one of your posts / images has received a comment.";
    
    $headers = "From: Pierre Waters <pierrealbanwaters@proton.com>\r\n";
    $headers .= "Reply-To: pierrealbanwaters@proton.com\r\n";
    $headers .= "Content-type: text/html\r\n";

    mail($to, $subject, $message, $headers);

    header('location: single_post.php?post_id='.$post_id."&post_owner_id=".$post_owner_id."&success_message=comment submitted successfully & user notified as per settings");
    exit;

}
else
{
    header('location: index.php');
    exit;
}
 
?>


