<?php include('header.php'); ?>

     <!--main: under wrapper, two divs: left-col, right-col -->
    <section class = "main">
        <div class="wrapper">
            <div class="left-col">
                <div class="status-wrapper">
                    <div class="status-card">
                        <div class="profile-pic">
                            <img src="assets/img/profile.jpeg">
                        </div>
                        <div class="username">username</div>
                    </div>
                    <div class="status-card">
                        <div class="profile-pic">
                            <img src="assets/img/profile.jpeg">
                        </div>
                        <div class="username">username</div>
                    </div>
                    <div class="status-card">
                        <div class="profile-pic">
                            <img src="assets/img/profile.jpeg">
                        </div>
                        <div class="username">username</div>
                    </div>
                    <div class="status-card">
                        <div class="profile-pic">
                            <img src="assets/img/profile.jpeg">
                        </div>
                        <div class="username">username</div>
                    </div>
                    <div class="status-card">
                        <div class="profile-pic">
                            <img src="assets/img/profile.jpeg">
                        </div>
                        <div class="username">username</div>
                    </div>
                    <div class="status-card">
                        <div class="profile-pic">
                            <img src="assets/img/profile.jpeg">
                        </div>
                        <div class="username">username</div>
                    </div>
                    <div class="status-card">
                        <div class="profile-pic">
                            <img src="assets/img/profile.jpeg">
                        </div>
                        <div class="username">username</div>
                    </div>
                    <div class="status-card">
                        <div class="profile-pic">
                            <img src="assets/img/profile.jpeg">
                        </div>
                        <div class="username">username</div>
                    </div>
                    <div class="status-card">
                        <div class="profile-pic">
                            <img src="assets/img/profile.jpeg">
                        </div>
                        <div class="username">username</div>
                    </div>
                    <div class="status-card">
                        <div class="profile-pic">
                            <img src="assets/img/profile.jpeg">
                        </div>
                        <div class="username">username</div>
                    </div>
                    <div class="status-card">
                        <div class="profile-pic">
                            <img src="assets/img/profile.jpeg">
                        </div>
                        <div class="username">username</div>
                    </div>
                    <div class="status-card">
                        <div class="profile-pic">
                            <img src="assets/img/profile.jpeg">
                        </div>
                        <div class="username">username</div>
                    </div>
                </div>
               
                <?php include('get_latest_posts.php'); ?>

                <?php foreach($posts as $post) { ?>

                    <div class="post">
                        <div class="info">
                            <div class="user">
                                <div class="profile-pic"><img src="<?php echo "assets/img/" . $post['profile_image']; ?>"></div>
                                <p class="username"><?php echo $post['username']; ?></p>
                            </div>
                            <i class="fas fa-ellipsis-h options"></i>
                        </div>
                        <!-- POST CONTENT-->
                        <img src="<?php echo "assets/img/" . $post['image']; ?>" class="post-img">
                        <div class="post-content">
                            <div class="reaction-wrapper">
                                <i class="icon fas fa-heart"></i>
                                <i class="icon fas fa-comment"></i>
                            </div>
                            <p class="likes"><?php echo $post['likes'];?> likes</p>
                            <p class="description"><span><?php echo $post['caption']; ?></span><span><?php echo $post['hashtags']; ?></p>
                            <p class="post-time"><?php echo date("M,Y", strtotime($post['date'])); ?></p>
                        </div>
                        <div class="comment-wrapper">
                            <img class="icon" src="assets/img/profile.jpeg">
                            <input type="text" class="comment-box" placeholder="Add a comment"/>
                            <button class="comment-btn">comment</button>
                        </div>
                    </div>
                
                <?php  }  ?>

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
                    <form method="GET" action="logout.php">
                        <button class="logout-btn">logout</button>
                    </form>
                    
                </div>

                <p class="suggestion-text">Suggestions for you</p>
                
                <!-- Suggestions-->

                <?php include("get_suggestions.php")?>

                <?php foreach($suggestions as $suggestion){ ?>
                    
                    <?php if($suggestion['id'] != $_SESSION['id']) { ?>
                    
                        <div class="suggestion-card">
                            <div class="suggestion-pic">
                                <img src="<?php echo "assets/img/".$suggestion['image'];?>" >
                            </div>
                            <div>
                                <p class="username"><?php echo $suggestion[' username'];?></p>
                                <p class="sub-text"><?php echo substr($suggestion['bio'], 0, 15);?></p>
                            </div>
                            <button class="follow-btn">follow</button>
                        </div>
                    <?php } ?>

                <?php } ?>
            </div>
        </div>
    </section>



</body>
</html>