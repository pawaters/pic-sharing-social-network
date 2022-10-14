<?php include ("header.php"); ?>

<?php include ("connection.php");

		if(isset($_GET['post_id'])){
            try {
                $conn = connect_PDO();
                $post_id = $_GET['post_id'];
                $stmt = $conn->prepare("SELECT * FROM posts WHERE id = ?");
                
                $stmt->bindParam(1, $post_id, PDO::PARAM_INT);
                $stmt->execute();
            
                $post_array = $stmt->fetchAll();
            }
            catch (PDOException $e) {
                    echo $e->getMessage();
            }
		}else{
		    header("location: index.php?error_message=Error while accessing db.");
		    exit;
		}

?>


   <div class="camera-container">
     
      <?php if(isset($_GET['success_message'])) { ?>
         <p class="text-center mt-4 alert alert-success"><?php echo htmlspecialchars($_GET['success_message']); ?></p>
      <?php } ?>  

      <?php if(isset($_GET['error_message'])) { ?>
         <p class="text-center mt-4 alert alert-danger"><?php echo htmlspecialchars($_GET['error_message']); ?></p>
      <?php } ?> 



      <?php foreach($post_array as $post){ ?>

       <div class="camera">
           <div class="camera-image">
               
             <?php if(isset($_GET['image_name'])){ ?>
                <img style="width: 300px;" src="<?php echo "assets/img/".$_GET['image_name']; ?>" alt="">
             <?php }else { ?>   
               <img style="width:400px; height:400px;" src="<?php echo "assets/img/". $post['image']; ?>" alt="">
            <?php } ?>


               <form action="update_post.php" method="POST" enctype="multipart/form-data" class="camera-form">
                  <div class="form-group">
                       <input type="file" name="new_image" class="form-control" >
                        <input type="hidden" name="old_image_name" value="<?php echo $post['image']?>">
                        <input type="hidden" name="post_id" value="<?php echo $post['id'];?>">
                   </div>
                   <div class="form-group">
                       <input type="text" name="caption" class="form-control" placeholder="type caption..." value="<?php echo $post['caption']?>" pattern="^[A-Za-z0-9.!,;(): ]*$" title="Only letters, numbers, spaces and punctuation (max 200)" maxlength="200" >
                   </div>
                   <div class="form-group">
                       <input type="text" name="hashtags" class="form-control" placeholder="type hashtags..." value="<?php echo $post['hashtags']; ?>" pattern="^[A-Za-z0-9.!,;#]*$" title="No spaces. Only letters, numbers, hashes (max 200)" maxlength="200" >
                   </div>
                   <div class="form-group">
                       <button type="submit" style="width: 100%;" name="update_post_btn" class="upload-btn">Update Post</button>
                   </div>
               </form>
           </div>
       </div>


     <?php } ?>

   </div>


</body>
</html>