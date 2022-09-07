<?php include('header.php'); ?>


<?php

   include('connection.php');

  if(isset($_POST['other_user_id']) || isset($_SESSION['other_user_id'])){

     if(isset($_SESSION['other_user_id'])){
         $other_user_id = $_SESSION['other_user_id'];
     }

     if(isset($_POST['other_user_id'])){
         $other_user_id = $_POST['other_user_id'];
         $_SESSION['other_user_id'] = $other_user_id;
     }
    
    //  if(isset($_POST['other_user_id'])){
    //     $other_user_id = $_POST['other_user_id'];
    //     $_SESSION['other_user_id'] = $other_user_id;
    // }else{
    //     $other_user_id = $_SESSION['other_user_id'];
    // }


     $stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
     $stmt->bind_param("i",$other_user_id);

     if($stmt->execute()){
        $user_array = $stmt->get_result();

     }else{
         header("location: index.php");
         exit;
     }


  }else{

    header("location: index.php");
    exit;

  }


?>


    <header class="profile-header">
        <div class="profile-container">
           
        <?php foreach($user_array as $user){?>

            <div class="profile">
                <div class="profile-image">
                    <img src="<?php echo "assets/img/".$user['image']; ?>" alt="">
                </div>
                <div class="profile-user-settings" style="width: 35%; text-align: center;">
                    <h1 class="profile-user-name"><?php echo $user['username']; ?></h1>
                     
                </div>
                <div class="profile-stats">
                    <ul>
                        <li><span class="profile-stat-count"><?php echo $user['posts']; ?></span> posts</li>
                        <li><span class="profile-stat-count"><?php echo $user['followers'];?></span> followers</li>
                        <li><span class="profile-stat-count"><?php echo $user['following']; ?></span> following</li>
                    </ul>


                    <?php include('check_following_status.php');?>

                    <?php if($following_status) { ?>

                        <form action="unfollow_this_person.php" method="POST">
                            <input type="hidden" name="other_user_id" value="<?php echo $user['id']; ?>">
                          <button type="submit" class="follow-btn-user-profile" name="unfollow_btn">Unfollow</button>
                       </form>

                    <?php } else { ?>    
                        <form action="follow_this_person.php" method="POST">
                        <input type="hidden" name="other_user_id" value="<?php echo $user['id']; ?>">
                            <button type="submit" class="follow-btn-user-profile" name="follow_btn">Follow</button>
                        </form>

                    <?php } ?>


                </div>
                <div class="profile-bio" style="text-align: center; width: 100%;">
                    <p style="text-align: center;"><span class="profile-real-name"><?php echo $user['username']; ?></span> <?php echo $user['bio'];?></p>
                </div>
            </div>


        <?php } ?>

        </div>
    </header>


   <main>
    <div class="profile-container">
        <div class="gallery">

        <?php include("get_other_user_posts.php"); ?>

            <?php foreach($posts as $post){ ?>

                <div class="gallery-item">
                <img src="<?php echo "assets/img/".$post['image']; ?>" class="gallery-image" alt="">
                <div class="gallery-item-info">
                    <ul>
                        <li class="gallery-item-likes"><span class="hide-gallery-element"><?php echo $post['likes'];?></span>
                            <i class="fas fa-heart"></i>
                        </li>
                        <li class="gallery-item-comments"><span class="hide-gallery-element"></span>
                            <a style="color:#fff" href="single_post.php?post_id=<?php echo $post['id'];?>" ><i class="fas fa-comment"></i></a>
                        </li>
                    </ul>
                </div>
            </div>

            <?php } ?>
            


         
    </div>


     <nav aria-label="Page navigation example" style="display:flex; justify-content: center">
            <ul class="pagination">
                <li class="page-item <?php if($page_no<=1){echo 'disabled';}?>">
                        <a class="page-link" href="<?php if($page_no<=1){echo'#';}else{ echo '?page_no='. ($page_no-1); }?>">Previous</a>
                </li>
                <li class="page-item"><a class="page-link" href="?page_no=1">1</a></li>
                <li class="page-item"><a class="page-link" href="?page_no=2">2</a></li>
                <li class="page-item"><a class="page-link" href="?page_no=3">3</a></li>
                <?php if($page_no >= 3){?>
                    <li class="page-item"><a class="page-link" href="#">...</a></li>
                    <li class="page-item"><a class="page-link" href="<?php echo "?page_no=". $page_no;?>"></a></li>
                <?php } ?>
                <li class="page-item <?php if($page_no>= $total_no_of_pages){echo 'disabled';}?>">
                    <a class="page-link" href="<?php if($page_no>=$total_no_of_pages){echo "#";}else{ echo "?page_no=".($page_no+1);}?>">Next</a>
                </li>
            </ul>
        </nav>




   </main> 

  


</body>
</html>