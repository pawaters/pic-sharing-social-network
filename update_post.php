<?php



include("connection.php");

if(isset($_POST['update_post_btn'])){


    $post_id = htmlspecialchars($_POST['post_id']);
    $old_image_name = $_POST['old_image_name'];
	$caption = $_POST['caption'];
	$hashtags = $_POST['hashtags'];
    $new_image = $_FILES['new_image']['tmp_name'];


    if(strlen($caption) > 100 || strlen($hashtags) > 50){
        header("location: index.php?error_message=caption/hashtags too long");
        exit;

    }
    if (is_numeric(trim($post_id)) == false){
        header("location: index.php?error_message=error - post_id is not a number.");
        exit;
    }
    if($post_id > 100){
		header('location: index.php?error_message= max post_id is 100');
		exit;
	}
   
    $file_size = $_FILES['new_image']['size'];
    $valid_file_size = 3*1024*1024;
    if($file_size > $valid_file_size)
	{
		header('location: index.php?error_message=File size must not be more that 3Mb.');
		exit;
	}

    list($orig_width, $orig_height) = getimagesize($new_image);
	if ($orig_height < 400 || $orig_width < 400) {
		header('location: index.php?error_message=Post not created. File height and width should be sufficient. Choose a file with at least 400 width and 400 height.');
		exit;
	}

    $min_file_size = 300*300;
	if($file_size < $min_file_size)
	{
		header('location: index.php?error_message=File size must not be too small.');
		exit;
	}

    $ext = exif_imagetype($new_image);
	if($ext != 2 && $ext != 3) //2 is JPEG and 3 is PNG
	{
        header('location: index.php?error_message=File must be png or jpeg.');
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
	if(strlen($caption) > 100 || strlen($hashtags) > 50){
		header('location: upload.php?error_message=Caption or hashtags too long.');
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

    

            header("location: index.php?success_message=Post has been updated successfully");
            exit;

        }else{
            header("location: index.php?error_message=error occured, try again");
            exit;

        }
    }
    catch (PDOException $e) {
            echo $e->getMessage();
    }

    




}else{

    header("location: index.php?error_message=error occured, try again");
    exit;


}
