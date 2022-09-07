
    
<?php include('header.php'); ?>

<?php


            include('connection.php');


         if(isset($_POST['search_input'])){

            $search_input = $_POST['search_input'];

            $stmt = $conn->prepare("SELECT * FROM posts WHERE caption like ? OR hashtags like ?  limit 12");
            $stmt->bind_param("ss",$search_input,$search_input);
            $stmt->execute();
            $posts = $stmt->get_result();


         }else{

            //default keyword
            $search_input = "car";

            $stmt = $conn->prepare("SELECT * FROM posts WHERE caption like ? OR hashtags like ? limit 12");
            $stmt->bind_param("ss",$search_input,$search_input);
            $stmt->execute();
            $posts = $stmt->get_result();


         }

           


?>
 

   <main>
    <div class="discover-container">
        <div class="gallery">


        <?php foreach($posts as $post){ ?>


            <div class="gallery-item">
                <img src="<?php echo "assets/img/".$post['image'];?>" class="gallery-image" alt="">
                <div class="gallery-item-info">
                    <ul>
                        <li class="gallery-item-likes"><span class="hide-gallery-element"><?php echo $post['likes']; ?></span>
                            <i class="fas fa-heart"></i>
                        </li>
                        <li class="gallery-item-comments"><span class="hide-gallery-element"></span>
                            <a href="single_post.php?post_id=<?php echo $post['id'];?>" style="color: #fff;"><i class="fas fa-comment"></i></a>
                        </li>
                    </ul>
                </div>
            </div>

         <?php } ?>   


    </div>


   </main> 

  


</body>
</html>