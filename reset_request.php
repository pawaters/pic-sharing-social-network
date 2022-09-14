<?php 

//connect to a submit button (PENDING)
if(isset($POST["reset-request-submit"])) {

    // 1 token for auth, 1 token to look in the db, to prevent timing attacks (RESEARCH)
    $selector = bin2hex(random_bytes(8));
    $token = random_bytes(32);

    $url = "create-new-password.php?selector=" . $selector . "&validator=" . bin2hex($token);
    //TO DO : CREATE.
    $expires = date("U") + 1800;


} else {
    header("Location: index.php");
}