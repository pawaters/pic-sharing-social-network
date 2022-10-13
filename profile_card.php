<?php if(!isset($_SESSION['image']) || !isset($_SESSION['username']) || !isset($_SESSION['bio'])) {
        header('location: login.php?error_message=Please log in');
        exit;
    }
?>

<div class="profile-card">
    <div class="profile-pic">
        <img src="<?php echo 'assets/img/'.$_SESSION['image'];?>">
    </div>
    <div>
        <p class="username"><?php echo $_SESSION['username'];?></p>
        <p class="sub-text"><?php echo substr($_SESSION['bio'],0,15);?></p>
    </div>
    <form method="GET" action="logout.php">
        <button class="logout-btn">logout</button>
    </form>
</div>