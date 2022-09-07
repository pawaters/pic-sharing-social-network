

<?php include('header.php'); ?>



<?php


    include('connection.php');


    $user_id = $_SESSION['id'];


    $stmt = $conn->prepare("SELECT other_user_id FROM followings WHERE user_id = ?");
    $stmt->bind_param("i",$user_id);
    $stmt->execute();

        $ids = array();
    
            $result = $stmt->get_result();
            while($row = $result->fetch_array(MYSQLI_NUM)){
                    foreach($row as $r){
                        $ids[] = $r;
                    }
            }
    

            if(empty($ids)){
                $message = "You have not followed any one yet";

            }else{
        
                              $following_ids = join(",",$ids);  //4,5,7


                                if( isset($_GET['page_no']) && $_GET['page_no'] != ""){
                                    $page_no = $_GET['page_no'];
                                }else{
                                    $page_no = 1;
                                }

                               

                                $stmt = $conn->prepare("SELECT COUNT(*) as total_users FROM users WHERE id in ($following_ids)");
                                $stmt->execute();
                                $stmt->bind_result($total_users);
                                $stmt->store_result();
                                $stmt->fetch();


                                $total_users_per_page = 6;

                                $offset = ($page_no-1) * $total_users_per_page;

                                $total_no_of_pages = ceil($total_users/$total_users_per_page); 



                            
                                $stmt = $conn->prepare("SELECT * FROM users WHERE id in ($following_ids) LIMIT $offset,$total_users_per_page "); 
                                $stmt->execute();
                                $users = $stmt->get_result();

                                
                }


    
    


?>


    <div class="mt-5 mx-5">
    
        <ul class="list-group">

        <h4 class="text-center" style="color:rgb(0, 162, 255); margin:5px"> People You're Following</h4>
        
        <?php if(!isset($users)){ ?>

              <p class="text-center"> <?php echo $message; ?></p>


        <?php } else {?>    

                <?php foreach($users as $user){ ?>

                    <?php if($user['id'] != $_SESSION['id']){ ?>

                    <li class="list-group-item search-result-item">
                        <img src="<?php echo "assets/imgs/".$user['image']; ?>" />
                        <div style="width: 100%;">
                            <p><?php echo $user['username'];?></p>
                            <span><?php echo substr($user['bio'],0,20); ?></span>
                        </div>
                        <div class="search-result-item-btn">
                            <form action="other_user_profile.php" method="POST">
                                <input type="hidden" name="other_user_id" value="<?php echo $user['id']; ?>">
                                <button type="submit">Visit Profile</button>
                            </form>
                        </div>
                    </li>

                    <?php } ?>

                  <?php } ?> 

                <?php } ?>

        </ul>
    </div>
     



    <?php  if(isset($users)){ ?>

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



   <?php } ?>




</body>
</html>