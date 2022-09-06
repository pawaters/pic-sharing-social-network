<?php include("get_following.php");?>
 
    <div class="status-wrapper">

        <?php foreach($other_people as $person){ ?>
            <form method="POST" action="user_profile.php" id="other_user_form">
                <div class="status-card">
                    <input type="hidden" name="other_user_id" value="<?php echo $person['id'];?>">
                    <div class="profile-pic">
                        <img onclick="document.getElementById('other_user_form').submit();" src="<?php echo "assets/img/".$person['image']; ?>">
                    </div>
                    <div class="username"><?php echo $person['username']; ?></div>
                </div>
            </form>
        <?php } ?>
    </div>