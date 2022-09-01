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
            <button class="follow-btn">follow</button>
        </div>
    <?php } ?>

<?php } ?>