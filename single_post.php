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
                    <div class="comment-wrapper">
                        <img class="icon" src="assets/img/profile.jpeg">
                        <input type="text" class="comment-box" placeholder="Add a comment"/>
                        <button class="comment-btn">comment</button>
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