<?php



include("connection.php");

if(isset($_POST['update_post_btn'])){


    $post_id = $_POST['post_id'];
    $old_image_name = $_POST['old_image_name'];
	$caption = htmlspecialchars($_POST['caption']);
	$hashtags = htmlspecialchars($_POST['hashtags']);
    $new_image = $_FILES['new_image']['tmp_name'];  //file


    if(strlen($caption) > 200 || strlen($hashtags) > 200){
        header("location: profile.php?error_message?caption/hashtags too long");
        exit;

    }




    if($new_image != ""){
        $image_name = strval(time()) . ".jpeg"; //5654564545.jpeg
    }else{
        $image_name = $old_image_name;
    }

    //server-side form validation

	$emp_caption=trim($_POST['caption']);
	$emp_hash=trim($_POST['hashtags']);
    

    if($emp_caption == "")
    {
        header("location: camera.php?error_message=Please enter a caption");
        exit; 
    } 
	if($emp_hash == "")
    {
        header("location: camera.php?error_message=Please enter a hashtag");
        exit; 
    } 
    if(preg_match("/[<>=\{\}\/]/", $emp_caption)) 
    {
        header("location: camera.php?error_message=Please enter valid caption (no special characters)");
        exit; 
    }
	if(preg_match("/[<>=\{\}\/]/", $emp_hash)) 
    {
        header("location: camera.php?error_message=Please enter valid hashtag (no special characters)");
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
                 //store image in folder
                move_uploaded_file($new_image,"assets/img/".$image_name);
            }

    

            header("location: profile.php?success_message?Post has been updated successfully");
            exit;

        }else{
            header("location: profile.php?error_message?error occured, try again");
            exit;

        }
    }
    catch (PDOException $e) {
            echo $e->getMessage();
    }

    




}else{

    header("location: profile.php?error_message?error occured, try again");
    exit;


}
