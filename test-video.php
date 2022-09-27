<!doctype html>
<html>
<head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="video_style.css">
</head>
<body> 
    <?php include('header_no_login.php'); ?>
    <?php include('sticker.php'); ?>
    <video id="player" autoplay>VIDEO </video>
    <canvas id="canvas" ></canvas>

    
    <form method="post">
        <input type="hidden" id="webcame-file" value="" name="webcam_file">
        <button id="capture-btn" type="submit" >Capture</button>
    </form>

    <?php 
        print_r($_POST); 
    ?>
    <script src="test-script.js"></script>

</body>
</html>