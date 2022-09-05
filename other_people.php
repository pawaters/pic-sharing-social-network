<?php include("get_following.php");?>
 
    <div class="status-wrapper">

        <?php foreach($other_people as $person){ ?>
            <div class="status-card">
                <div class="profile-pic">
                    <img src="<?php echo "assets/img/".$person['image']; ?>">
                </div>
                <div class="username"><?php echo $person['username']; ?></div>
            </div>
        <?php } ?>
    </div>