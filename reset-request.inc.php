<?php 

//connect to a submit button 
if(isset($_POST["reset-request-submit"])) {

    // 1 token for auth, 1 token to look in the db, to prevent timing attacks (RESEARCH)
    $selector = bin2hex(random_bytes(8));
    $token = random_bytes(32);

    $url = "create-new-password.php?selector=" . $selector . "&validator=" . bin2hex($token);
    $expires = date("U") + 1800;

    require 'connection.php';

    $userEmail = $_POST["email"];
    $conn = connect_PDO();
    $sql = "DELETE FROM pwdReset WHERE pwdResetEmail = ?";
    if (!$stmt = $conn->prepare($sql)) {
        header("Location: login.php?error_message=SQL error");
        exit();
    } else {
        $stmt->bindParam(1, $userEmail, PDO::PARAM_STR);
        $stmt->execute();
    }
    //WHEN INSERTING, ALWAYS THINK "Is there any sensitive data to hash"
    $sql = "INSERT INTO pwdReset (pwdResetEmail, pwdResetSelector, pwdResetToken, pwdResetExpires) VALUES (?,?,?,?);" ;
    if (!$stmt = $conn->prepare($sql)) {
        header("Location: login.php?error_message=SQL error");
        exit();
    } else {
        $hashedToken = password_hash($token, PASSWORD_DEFAULT);
        $stmt->bindParam(1, $userEmail, PDO::PARAM_STR);
        $stmt->bindParam(2, $selector, PDO::PARAM_STR);
        $stmt->bindParam(3, $hashedToken, PDO::PARAM_STR);
        $stmt->bindParam(4, $expires, PDO::PARAM_STR);
        $stmt->execute();
    }

    $to = $userEmail;
    $subject = "Reset your Password";
    $message = '<p>The link to reset your password is below.</br>';
    $message .= '<p><a href="' . $url .'">' . $url . '</a></p>';

    $headers = "From: Pierre Waters <pierre.alban.waters@gmail.com>\r\n";
    $headers .= "Reply-To: pierre.alban.waters@gmail.com\r\n";
    $headers .= "Content-type: text/html\r\n";

    mail($to, $subject, $message, $headers);

    $emailLog = "Email was sent.";
    $emailLog .= "address:";
    $emailLog .= $to;
    $emailLog .= "Message:";
    $emailLog .= $message;
    
    header("location: login.php?success_message=". $emailLog ."");

} else {
    header("Location: index.php?error_message=Error ocurred");
}