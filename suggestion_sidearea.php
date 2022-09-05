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
            <form action="follow_this_person.php" method="POST>
                <input type="text" name="other_user" value="<?php echo $suggestion['id'];?>" type="hidden">
                <button class="follow-btn" name="follow_btn" type="submit">follow</button>
            </form>
            
        </div>
    <?php } ?>

<?php } ?>