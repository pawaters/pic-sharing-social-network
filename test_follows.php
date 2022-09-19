<?php 

include('connection.php');


    $user_id = 2;
    $conn = connect_PDO();
    $stmt = $conn->prepare("SELECT other_user_id FROM followings WHERE user_id = ?");
    // $stmt->bind_param("i",$user_id);
    $stmt->bindParam(1, $user_id, PDO::PARAM_INT);
    $stmt->execute();
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
        echo "<br />\nids: <br />\n";
        print_r($ids);
        
        //I'm not following anyone
       if(empty($ids)){
               
       }else{


                $following_ids = join(",",$ids);  //4,5,7
                echo "<br />\nfollowing ids: <br />\n";
                print_r($following_ids);
                $stmt = $conn->prepare("SELECT * FROM users WHERE id in ($following_ids) ORDER BY RAND() LIMIT 20");

                $stmt->execute();

                // $other_people = $stmt->get_result();
                $other_people = $stmt->fetchAll();
                echo "<br />\nfollowing ids: <br />\n";
                print_r($other_people);


       }
    
?>