<?php include("header.php") ?>

     <!--main: under wrapper, two divs: left-col, right-col -->
    <section class = "main">
        <div class="wrapper">
            <div class="left-col">

            <h3 class="text-center">Update Profile</h3>

                <?php if(isset($_GET['error_message'])) {?>
                    <p class="text-center alert-danger"><?php echo $_GET['error_message']; ?></p>
                <?php } ?>
    <!-- bootstrap for forms: form-label, label, form-control -->
    <!-- always use enctype="multipart/form-data" when using <input type="file"> data -->
                <form action="update_profile.php" method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <img src="<?php echo "assets/img/".$_SESSION['image']; ?>" class="edit-profile-image">
                        <input type="file" name="image" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <p class="form-control"><?php echo $_SESSION['email']; ?></p>
                    </div>
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" name="username" id="username" placeholder="username" required value= <?php echo $_SESSION['username']; ?> >
                    </div>
                    <div class="mb-3">
                        <label for="bio" class="form-label">Bio</label>
                        <textarea class="form-control" name="bio" id="bio" placeholder="Bio" cols="30" rows="3"><?php echo $_SESSION['bio']; ?></textarea>
                    </div>
                    <div class="mb-3">
                        <input name="update_profile_btn" type= "submit" id="update_profile_btn" class="update-profile-btn" value="Update">
                    </div>
                </form>
            </div>

            <div class="right-col">
            
                <!-- Profile card-->
                <?php include("profile_card.php"); ?>
                
                <!-- Suggestions-->
                <?php include("suggestion_side_area.php"); ?>
            </div>
        </div>
    </section>



</body>
</html>