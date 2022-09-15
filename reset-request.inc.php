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

    $sql = "DELETE FROM pwdReset WHERE pwdResetEmail = ?";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: login.php?error_message=SQL error");
        exit();
    } else {
        mysqli_stmt_bind_param($stmt, "s", $userEmail);
        mysqli_stmt_execute($stmt);
    }
    //WHEN INSERTING, ALWAYS THINK "Is there any sensitive data to hash"
    $sql = "INSERT INTO pwdReset (pwdResetEmail, pwdResetSelector, pwdResetToken, pwdResetExpires) VALUES (?,?,?,?);" ;
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: login.php?error_message=SQL error");
        exit();
    } else {
        $hashedToken = password_hash($token, PASSWORD_DEFAULT);
        mysqli_stmt_bind_param($stmt, "ssss", $userEmail, $selector, $hashedToken, $expires);
        mysqli_stmt_execute($stmt);
    }

    mysqli_stmt_close($stmt);
    //mysqli_close($sql);

    $to = $userEmail;
    $subject = "Reset your Password";
    $message = '<p>The link to reset your password is below.</br>';
    $message .= '<p><a href="' . $url .'">' . $url . '</a></p>';

    $headers = "From: Pierre Waters <pierre.alban.waters@gmail.com>\r\n";
    $headers .= "Reply-To: pierre.alban.waters@gmail.com\r\n";
    $headers .= "Content-type: text/html\r\n";

    mail($to, $subject, $message, $headers);

    header("location: login.php?success_message=Password_was_reset");

} else {
    header("Location: index.php?error_message=Error ocurred");
}