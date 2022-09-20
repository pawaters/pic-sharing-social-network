<?php include('header.php'); ?>

<?php 

include('connection.php');

if(isset($_GET['post_id']))
{
    $post_id = $_GET['post_id'];
    $conn = connect_PDO();
    $stmt = $conn->prepare("SELECT * FROM posts WHERE id = ?"); 
    $stmt->bindParam(1, $post_id, PDO::PARAM_INT);
    $stmt->execute();
    $post_array = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // GET & PAGINATE COMMENTS

    if(isset($_GET['page_no']) && $_GET['page_no'] != "")
    {
        $page_no = $_GET['page_no'];
    } 
    else 
    {
        $page_no = 1;
    }
    
    $stmt = $conn->prepare("SELECT COUNT(*) as total_comments 
                            FROM comments
                            WHERE post_id = ?");
    $stmt->bindParam(1, $post_id, PDO::PARAM_INT);
    $stmt->execute();

    $total_comments = $stmt->fetchColumn();
    
    $total_comments_per_page = 6;
    
    $offset = ($page_no - 1) * $total_comments_per_page;
    
    $total_no_of_pages = ceil($total_comments / $total_comments_per_page);
    
    $stmt = $conn->prepare("SELECT * FROM comments WHERE post_id = $post_id LIMIT $offset, $total_comments_per_page"); 
    $stmt->execute();

    $comments = $stmt->fetchAll();
}
else
{
    header('location: index.php');
    exit;
}

?>

     <!--main: under wrapper, two divs: left-col, right-col -->
    <section class = "main single-post-container">
        <div class="wrapper">
            <div class="left-col">

                <?php if(isset($_GET['success_message'])) {?>
                    <p class="text-center alert-success"><?php echo $_GET['success_message']; ?></p>
                <?php } ?>
                <?php if(isset($_GET['error_message'])){ ?>
                <p class="text-center alert-danger"><?php echo $_GET['error_message'];?></p>
                <?php } ?>

                <?php foreach($post_array as $post) { ?>

                <div class="post">
                    <div class="info">
                        <div class="user">
                            <div class="profile-pic"><img src="<?php echo 'assets/img/'.$post['profile_image'];?>"/></div>
                            <p class="username"><?php echo $post['username'];?></p>
                        </div>  

                    <!-- Options button only appears if user owns post -->
                        <?php if($post['user_id'] == $_SESSION['id']) { ?>
                            <button class="profile-btn profile-settings-btn" id="options_btn" aria-label="profile settings">
                                <i class="fas fa-ellipsis-h options"></i>
                            </button>  
                        <?php } ?>
                    </div>

                    <!-- Popup that appears when click on Options button-->
                    <div class="popup" id="popup">
                        <div class="popup-window">
                                <span class="close-popup" id="close-popup">&times;</span>
                                <a href="edit_post.php?post_id=<?php echo $post['id'];?>">Edit post</a>
                                <form action="delete_post.php" method="POST" >
                                    <input type="hidden" name="post_id" value="<?php echo $post['id']; ?>">
                                    <input class="delete-post-btn" type="submit" name="delete_post_btn" value="Delete post">
                                </form>
                        </div>
                    </div>

                    <!-- POST CONTENT--> 
                    <img src="<?php echo 'assets/img/'.$post['image'];?>" class="post-img">
                    <div class="post-content">
                        <div class="reaction-wrapper">
                            <i class="icon fas fa-heart"></i>
                            <i class="icon fas fa-comment"></i>
                        </div>
                        <p class="likes"><?php echo $post['likes'];?> likes</p>
                        <p class="description"><span><?php echo $post['caption'];?></span> <?php echo $post['hashtags'];?></p>
                        <p class="post-time"><?php echo date("M,Y", strtotime($post['date'])); ?></p>

                    </div>

                    <?php foreach($comments as $comment) { ?> 
                        <div class="comment-element">
                            <img src="<?php echo 'assets/img/'.$comment['profile_image'];?>" class="icon">
                            <p><?php echo $comment['comment_text'];?><span><?php echo date("M,Y", strtotime($comment['date'])); ?></span></p>

                            <!-- Comment options button only appears if user owns post -->
                            <?php if($comment['user_id'] == $_SESSION['id']) { ?>
                                <button onclick="document.getElementById('popup_comment<?php echo $comment['id'];?>').style.display = 'block'" class="profile-btn profile-settings-btn" id="c_options_btn" aria-label="profile settings">
                                    <i class="fas fa-edit"></i>
                                </button>   
                            <?php } ?>

                            <!-- Popup that appears when click on Options button-->
                            <div class="popup" id="popup_comment<?php echo $comment['id'];?>">
                                <div class="popup-window">
                                        <span onclick="document.getElementById('popup_comment<?php echo $comment['id'];?>.style.display = 'none'')" class="close-popup" id="close-popup<?php echo $comment['id'];?>" style="font-size= 30px;" >&times;</span>
                                        <a href="edit_comment.php?comment_id=<?php echo $comment['id'];?>&post_id=<?php echo $post['id'];?>">Edit comment</a>
                                        <form action="delete_comment.php" method="POST" >
                                            <input type="hidden" name="comment_id" value="<?php echo $comment['id']; ?>">
                                            <input type="hidden" name="post_id" value="<?php echo $post['id']; ?>">
                                            <input class="delete-comment-btn" type="submit" name="delete_comment_btn" value="Delete comment">
                                        </form>
                                </div>
                            </div>
                    </div>
                        
                        </div>
                        
                    <?php } ?> 
                    
                    <!-- PAGINATION -->
                    <nav aria-label="Page navigation example" style="display: flex; justify-content: center;">
                        <ul class="pagination">
                        
                            <li class="page-item <?php if($page_no<=1){echo 'disabled';}?>">
                                <a class="page-link" href="<?php if($page_no<=1){echo '#';}else{echo 'single_post.php?post_id='.$post_id.'&page_no='.($page_no-1);}?>"><</a>
                            </li>
                            
                            <li class="page-item <?php if($page_no>= $total_no_of_pages){echo 'disabled';}?>">
                                <a class="page-link" href="<?php if($page_no>= $total_no_of_pages){echo '#';}else{echo 'single_post.php?post_id='.$post_id.'&page_no='.($page_no+1);}?>">></a>
                            </li>
                        </ul>
                    </nav>



                    <div class="comment-wrapper">
                        <img class="icon" src="<?php echo 'assets/img/'.$_SESSION['image'];?>">
                        <form class="comment-wrapper" action="store_comment.php" method="POST">
                            <input type="hidden" name="post_id" value="<?php echo $post['id'];?>">
                            <input type="text" class="comment-box" name="comment_text" placeholder="Add a comment"/>
                            <button class="comment-btn" name="comment_btn" type="submit">comment</button>
                        </form>

                    </div>
                </div>

                <?php } ?>
            </div>

            <div class="right-col">
            
                <!-- Profile card-->
                <?php include('profile_card.php'); ?>
                
                <!-- Suggestions-->
                <?php include('suggestion_side_area.php'); ?>

            </div>
        </div>
    </section>

    <script>
        var popupWindow = document.getElementById('popup');
        var optionsBtn = document.getElementById('options_btn');
        var closeWindow = document.getElementById('close-popup');

        optionsBtn.addEventListener("click",(e)=>{
            e.preventDefault();
            popupWindow.style.display = "block";
        })

        closeWindow.addEventListener("click",(e)=>{
            e.preventDefault();
            popupWindow.style.display = "none";
        })

        window.addEventListener("click",(e)=>{
            if(e.target == popupWindow)
            {
                popupWindow.style.display = "none";
            }
        })


    </script>

</body>
</html>