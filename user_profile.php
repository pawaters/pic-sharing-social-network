<?php include('header.php');  ?>

<?php

    include('connection.php');

    //
    if(isset($_POST[($other_user_id)])) {

        $other_user_id = $_POST[($other_user_id)];
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
            <!--TIP: for every profile card, create 2 divs, and image -->
            <div class="profile">
                <div class="profile-image">
                    <img src="assets/img/profile.jpeg" alt="">
                </div>
                <div class="profile-user-settings">
                    <h1 class="profile-user-name">username</h1>
                </div>
                <div class="profile-stats">
                    <ul>
                        <li><span class="profile-stat-count">25</span> posts</li>
                        <li><span class="profile-stat-count">12</span> followers</li>
                        <li><span class="profile-stat-count">9</span> following</li>
                    </ul>
                    <!--TO DO: improve naming and separate CSS files -->
                    <form action="">
                        <button type="submit" class="follow-btn-user-profile">Follow</button>
                    </form>
                </div>
                <div class="profile-bio">
                    <p> <span class="profile-real-name">Name </span>This is my bio area with my css. I added more text to see what happens with responsive.</p>
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
                    <img src="assets/img/flower.jpeg" class="gallery-image">
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
                    <img src="assets/img/flower.jpeg" class="gallery-image">
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
                    <img src="assets/img/flower.jpeg" class="gallery-image">
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