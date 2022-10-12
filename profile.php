<?php include("header.php") ?>
    <header class="profile-header">
        
        <div class="profile-container">
                <?php if(isset($_GET['success_message'])) {?>
                    <p class="text-center alert alert-success"><?php echo $_GET['success_message']; ?></p>
                <?php } ?>
                <?php if(isset($_GET['error_message'])){ ?>
                <p class="text-center alert alert-danger"><?php echo $_GET['error_message'];?></p>
            <?php } ?>   
            <!--TIP: for every profile card, create 2 divs, and image -->
            <div class="profile">
                <div class="profile-image">
                    <img src="<?php echo "assets/img/".$_SESSION['image']; ?>" alt="profile pic">
                </div>
                <div class="profile-user-settings">
                    <h1 class="profile-user-name">
                        <?php echo $_SESSION['username'] ?>
                    </h1>

                    <form action="edit_profile.php" method="GET" style="display:inline-block">
                        <button class="profile-btn profile-edit-btn" type="submit" >Edit Profile</button>
                    </form>
                    
                    <button class="profile-btn profile-settings-btn" id="options_btn" aria-label="profile settings">
                        <i class="fas fa-cog"></i>
                    </button>

                    <div class="popup" id="popup">
                        <div class="popup-window">
                                <span class="close-popup" id="close-popup">&times;</span>
                                <a href="edit_profile.php">Edit profile</a>
                                <a href="camera.php">Create post</a>
                                <?php if($_SESSION['notify'] == 1) { ?>
                                    <a href="stop_notif.php">Stop notifications</a>  
                                <?php } else { ?>
                                    <a href="start_notif.php">Activate notifications</a>  
                                <?php } ?>
                                
                                <a href="logout.php">Logout</a>
                        </div> 
                    </div>

                </div>
                <div class="profile-stats">
                    <ul>
                        <li><span class="profile-stat-count"><?php echo $_SESSION['post'] ?></span> posts </li>
                        <form action="my_followers.php" method="POST" style="display: inline-block;">
                            <li><span class="profile-stat-count"><?php echo $_SESSION['followers'] ?></span> <input value="followers" type="submit" style="background:none; border: none; "></li>
                        </form>
                        <form action="my_followings.php" method="POST" style="display: inline-block;">
                            <li><span class="profile-stat-count"><?php echo $_SESSION['following'] ?></span> <input value="following" type="submit" style="background:none; border: none; "></li>
                        </form>
                    </ul>
                </div>
                <div class="profile-bio">
                    <p> <span class="profile-real-name"><?php echo $_SESSION['username'] . ", " ?> </span> <?php echo $_SESSION['bio'] ?> </p>
                </div>
            </div>

        </div>
    </header>

    <main>
        <div class="profile-container">
            <div class="gallery">

                <?php include("get_user_posts.php"); ?>

                <?php foreach($posts as $post) { ?>          
                    <div class="gallery-item">
                        <img src="<?php echo "assets/img/".$post['image'];?>" class="gallery-image">
                        <div class="gallery-item-info">
                            <ul>
                                <li class="gallery-item-likes"><span class="hide-gallery-element"><?php echo "assets/img/".$post['likes'];?></span>
                                    <i class="fas fa-heart"></i>
                                </li>
                                <li class="gallery-item-comments"><span class="hide-gallery-element"></span>
                                    <a style="color: white" href="single_post.php?post_id=<?php echo $post['id'] ?>"><i class="fas fa-comment"></i></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>

        <!-- PAGINATION -->
        <nav aria-label="Page navigation example" style="display:flex; justify-content: center">
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

    </main>
    
    <script>
        var popupWindow = document.getElementById('popup');
        var optionsBtn = document.getElementById('options_btn');
        var closeWindow = document.getElementById('close-popup');

        optionsBtn.addEventListener("click",(e)=>{
            e.preventDefault();
            popupWindow.style.display = "block";
        })

        closeWindow.addEventListener("click",(e)=>{
            e.preventDefault();
            popupWindow.style.display = "none";
        })

        window.addEventListener("click",(e)=>{
            if(e.target == popupWindow)
            {
                popupWindow.style.display = "none";
            }
        })


    </script>

    
</body>
</html>