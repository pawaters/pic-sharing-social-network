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
        print_r($_POST);
        echo $_POST['txt'];
        if(isset($_POST['sticker-btn'])) {
            print_r($_POST);
            // $new_img = stamp_to_img($img);
        }
    ?>
    <script src="test-script.js"></script>
    <!-- <script --> 
        <!-- INCLUDE SCRIPT -->
        <!-- DO SIMPLE EXAMPLE WITH FORMDATA AND FETCH API -->
</body>
</html>