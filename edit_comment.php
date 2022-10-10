<?php include_once("header.php"); ?>

<?php
    include('connection.php');
    
    try {
        $conn = connect_PDO();
        if(isset($_GET['comment_id']) && isset($_GET['post_id'])){

            $post_id = $_GET['post_id'];
            $comment_id = $_GET['comment_id'];
            $stmt = $conn->prepare("SELECT * FROM comments WHERE id = ?");
            $stmt->bindParam(1, $comment_id, PDO::PARAM_INT);
            $stmt->execute();
            $comment_array = $stmt->fetchAll();

        }else{
            header("location: index.php");
            exit;
        }
    }
    catch (PDOException $e) {
            echo $e->getMessage();
    }

?>

 

   <div class="camera-container">
     
      <?php if(isset($_GET['success_message'])) { ?>
         <p class="text-center mt-4 alert alert-success"><?php echo $_GET['success_message']; ?></p>
      <?php } ?>  

      <?php if(isset($_GET['error_message'])) { ?>
         <p class="text-center mt-4 alert alert-danger"><?php echo $_GET['error_message']; ?></p>
      <?php } ?> 

      <?php foreach($comment_array as $comment){ ?>

       <div class="camera">
           <div class="camera-image">
               
               <form action="update_comment.php" method="POST" class="camera-form">
                  <div class="form-group">
                    
                       <input type="hidden" name="post_id" value="<?php echo $post_id; ?>">
                        <input type="hidden" name="comment_id" value="<?php echo $comment['id'];?>">
                   </div>
                   <div class="form-group">
                       <input type="text" name="comment_text" class="form-control"  value="<?php echo $comment['comment_text']?>" placeholder="Write a comment here" pattern="^[A-Za-z0-9.!,;(): ]*$" title="Only letters, numbers, spaces and punctuation (max 200)" maxlength="200" >
                   </div>
                   
                   <div class="form-group">
                       <button type="submit" style="width: 100%;" name="update_comment_btn" class="upload-btn">Update Comment</button>
                   </div>
               </form>
           </div>
       </div>


     <?php } ?>


   </div>





</body>
</html>