<?php include("header.php") ?>
<!--TO DO: how to decide how many levels of containers to hav -->
    <header class="profile-header">
        
        <div class="profile-container">
                <?php if(isset($_GET['success_message'])) {?>
                    <p class="text-center alert-success"><?php echo $_GET['success_message']; ?></p>
                <?php } ?>
                <?php if(isset($_GET['error_message'])){ ?>
                <p class="text-center alert-danger"><?php echo $_GET['error_message'];?></p>
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
                    
                    <button class="profile-btn profile-settings-btn" aria-label="profile settings">
                        <i class="fas fa-cog"></i>
                    </button>

                    <div class="popup" id="popup">
                        <div class="popup-window">
                                <span class="close-popup">&times;</span>
                                <a href="">Edit profile</a>
                                <a href="">Create post</a>
                                <a href="">Logout</a>
                        </div>
                    </div>

                </div>
                <div class="profile-stats">
                    <ul>
                        <li><span class="profile-stat-count"><?php echo $_SESSION['post'] ?></span> posts</li>
                        <li><span class="profile-stat-count"><?php echo $_SESSION['followers'] ?></span> followers</li>
                        <li><span class="profile-stat-count"><?php echo $_SESSION['following'] ?></span> following</li>
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
                <div class="gallery-item">
                    <img src="assets/img/flower.jpeg" class="gallery-image">
                    <div class="gallery-item-info">
                        <ul>
                            <li class="gallery-item-likes"><span class="hide-gallery-element">12</span>
                                <i class="fas fa-heart"></i>
                            </li>
                            <li class="gallery-item-comments"><span class="hide-gallery-element">9</span>
                                <i class="fas fa-comment"></i>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="gallery-item">
                    <img src="assets/img/1637340434.jpeg" class="gallery-image">
                    <div class="gallery-item-info">
                        <ul>
                            <li class="gallery-item-likes"><span class="hide-gallery-element">Likes:</span>
                                <i class="fas fa-heart"></i>
                            </li>
                            <li class="gallery-item-comments"><span class="hide-gallery-element">Comments:</span>
                                <i class="fas fa-comment"></i>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="gallery-item">
                    <img src="assets/img/1637340466.jpeg" class="gallery-image">
                    <div class="gallery-item-info">
                        <ul>
                            <li class="gallery-item-likes"><span class="hide-gallery-element">Likes:</span>
                                <i class="fas fa-heart"></i>
                            </li>
                            <li class="gallery-item-comments"><span class="hide-gallery-element">Comments:</span>
                                <i class="fas fa-comment"></i>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="gallery-item">
                    <img src="assets/img/1637340493.jpeg" class="gallery-image">
                    <div class="gallery-item-info">
                        <ul>
                            <li class="gallery-item-likes"><span class="hide-gallery-element">Likes:</span>
                                <i class="fas fa-heart"></i>
                            </li>
                            <li class="gallery-item-comments"><span class="hide-gallery-element">Comments:</span>
                                <i class="fas fa-comment"></i>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </main>
    

    
</body>
</html>