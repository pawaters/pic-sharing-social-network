<?php include("get_my_followings.php");?>


<?php if(!isset($other_people)) { ?>


<?php }else { ?>    

        <div class="status-wrapper">

        <?php foreach($other_people as $person){?>
            <form method="POST" action="other_user_profile.php" id="other_user_form<?php echo $person['id'];?>">
            <div class="status-card">
                <input type="hidden" name="other_user_id" value="<?php echo $person['id'];?>">
                <div class="profile-pic">
                    <img onclick="document.getElementById('other_user_form'+<?php echo $person['id'];?>).submit();" src="<?php echo "assets/img/".$person['image']; ?>"/>
                </div>
                <p class="username"><?php echo $person['username'];?></p>
            </div>
            </form>
            <?php } ?>

        </div>



<?php } ?>