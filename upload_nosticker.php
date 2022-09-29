<?php 
require_once('header_no_login.php');
include('sticker.php');
?>

    
<div class="upload-container">

    <?php if(isset($_GET['success_message'])) { ?>
        <p class="mt-4 text-center alert-success"><?php echo $_GET['success_message']; ?> </p>
    <?php } ?>

    <?php if(isset($_GET['error_message'])) { ?>
        <p class="mt-4 text-center alert-danger"><?php echo $_GET['error_message']; ?> </p>
    <?php } ?>

    <div class="upload">
        <div class="upload-image">

            <form class="upload-form" method="POST" action="create_post.php" enctype="multipart/form-data">
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