<?php 

include('connection.php');


    $user_id = $_SESSION['id'];
    
    $conn = connect_PDO();
    $stmt = $conn->prepare("SELECT other_user_id FROM followings WHERE user_id = ?");
    // $stmt->bind_param("i",$user_id);
    $stmt->bindParam(1, $user_id, PDO::PARAM_INT);
    $stmt->execute();

    // $ids = array();

        // $result = $stmt->get_result();
        // while($row = $result->fetch_array(MYSQLI_NUM)){
        //         foreach($row as $r){
        //             $ids[] = $r;
        //         }
        // }
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        foreach($row as $r){
            $ids[] = $r;
        }
    }
        
        //I'm not following anyone
       if(empty($ids)){
               
       }else{


                $following_ids = join(",",$ids);  //4,5,7

                $stmt = $conn->prepare("SELECT * FROM users WHERE id in ($following_ids) ORDER BY RAND() LIMIT 20");

                $stmt->execute();

                // $other_people = $stmt->get_result();
                $other_people = $stmt->fetchAll();


       }
    
?>