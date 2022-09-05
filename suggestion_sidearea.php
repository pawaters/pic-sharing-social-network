<p class="suggestion-text">Suggestions for you</p>
                
<!-- Suggestions-->

<?php include("get_suggestions.php")?>

<?php foreach($suggestions as $suggestion){ ?>
    
    <?php if($suggestion['id'] != $_SESSION['id']) { ?>
    
        <div class="suggestion-card">
            <div class="suggestion-pic">
                <img src="<?php echo "assets/img/".$suggestion['image'];?>" >
            </div>
            <div>
                <p class="username"><?php echo $suggestion[' username'];?></p>
                <p class="sub-text"><?php echo substr($suggestion['bio'], 0, 15);?></p>
            </div>
            <form action="follow_this_person.php" method="POST">
                <input type="hidden" name="other_user_id" value="<?php echo $suggestion['id'];?>">
                <button class="follow-btn" name="follow_btn" type="submit">follow</button>
            </form>
            
        </div>
    <?php } ?>

<?php } ?>