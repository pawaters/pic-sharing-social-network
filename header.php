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
            <form class="search-form" action="search_posts.php" method="POST">
                <input type="text" class="search-box" placeholder="Search" name="search_input"/>
            </form>
            <div class="nav-items">
                <a href="index.php" style="color: #000;"><i class="icon fa-solid fa-house-user"></i></a>
                <a href="discover.php" style="color: #000;"><i class="icon fas fa-plus"></i></a>
                <i class="icon fas fa-heart"></i>
                <div class="icon user-profile">
                    <a href="profile.php" style="color: #000;"><i class="fas fa-user"></i></a>
                </div>
            </div>
        </div>
    </nav>