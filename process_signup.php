<?php

session_start();

include("connection.php");

if(isset($_POST['signup_btn']))
{
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $password_confirm = $_POST['password_confirm'];
    $vkey = md5(time().$username);
   
//server-side form validation

	$emp_email=trim($_POST["email"]);
	$emp_uname=trim($_POST["username"]);
	$emp_pass=trim($_POST["password"]);
	$emp_confirm=trim($_POST["password_confirm"]);

    if ($password != $password_confirm)
    {
        header('location: signup.php?error_message=passwords do not match');
        exit;
    }
    if($emp_email == "") {
        header("location: signup.php?error_message=Please enter valid email");
        exit; 
        } 
    if(!preg_match("/^[_\.0-9a-zA-Z-]+@([0-9a-zA-Z][0-9a-zA-Z-]+\.)+[a-zA-Z]{2,6}$/i", $emp_email)){
        header("location: signup.php?error_message=Please enter valid email");
        exit; 
        }
    if($emp_pass == ""){
        header("location: signup.php?error_message=Please enter password");
        exit; 
    }
    if($emp_confirm == ""){
        header("location: signup.php?error_message=Please enter password confirmation");
        exit; 
    }
    try {
        $conn = connect_PDO();
        $stmt = $conn->prepare( "SELECT id FROM users WHERE username = ? OR email = ?");
        
        $stmt->bindParam(1, $username, PDO::PARAM_STR);
        $stmt->bindParam(2, $email, PDO::PARAM_STR);
        $stmt->execute();
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $error) {
        echo $error->getMessage(); 
        exit;
    }
    
    if($data) 
    {
        header("location: signup.php?error_message=User already exists");
        exit;
    }
    else
    {
        try 
        {
            $stmt =  $conn->prepare(
                "INSERT INTO users (username, email, password, vkey) 
                VALUES (? ,? ,? ,?)");
            $stmt->bindParam(1, $username, PDO::PARAM_STR);
            $stmt->bindParam(2, $email, PDO::PARAM_STR);
            $stmt->bindParam(3, md5($password), PDO::PARAM_STR);
            $stmt->bindParam(4, $vkey, PDO::PARAM_STR);
            $stmt->execute();
        } 
        catch (PDOException $error) {
            echo $error->getMessage(); 
            exit;
        }
        
        $url = "verify.php?vkey=$vkey";
        $to = $email;
        $subject = "Email Verification";
        $message = '<p>The link to verify your email is below.</br>';
        $message .= '<p><a href="' . $url .'">' . $url . '</a></p>';
        
        $headers = "From: Pierre Waters <pierrealbanwaters@proton.com>\r\n";
        $headers .= "Reply-To: pierrealbanwaters@proton.com\r\n";
        $headers .= "Content-type: text/html\r\n";

        mail($to, $subject, $message, $headers);

        $emailLog = "Signup successful. Email validation link was sent.";
        $emailLog .= "address:";
        $emailLog .= $to;
        // $emailLog .= "Message:";
        // $emailLog .= $message;

        try 
        {
            $stmt = $conn->prepare("SELECT id, username, email, image, following, followers, posts, bio, verified, notify
                                    FROM users 
                                    WHERE username = ?");
            $stmt->bindParam(1, $username, PDO::PARAM_STR);
            $stmt->execute();
            $data = $stmt->fetch(PDO::FETCH_ASSOC);              
        }
        catch (PDOException $error) 
        {
            echo $error->getMessage(); 
            exit;
        }
        
        $_SESSION['id'] =  $data['id'];
        $_SESSION['username'] =  $data['username'];
        $_SESSION['email'] =  $data['email'];
        $_SESSION['image'] =  $data['image'];
        $_SESSION['followers'] =  $data['followers'];
        $_SESSION['following'] =  $data['following'];
        $_SESSION['post'] =  $data['post'];
        $_SESSION['bio'] =  $data['bio'];
        $_SESSION['verified'] =  $data['verified'];
        $_SESSION['notify'] =  $data['notify'];

        //return to homepage
        header("location: index.php?success_message=Signup successful. Email validation link was sent.");

    }
}
else
{
    header("location: signup.php?error_message=error occurred");

}

?>