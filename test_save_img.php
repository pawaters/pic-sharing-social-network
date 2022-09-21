<?php

$folder = "uploads/images/";
$destinationFolder = "/goinfre/pwaters/mamp/apache2/htdocs/camagru/" . $folder; // you may need to adjust to your server configuration
$maxFileSize = 2 * 1024 * 1024;

$postdata = file_get_contents("php://input");
echo $postdata;
?>