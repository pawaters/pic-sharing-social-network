

<?php include('header.php'); ?>



<?php


    include('connection.php');


    $user_id = $_SESSION['id'];

    try {
        $conn = connect_PDO();
        $stmt = $conn->prepare("SELECT user_id FROM followings WHERE other_user_id = ?");
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
        $message = "You have no followers";

    }else{

        $followers_ids = join(",",$ids);  //4,5,7


        if( isset($_GET['page_no']) && $_GET['page_no'] != ""){
            $page_no = $_GET['page_no'];
        }else{
            $page_no = 1;
        }

        
        try {
            $stmt = $conn->prepare("SELECT COUNT(*) as total_users FROM users WHERE id in ($followers_ids)");
            $stmt->execute();
            $total_users = $stmt->fetchColumn();
        }
        catch (PDOException $e) {
                echo $e->getMessage();
        }

        $total_users_per_page = 6;

        $offset = ($page_no-1) * $total_users_per_page;

        $total_no_of_pages = ceil($total_users/$total_users_per_page); 



        try {
            $stmt = $conn->prepare("SELECT * FROM users WHERE id in ($followers_ids) LIMIT $offset,$total_users_per_page "); 
            $stmt->execute();
            // $users = $stmt->get_result();
            $users = $stmt->fetchAll();
        }
        catch (PDOException $e) {
                echo $e->getMessage();
        }
                        
        }


    
    


?>


    <div class="mt-5 mx-5">
    
        <ul class="list-group">

        <h4 class="text-center" style="color:rgb(0, 162, 255); margin:5px"> Your Followers</h4>
        

        <?php if(!isset($users)){ ?>

              <p class="text-center"> <?php echo $message; ?></p>


        <?php } else {?>    

                <?php foreach($users as $user){ ?>

                    <?php if($user['id'] != $_SESSION['id']){ ?>

                    <li class="list-group-item search-result-item">
                        <img src="<?php echo "assets/img/".$user['image']; ?>" />
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