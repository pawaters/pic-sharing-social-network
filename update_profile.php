<?php


session_start();

include_once("connection.php");

if(isset($_POST['update_profile_btn'])){

    $user_id = $_SESSION['id'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $bio = $_POST['bio'];
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
    // $stmt->bind_param("ssi",$username,$image_name,$user_id);
    $stmt->bindParam(1, $username, PDO::PARAM_STR);
    $stmt->bindParam(2, $image_name, PDO::PARAM_STR);
    $stmt->bindParam(3, $user_id, PDO::PARAM_INT);
    $stmt->execute();

    

}


function updateProfileImageAndUsernameInPostsTable($conn,$username,$image_name,$user_id){

    $conn = connect_PDO();
    $stmt = $conn->prepare("UPDATE posts SET username = ?, profile_image = ?  WHERE user_id = ?");
    // $stmt->bind_param("ssi",$username,$image_name,$user_id);
    $stmt->bindParam(1, $username, PDO::PARAM_STR);
    $stmt->bindParam(2, $image_name, PDO::PARAM_STR);
    $stmt->bindParam(3, $user_id, PDO::PARAM_INT);
    $stmt->execute();


}






?>