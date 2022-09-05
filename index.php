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

                            <div>
                            <a class="comment-btn" href="single_post.php?post_id=<?php echo $post['id']; ?>">comments</a>
                            </div>
                        </div>

                    </div>
                
                <?php  }  ?>

                <!-- PAGINATION -->
                <nav aria-label="Page navigation example" class="mx-auto mt-3">
                    <ul class="pagination">
                        <li class="page-item <?php if($page_no<=1){echo 'disabled';}?>">
                            <a class="page-link" href="<?php if($page_no<=1){echo '#';}else{echo '?page_no='.($page_no-1);}?>">Previous</a>
                        </li>
                        <li class="page-item"><a class="page-link" href="?page_no=1">1</a></li>
                        <li class="page-item"><a class="page-link" href="?page_no=2">2</a></li>
                        <li class="page-item"><a class="page-link" href="?page_no=3">3</a></li>
                        
                        <?php if($page_no >= 3) { ?>

                            <li class="page-item"><a class="page-link" href="#">...</a></li>
                            <li class="page-item"><a class="page-link" href="<?php echo '?page_no='.$page_no; ?>"></a></li>

                        <?php } ?>
                        
                        <li class="page-item <?php if($page_no>= $total_no_of_pages){echo 'disabled';}?>">
                            <a class="page-link" href="<?php if($page_no>= $total_no_of_pages){echo '#';}else{echo '?page_no='.($page_no+1);}?>">Next</a>
                        </li>
                    </ul>
                </nav>

            </div>

            <div class="right-col">
            
                <!-- Profile card-->
                <?php include('profile_card.php'); ?>
                
                <!-- Suggestions-->
                <?php include('suggestion_sidearea.php'); ?>

                
            </div>
        </div>
    </section>



</body>
</html>