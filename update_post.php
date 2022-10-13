<?php



include("connection.php");

if(isset($_POST['update_post_btn'])){


    $post_id = htmlspecialchars($_POST['post_id']);
    $old_image_name = $_POST['old_image_name'];
	$caption = $_POST['caption'];
	$hashtags = $_POST['hashtags'];
    $new_image = $_FILES['new_image']['tmp_name'];


    if(strlen($caption) > 200 || strlen($hashtags) > 200){
        header("location: index.php?error_message?caption/hashtags too long");
        exit;

    }
    if (is_numeric(trim($post_id)) == false){
        header("location: index.php?error_message=error - post_id is not a number.");
        exit;
    }

    $valid_file_size = 3*1024*1024;
	$file_size = $_FILES['new_image']['size'];
    $file_type = $_FILES['new_image']['type'];
	if($file_type != 'image/png' && $file_type != 'image/jpeg')
    {
        header('location: upload.php?error_message=File must be png or jpeg.');
		exit;
    }


    if($new_image != ""){
        $image_name = strval(time()) . ".jpeg";
    }else{
        $image_name = $old_image_name;
    }

    //server-side form validation

	$emp_caption=trim($_POST['caption']);
	$emp_hash=trim($_POST['hashtags']);
    $ext = pathinfo($new_image, PATHINFO_EXTENSION);
	if($ext != "png" && $ext != "jpeg") 
	{
        header('location: index.php?error_message=File must be png or jpeg.');
		exit;
    }

    if($emp_caption == "")
    {
        header("location: index.php?error_message=Please enter a caption");
        exit; 
    } 
	if($emp_hash == "")
    {
        header("location: index.php?error_message=Please enter a hashtag");
        exit; 
    } 
    if(preg_match("/[<>=\{\}'\/]/", $emp_caption)) 
    {
        header("location: index.php?error_message=Please enter valid caption (no special characters)");
        exit; 
    }
	if(preg_match("/[<>=\{\}'\/]/", $emp_hash)) 
    {
        header("location: index.php?error_message=Please enter valid hashtag (no special characters)");
        exit; 
    }
    if(preg_match("/[<>=\{\}'\/]/", $old_image_name)) 
    {
        header("location: index.php?error_message=Please enter valid old image name (no special characters)");
        exit; 
    }

    try {
        $conn = connect_PDO();
        $stmt = $conn->prepare("UPDATE posts SET image = ? , caption = ?, hashtags = ? WHERE id = ?");
        
        $stmt->bindParam(1, $image_name, PDO::PARAM_STR);
        $stmt->bindParam(2, $caption, PDO::PARAM_STR);
        $stmt->bindParam(3, $hashtags, PDO::PARAM_STR);
        $stmt->bindParam(4, $post_id, PDO::PARAM_INT);

        if($stmt->execute()){

            if($new_image != ""){
                move_uploaded_file($new_image,"assets/img/".$image_name);
            }

    

            header("location: index.php?success_message?Post has been updated successfully");
            exit;

        }else{
            header("location: index.php?error_message?error occured, try again");
            exit;

        }
    }
    catch (PDOException $e) {
            echo $e->getMessage();
    }

    




}else{

    header("location: index.php?error_message?error occured, try again");
    exit;


}
