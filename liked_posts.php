
<?php include('header.php'); ?>



<?php 


        include('connection.php');


        //ids of posts a user liked
        $user_id = $_SESSION['id'];
        
        try {
            $conn = connect_PDO();
            $stmt = $conn->prepare("SELECT post_id FROM likes WHERE user_id = ?");
            $stmt->bindParam(1, $user_id, PDO::PARAM_INT);
            $stmt->execute();

            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                foreach($row as $r){
                    $ids[] = $r;
                }
            }
        }
        catch (PDOException $e) {
                echo $e->getMessage();
        }

        if(empty($ids)){
               $error_message = "You have not liked any post yet";
         }else{



                $ids_of_posts_you_liked = join(",",$ids);  
                
                if( isset($_GET['page_no']) && $_GET['page_no'] != ""){
                    $page_no = $_GET['page_no'];
                }else{
                    $page_no = 1;
                }


                try {
                    $stmt = $conn->prepare("SELECT COUNT(*) as total_posts FROM posts WHERE id in ($ids_of_posts_you_liked)");
                    $stmt->execute();
                    $total_posts = $stmt->fetchColumn();
                }
                catch (PDOException $e) {
                        echo $e->getMessage();
                }

                $total_posts_per_page = 6;

                $offset = ($page_no-1) * $total_posts_per_page;

                $total_no_of_pages = ceil($total_posts/$total_posts_per_page); 



                $stmt = $conn->prepare("SELECT * FROM posts WHERE id in ($ids_of_posts_you_liked) ORDER BY id DESC LIMIT $offset,$total_posts_per_page"); 
                $stmt->execute();
                $users = $stmt->fetchAll();

       }



?>
 

   <main>
    <div class="discover-container">
        <div class="gallery">




      <?php if(!isset($posts)){ ?>

             <div class="mx-auto mt-5 alert alert-danger"><?php echo "No posts liked."; ?>
                 <a href="index.php" style="color:rgb(0,162,255);">Discover great posts now. </a>
             </div>

      <?php }else{ ?>  

        <?php foreach($posts as $post){ ?>

            <div class="gallery-item">
                <img src="<?php echo "assets/img/". $post['image']; ?>" class="gallery-image" alt="">
                <div class="gallery-item-info">
                    <ul>
                        <li class="gallery-item-likes"><span class="hide-gallery-element">
                            <?php echo $post['likes']; ?>
                        </span>
                            <i class="fas fa-heart"></i>
                        </li>
                        <li class="gallery-item-comments"><span class="hide-gallery-element"></span>
                            <a href="single_post.php?post_id=<?php echo $post['id']; ?>"><i class="fas fa-comment" style="color: #fff"></i></a>
                        </li>
                    </ul>
                </div>
            </div>

     
      <?php } ?>

  <?php } ?>
      
         
    </div>


     

            <?php if(isset($posts)){ ?>
                 
                 <nav aria-label="Page navigation example" style="display: flex; justify-content:center">
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


            <?php } ?>        





   </main> 

  


</body>
</html>