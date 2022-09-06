<?php include('header.php');  ?>

<?php

    include('connection.php');

    if(isset($_POST['other_user_id'])) {

        $other_user_id = $_POST['other_user_id'];
        $stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->bind_param("i",$other_user_id); 
        
        if($stmt->execute()){
            $user_array = $stmt->get_result();
        }
        else
        {
            header('location: index.php');
            exit;
        }
    }
    else
    {
        header('location: index.php');
        exit;
    }

?>

<!--TO DO: how to decide how many levels of containers to hav -->
    <header class="profile-header">
        <div class="profile-container">
            
            <?php foreach($user_array as $user) { ?>
                <div class="profile">
                    <div class="profile-image">
                        <img src="<?php echo "assets/img/".$user['image']?>">
                    </div>
                    <div class="profile-user-settings">
                        <h1 class="profile-user-name"><?php echo $user['username']?></h1>
                    </div>
                    <div class="profile-stats">
                        <ul>
                            <li><span class="profile-stat-count"><?php echo $user['posts']?></span> posts</li>
                            <li><span class="profile-stat-count"><?php echo $user['followers']?></span> followers</li>
                            <li><span class="profile-stat-count"><?php echo $user['following']?></span> following</li>
                        </ul>
                        <!--TO DO: improve naming and separate CSS files -->
                        <form action="">
                            <button type="submit" class="follow-btn-user-profile">Follow</button>
                        </form>
                    </div>
                    <div class="profile-bio">
                        <p> <span class="profile-real-name"><?php echo $user['username']?> </span><?php echo substr($user['bio'],0,15)?></p>
                    </div>
                </div>
            <?php } ?>
        </div>
    </header>

    <main>
        <div class="profile-container">
            <div class="gallery">

            <?php include("get_other_user_posts.php"); ?>

                <?php foreach($posts as $post) { ?>          
                    <div class="gallery-item">
                        <img src="<?php echo "assets/img/".$post['image'];?>" class="gallery-image">
                        <div class="gallery-item-info">
                            <ul>
                                <li class="gallery-item-likes"><span class="hide-gallery-element"><?php echo "assets/img/".$post['likes'];?></span>
                                    <i class="fas fa-heart"></i>
                                </li>
                                <li class="gallery-item-comments"><span class="hide-gallery-element"></span>
                                    <i class="fas fa-comment"></i>
                                </li>
                            </ul>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </main>
    

    
</body>
</html>