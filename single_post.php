<?php include('header.php'); ?>

<?php 

include('connection.php');

if(isset($_GET['post_id']))
{
    $post_id = $_GET['post_id'];
    $stmt = $conn->prepare("SELECT * FROM posts WHERE id = ?");
    $stmt->bind_param('i', $post_id); 
    $stmt->execute();
    $post_array = $stmt->get_result();
}
else
{
    header('location: index.php');
    exit;
}

?>

     <!--main: under wrapper, two divs: left-col, right-col -->
    <section class = "main single-post-container">
        <div class="wrapper">
            <div class="left-col">

                <?php if(isset($_GET['success_message'])) {?>
                    <p class="text-center alert-success"><?php echo $_GET['success_message']; ?></p>
                <?php } ?>
                <?php if(isset($_GET['error_message'])){ ?>
                <p class="text-center alert-danger"><?php echo $_GET['error_message'];?></p>
                <?php } ?>

                <?php foreach($post_array as $post) { ?>

                <div class="post">
                    <div class="info">
                        <div class="user">
                            <div class="profile-pic"><img src="<?php echo 'assets/img/'.$post['profile_image'];?>"/></div>
                            <p class="username"><?php echo $post['username'];?></p>
                        </div>
                    </div>
                    <!-- POST CONTENT--> 
                    <img src="<?php echo 'assets/img/'.$post['image'];?>" class="post-img">
                    <div class="post-content">
                        <div class="reaction-wrapper">
                            <!-- <i class="icon fas fa-heart"></i>
                            <i class="icon fas fa-comment"></i> -->
                        </div>
                        <p class="likes"><?php echo $post['likes'];?> likes</p>
                        <p class="description"><span><?php echo $post['caption'];?></span> <?php echo $post['hashtags'];?></p>
                        <p class="post-time"><?php echo date("M,Y", strtotime($post['date'])); ?></p>

                    </div>

                    <div class="comment-element">
                        <img src="assets/img/1.jpeg" class="icon">
                        <p>this is a comment <span>datelooooool</span></p>

                    </div>
                    <div class="comment-element">
                        <img src="assets/img/1.jpeg" class="icon">
                        <p>this is a comment <span>datelooooool</span></p>

                    </div>
                    <div class="comment-element">
                        <img src="assets/img/1.jpeg" class="icon">
                        <p>this is a comment <span>datelooooool</span></p>

                    </div>


                    <div class="comment-wrapper">
                        <img class="icon" src="assets/img/profile.jpeg">
                        <form class="comment-wrapper" action="store_comment.php" method="POST">
                            <input type="hidden" name="post_id" value="<?php echo $post['id'];?>">
                            <input type="text" class="comment-box" name="comment_text" placeholder="Add a comment"/>
                            <button class="comment-btn" name="comment_btn" type="submit">comment</button>
                        </form>

                    </div>
                </div>

                <?php } ?>
            </div>

            <div class="right-col">
            
                <!-- Profile card-->
                <div class="profile-card">
                    <div class="profile-pic">
                        <img src="assets/img/profile.jpeg">
                    </div>
                    <div>
                        <p class="username">username</p>
                        <p class="sub-text">sub-text</p>
                    </div>
                    <button class="logout-btn">logout</button>
                </div>

                <p class="suggestion-text">Suggestions for you</p>
                
                <!-- Suggestions-->
                <div class="suggestion-card">
                    <div class="suggestion-pic">
                        <img src="assets/img/profile.jpeg">
                    </div>
                    <div>
                        <p class="username">username</p>
                        <p class="sub-text">sub-text</p>
                    </div>
                    <button class="follow-btn">follow</button>
                </div>
                <div class="suggestion-card">
                    <div class="suggestion-pic">
                        <img src="assets/img/profile.jpeg">
                    </div>
                    <div>
                        <p class="username">username</p>
                        <p class="sub-text">sub-text</p>
                    </div>
                    <button class="follow-btn">follow</button>
                </div>
                <div class="suggestion-card">
                    <div class="suggestion-pic">
                        <img src="assets/img/profile.jpeg">
                    </div>
                    <div>
                        <p class="username">username</p>
                        <p class="sub-text">sub-text</p>
                    </div>
                    <button class="follow-btn">follow</button>
                </div>

            </div>
        </div>
    </section>



</body>
</html>