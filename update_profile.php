<?php


session_start();

include_once("connection.php");

if(isset($_POST['update_profile_btn'])){

    $user_id = $_SESSION['id'];
    $username = htmlspecialchars($_POST['username']);
    $email = $_POST['email'];
    $bio = htmlspecialchars($_POST['bio']);
    $image = $_FILES['image']['tmp_name'];  //file

    if($image != ""){
       $image_name = $username . ".jpeg"; //5.jpeg
    }else{
        $image_name = $_SESSION['image'];
    }

    //make sure that username is unique
    if($username != $_SESSION['username']){
        
        
        try {
            $conn = connect_PDO();
            $stmt = $conn->prepare("SELECT username FROM users WHERE username = ?");

            $stmt->bindParam(1, $username, PDO::PARAM_STR);
            $stmt->execute();

            $data = $stmt->fetch(PDO::FETCH_ASSOC);
        }
        catch (PDOException $e) {
                echo $e->getMessage();
        }
        if($data){
            header("location: edit_profile.php?error_message=Username was already taken");
            exit;
        }
    
    }

    //make sure that email is unique
    if($email != $_SESSION['email']){
        
        try {
            $conn = connect_PDO();
            $stmt = $conn->prepare("SELECT email FROM users WHERE email = ?");

            $stmt->bindParam(1, $email, PDO::PARAM_STR);
            $stmt->execute();

            $data = $stmt->fetch(PDO::FETCH_ASSOC);
        }
        catch (PDOException $e) {
                echo $e->getMessage();
        }

        if($data){
            header("location: edit_profile.php?error_message=email was already taken");
            exit;
        }
    }

    //server-side form validation

	$emp_email=trim($_POST["email"]);
	$emp_uname=trim($_POST["username"]);
	$emp_bio=trim($_POST["bio"]);

    if($emp_email == "") {
        header("location: edit_profile.php?error_message=Please enter valid email");
        exit; 
        } 
    if(!preg_match("/^[_\.0-9a-zA-Z-]+@([0-9a-zA-Z][0-9a-zA-Z-]+\.)+[a-zA-Z]{2,6}$/i", $emp_email)){
        header("location: edit_profile.php?error_message=Please enter valid email");
        exit; 
        }
    if($emp_bio == ""){
        header("location: edit_profile.php?error_message=Please enter bio");
        exit; 
    }
    if($emp_uname == ""){
        header("location: edit_profile.php?error_message=Please enter password confirmation");
        exit; 
    }
    if(preg_match("/[<>=\{\}\/]/", $emp_bio)) 
    {
        header("location: edit_profile.php?error_message=Please enter valid bio (no special characters)");
        exit; 
    }
    if(preg_match("/[<>=\{\}\/]/", $emp_uname)) 
    {
        header("location: edit_profile.php?error_message=Please enter valid username (no special characters)");
        exit; 
    }
    $conn = connect_PDO();
    updateUserProfile($conn,$username,$bio,$image_name,$user_id,$image, $email);  

}else{

    header("location: edit_profile.php?error_message?error occured, try again");
    exit;

}




function updateUserProfile($conn,$username,$bio,$image_name,$user_id,$image, $email){
    $conn = connect_PDO();
    $stmt = $conn->prepare("UPDATE users SET username = ?, bio = ? , image = ?, email = ? WHERE id = ?");
    $stmt->bindParam(1, $username, PDO::PARAM_STR);
    $stmt->bindParam(2, $bio, PDO::PARAM_STR);
    $stmt->bindParam(3, $image_name, PDO::PARAM_STR);
    $stmt->bindParam(4, $email, PDO::PARAM_STR);
    $stmt->bindParam(5, $user_id, PDO::PARAM_INT);

    if($stmt->execute()){

        if($image != ""){
             //store image in folder
            move_uploaded_file($image,"assets/img/".$image_name);
        }

        //update session
        $_SESSION['username']=$username;
        $_SESSION['bio']=$bio;
        $_SESSION['image']=$image_name;
        $_SESSION['email']=$email;


        updateProfileImageAndUsernameInPostsTable($conn,$username,$image_name,$user_id);

        updateProfileImageAndUsernameInCommentsTable($conn,$username,$image_name,$user_id);

        header("location: profile.php?success_message?Profile has been updated successfully");
        exit;

    }else{
        header("location: edit_profile.php?error_message?error occured, try again");
        exit;

    }
}

function updateProfileImageAndUsernameInCommentsTable($conn,$username,$image_name,$user_id){


    $conn = connect_PDO();
    $stmt = $conn->prepare("UPDATE comments SET username = ?, profile_image = ?  WHERE user_id = ?");

    $stmt->bindParam(1, $username, PDO::PARAM_STR);
    $stmt->bindParam(2, $image_name, PDO::PARAM_STR);
    $stmt->bindParam(3, $user_id, PDO::PARAM_INT);
    $stmt->execute();

    

}


function updateProfileImageAndUsernameInPostsTable($conn,$username,$image_name,$user_id){

    $conn = connect_PDO();
    $stmt = $conn->prepare("UPDATE posts SET username = ?, profile_image = ?  WHERE user_id = ?");

    $stmt->bindParam(1, $username, PDO::PARAM_STR);
    $stmt->bindParam(2, $image_name, PDO::PARAM_STR);
    $stmt->bindParam(3, $user_id, PDO::PARAM_INT);
    $stmt->execute();


}






?>