<?php


session_start();

include("connection.php");

if(isset($_POST['update_profile_btn'])){

    $user_id = $_SESSION['id'];
    $username = $_POST['username'];
    $bio = $_POST['bio'];
    $image = $_FILES['image']['tmp_name'];  //file

    if($image != ""){
       $image_name = $username . ".jpeg"; //5.jpeg
    }else{
        $image_name = $_SESSION['image'];
    }



    if($username != $_SESSION['username']){
        //make sure that username is unique
        $conn = connect_PDO();
        $stmt = $conn->prepare("SELECT username FROM users WHERE username = ?");

        // $stmt->bind_param("s",$username);
        $stmt->bindParam(1, $username, PDO::PARAM_STR);
        $stmt->execute();

        // $stmt->store_result();
        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        //there is a user with this username
        if($data){
            header("location: edit_profile.php?error_message=Username was already taken");
            exit;

        } else{



            updateUserProfile($conn,$username,$bio,$image_name,$user_id,$image);

            
    
        }
    
      

    }else{


    

        updateUserProfile($conn,$username,$bio,$image_name,$user_id,$image);
         

    }

   

    


}else{

    header("location: edit_profile.php?error_message?error occured, try again");
    exit;


}






function updateUserProfile($conn,$username,$bio,$image_name,$user_id,$image){
    $conn = connect_PDO();
    $stmt = $conn->prepare("UPDATE users SET username = ?, bio = ? , image = ? WHERE id = ?");
    // $stmt->bind_param("sssi",$username,$bio,$image_name,$user_id);
    $stmt->bindParam(1, $username, PDO::PARAM_STR);
    $stmt->bindParam(2, $bio, PDO::PARAM_STR);
    $stmt->bindParam(3, $image_name, PDO::PARAM_STR);
    $stmt->bindParam(4, $user_id, PDO::PARAM_INT);

    if($stmt->execute()){

        if($image != ""){
             //store image in folder
            move_uploaded_file($image,"assets/img/".$image_name);
        }

        //update session
        $_SESSION['username']=$username;
        $_SESSION['bio']=$bio;
        $_SESSION['image']=$image_name;


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