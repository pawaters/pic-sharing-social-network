<?php

$to = "pierre.alban.waters@gmail.com";
$subject = "test subject";
$message = "test message";
$headers = "From: Pierre Waters <pierrealbanwaters@proton.com>\r\n";
$headers .= "Reply-To: pierrealbanwaters@proton.com\r\n";
$headers .= "Content-type: text/html\r\n";

mail($to, $subject, $message, $headers);

?>