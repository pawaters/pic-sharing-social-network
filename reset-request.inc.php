<?php 

    session_start();
    session_unset();
    session_destroy();

    require 'sendemail.php';

if(isset($_POST["reset-request-submit"])) {

    // 1 token for auth, 1 token to look in the db, to prevent timing attacks
    $selector = bin2hex(random_bytes(8));
    $token = random_bytes(32);

    $url = "https://pic-sharing-app.herokuapp.com/create-new-password.php?selector=" . $selector . "&validator=" . bin2hex($token);
    $expires = date("U") + 1800;

    require_once 'connection.php';

    $userEmail = $_POST["email"];

    //server-side form validation
    $emp_email=trim($_POST["email"]);

    if($emp_email == "") {
        header("location: reset-password.php?error_message=Please enter email");
        exit; 
    } 
    
    if (!filter_var($userEmail, FILTER_VALIDATE_EMAIL)) {
        header('location: reset-password.php?error_message=Invalid email format.');
        exit;
    }
    
    try {
        $conn = connect_PDO();

        $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->bindParam(1, $userEmail, PDO::PARAM_STR);
        $stmt->execute();
        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        if($data) {

            $sql = "DELETE FROM pwdReset WHERE pwdResetEmail = ?";
            if (!$stmt = $conn->prepare($sql)) {
                header("Location: reset-password.php?error_message=SQL error");
                exit();
            } else {
                $stmt->bindParam(1, $userEmail, PDO::PARAM_STR);
                $stmt->execute();
            }
            $sql = "INSERT INTO pwdReset (pwdResetEmail, pwdResetSelector, pwdResetToken, pwdResetExpires) VALUES (?,?,?,?);" ;
            if (!$stmt = $conn->prepare($sql)) {
                header("Location: reset-password.php?error_message=SQL error");
                exit();
            } else {
                $hashedToken = password_hash($token, PASSWORD_DEFAULT);
                $stmt->bindParam(1, $userEmail, PDO::PARAM_STR);
                $stmt->bindParam(2, $selector, PDO::PARAM_STR);
                $stmt->bindParam(3, $hashedToken, PDO::PARAM_STR);
                $stmt->bindParam(4, $expires, PDO::PARAM_STR);
                $stmt->execute();
            }
        } else {
            header("location: reset-password.php?error_message=No such email in our database");
            exit();
        }
    }
    catch (PDOException $e) {
            echo $e->getMessage();
    }

    $to = $userEmail;
    $subject = "Reset your Password";
    $message = '<p>The link to reset your password is below.</br>';
    $message .= '<p><a href="' . $url .'">' . $url . '</a></p>';

    // $headers = "From: Pierre Waters <pierrealbanwaters@proton.com>\r\n";
    // $headers .= "Reply-To: pierrealbanwaters@proton.com\r\n";
    // $headers .= "Content-type: text/html\r\n";

    // mail($to, $subject, $message, $headers);

    //Switched to sendgrid when deployed on heroku 
    SendEmail::SendMail($to, $subject, $message);

    $emailLog = "Password reset request received. Email was sent to : ";
    $emailLog .= $to;
    
    header("location: login.php?success_message=". $emailLog ."");
    exit();

} else {
    header("Location: reset-password.php?error_message=Error ocurred");
    exit();
}

?>