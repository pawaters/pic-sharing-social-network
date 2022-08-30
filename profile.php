<?php

session_start();

// if not logged in, send to login page
if(!isset($_SESSION['id'])){
    header('location: login.php');
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Profile</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/8da1d76717.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<!--TO DO: how to decide how many levels of containers to hav -->
    <header class="profile-header">
        <div class="profile-container">
            <!--TIP: for every profile card, create 2 divs, and image -->
            <div class="profile">
                <div class="profile-image">
                    <img src="<?php echo "assets/img/" . $_SESSION['image'] ?>" alt="profile pic">
                </div>
                <div class="profile-user-settings">
                    <h1 class="profile-user-name">
                        <?php echo $_SESSION['username'] ?>
                    </h1>
                    <button class="profile-btn profile-edit-btn">Edit Profile</button>
                    <button class="profile-btn profile-settings-btn" aria-label="profile settings">
                        <i class="fas fa-cog"></i>
                    </button>
                </div>
                <div class="profile-stats">
                    <ul>
                        <li><span class="profile-stat-count"><?php echo $_SESSION['post'] ?></span> posts</li>
                        <li><span class="profile-stat-count"><?php echo $_SESSION['followers'] ?></span> followers</li>
                        <li><span class="profile-stat-count"><?php echo $_SESSION['following'] ?></span> following</li>
                    </ul>
                </div>
                <div class="profile-bio">
                    <p> <span class="profile-real-name"><?php echo $_SESSION['username'] ?> </span> <?php echo $_SESSION['bio'] ?> </p>
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