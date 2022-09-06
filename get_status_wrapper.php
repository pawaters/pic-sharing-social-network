<?php include("get_my_followings.php");?>
 
    <div class="status-wrapper">

        <?php foreach($other_people as $person){ ?>
            <form id="other_user_form<?php echo $person['id'];?>" method="POST" action="other_user_profile.php">
                <div class="status-card">
                    <input type="hidden" name="other_user_id" value="<?php echo $person['id'];?>">
                    <div class="profile-pic">
                        <img onclick="document.getElementById('other_user_form<?php echo $person['id'];?>').submit();" src="<?php echo "assets/img/".$person['image']; ?>">
                    </div>
                    <div class="username"><?php echo $person['username']; ?></div>
                </div>
            </form>
        <?php } ?>
    </div>