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
    
    <button id="capture-btn" type="submit" >Capture</button>
    <form method="post">
        <button id="sticker-btn" name="sticker-btn">Add croissant</button>
    </form>

    <?php 
        if(isset($_POST['sticker-btn'])) {
            $img = $_POST['img'];
            $new_img = stamp_to_img($img);
        }
    ?>
    
    <script src="test-script.js"></script>
</body>
</html>