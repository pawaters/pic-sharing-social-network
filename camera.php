<?php include("header.php"); ?>
    <div class="camera-container">
        <div class="camera">
            <div class="camera-image">
                <img src="assets/img/rugby1.jpeg" alt="">
                <form class="camera-form" method="POST" action="create_post.php" enctype="multipart/form-data">
                    <div class="form-group">
                        <input type="file" name="image" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <input type="text" name="caption" class="form-control" placeholder="type caption ..."  required>
                    </div>
                    <div class="form-group">
                        <input type="text" name="hashtags" class="form-control" placeholder="type hashtags ..."  required>
                    </div>
                    <div class="form-group">
                        <button type="submit" name="upload_image_btn" class="upload-btn">Post</button>
                    </div>
                </form>
            </div>
        </div>

    </div>
    
</body>
</html>