<!doctype html>
<html>
<head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="video_style.css">
</head>
<body> 
    <?php include('header.php'); ?>
    <?php include('sticker.php'); ?>
    <video id="player" autoplay>VIDEO </video>
    <canvas id="canvas" ></canvas>
    <form method="post">
    <button id="capture-btn" type="submit" >Capture</button>
    </form>
    <button id="sticker-btn">Add croissant</button>


    <?php if(isset($_POST['capture-btn'])) { ?>
            <p> BUTTON PRESSED<?php print_r($_POST);?> </p>
    <?php } ?>

    <?php 
        if(isset($_POST['sticker-btn'])) {
            $new_img = stamp_to_img($img);
        }
    ?>
    
    <script src="test-script.js"></script>
</body>
</html>