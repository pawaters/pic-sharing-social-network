<?php include("header.php"); ?>
    
    <div class="camera-container">

        <?php if(isset($_GET['success_message'])) { ?>
            <p class="mt-4 text-center alert-success"><?php echo $_GET['success_message']; ?> </p>
        <?php } ?>

        <?php if(isset($_GET['error_message'])) { ?>
            <p class="mt-4 text-center alert-danger"><?php echo $_GET['error_message']; ?> </p>
        <?php } ?>
         
        <div class="camera">
            <div class="camera-image">
                <form class="camera-form" method="POST" action="create_camera_post.php" enctype="multipart/form-data">
                    <div>
                        <p class="sticker-description">1. Choose a sticker to jazz up your awesome photo!</p>
                            <div class="stickers-box">
                                <div class="stickers-container">
                                    <img class="sticker" src="assets/stickers/different.png" alt="rugby-sticker" id="sticker1">
                                    <img class="sticker" src="assets/stickers/football.png" alt="rugby-sticker" id="sticker2">
                                    <img class="sticker" src="assets/stickers/love.png" alt="rugby-sticker" id="sticker3">
                                    <img class="sticker" src="assets/stickers/pink.png" alt="rugby-sticker" id="sticker4">
                                    <img class="sticker" src="assets/stickers/rugby.png" alt="rugby-sticker" id="sticker5">
                                    <img class="sticker" src="assets/stickers/vibes.png" alt="rugby-sticker" id="sticker6">
                                </div>
                            </div>
                    </div>
                    <p style="margin-top: 30px;" class="sticker-description">2. Take an awesome awesome photo!</p>
                    <button class="capture-btn" id="start-camera">Start Camera</button>
                    <div>
                        <video class="is-hidden" id="video" width="700" height="500" autoplay></video>
                    </div>
                    <button class="capture-btn" id="click-photo">Capture Photo</button>
                    <p style="margin-top: 30px;" class="sticker-description">The awesome photo you have taken:</p>
                    <div style="position:relative;">
                        <div style="position:absolute; ">
                            <canvas class="is-hidden" width="700" height="500" id="canvas"></canvas>
                            <input type="hidden" id="webcam-file" value="" name="webcam_file">
                        </div>
                        <!-- <p style="margin-top: 30px;" class="sticker-description">The stickers you have chosen:</p> -->
                        <div style="position:relative; ">
                            <canvas class="is-hidden" width="700" height="500" id="stickers_canvas"></canvas>
                            <input type="hidden" id="sticker-canvas" value="" name="sticker-canvas">
                            <input type="hidden" id="sticker1_path" value="" name="sticker1_path">
                            <input type="hidden" id="sticker2_path" value="" name="sticker2_path">
                            <input type="hidden" id="sticker3_path" value="" name="sticker3_path">
                            <input type="hidden" id="sticker4_path" value="" name="sticker4_path">
                            <input type="hidden" id="sticker5_path" value="" name="sticker5_path">
                            <input type="hidden" id="sticker6_path" value="" name="sticker6_path">
                        </div>
                    </div>
                    <div class="control">
                        <input type="text" class="my-input input" name="caption" placeholder="Write a caption here" required>
                    </div>
                    <div class="control" >
                        <input type="text" class="my-input input" name="hashtags" placeholder="Add hashtags here" required>
                    </div>
                    <div>
                        <button type="submit" class="upload-btn" name="webcam_img_btn">Publish</button>
                    </div>
                </form>
            </div>
        </div>

    </div>
    
</body>
</html>