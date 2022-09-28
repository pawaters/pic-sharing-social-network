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
        
        <input type="hidden" id="webcam-file" value="" name="webcam_file">
        <button id="capture-btn" >Capture</button>
        
    </form>

    <?php  
        $webcam_file = $_POST['webcam_file'];
        echo ("POST webcam_file\r\n<br/>");
        print_r($webcam_file);
        list($type, $data_url) = explode(';', $webcam_file);
        list(, $data_url) = explode(',', $data_url);
        echo ("<br/>type:\r\n<br/>");
        print_r($type);
        echo ("<br/>data_url:\r\n<br/>");
        print_r($data_url);
        $decoded_url = base64_decode($data_url);
        // echo ("<br/>decoded_url:\r\n<br/>");
        // print_r($decoded_url);
        $webcam_img = imagecreatefromstring($decoded_url);
        
        //output the image
        // header('Content-Type: image/png');
        // imagepng($webcam_img);
        // imagedestroy($webcam_img);
        
        echo $destination;
        // $new_img = stamp_to_img($destination);
        // echo $new_img;

    ?>
    <script src="test-script.js"></script>

</body>
</html>