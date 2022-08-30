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
    <title>Main page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/8da1d76717.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <!--2 main divs: navbar and main 
    each main div includes a wrapper CHANGE -->
    <nav class="navbar"> 
        <div class="nav-wrapper">
            <img src="assets/img/logo.jpg" class="brand-img"/>
            <form class="search-form">
                <input type="text" class="search-box" placeholder="Search"/>
            </form>
            <div class="nav-items">
                <i class="icon fa-solid fa-house-user"></i>
                <i class="icon fas fa-plus"></i>
                <i class="icon fas fa-heart"></i>
                <div class="icon user-profile">
                    <i class="fas fa-user"></i>
                </div>
            </div>
        </div>
    </nav>
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
               
                <div class="post">
                    <div class="info">
                        <div class="user">
                            <div class="profile-pic"><img src="assets/img/profile.jpeg"></div>
                            <p class="username">username</p>
                        </div>
                        <i class="fas fa-ellipsis-h options"></i>
                    </div>
                    <!-- POST CONTENT-->
                    <img src="assets/img/rugby1.jpeg" class="post-img">
                    <div class="post-content">
                        <div class="reaction-wrapper">
                            <i class="icon fas fa-heart"></i>
                            <i class="icon fas fa-comment"></i>
                        </div>
                        <p class="likes">2000 likes</p>
                        <p class="description"><span>username</span> this is a description</p>
                        <p class="post-time">2028/89/88</p>
                    </div>
                    <div class="comment-wrapper">
                        <img class="icon" src="assets/img/profile.jpeg">
                        <input type="text" class="comment-box" placeholder="Add a comment"/>
                        <button class="comment-btn">comment</button>
                    </div>
                </div>
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