<?php

session_start();

session_unset();
session_destroy();

header("location: login.php?success_message=You are logged out and have terminated your session.");
exit;

?>