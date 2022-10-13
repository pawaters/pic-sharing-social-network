<?php 

include('connection.php');


    $user_id = $_SESSION['id'];
    try {
        $conn = connect_PDO();
        $stmt = $conn->prepare("SELECT other_user_id FROM followings WHERE user_id = ?");
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
    //I'm not following anyone
    if(empty($ids)){
            
    }else{
        $following_ids = join(",",$ids);  //4,5,7

        try {
            $stmt = $conn->prepare("SELECT * FROM users WHERE id in ($following_ids) ORDER BY RAND() LIMIT 20");

            $stmt->execute();

            $other_people = $stmt->fetchAll();
        }
        catch (PDOException $e) {
                echo $e->getMessage();
        }
    }
    
?>