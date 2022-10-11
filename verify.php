<?php include("header_no_login.php"); ?>
    <div class="main-content">    
        <div class="form-container">
            <div class="form-content box">

                <?php if(isset($_GET['success_message'])) { ?>
                    <p class="mt-4 text-center alert alert-success"><?php echo $_GET['success_message']; ?> </p>
                <?php } ?>

                <?php if(isset($_GET['error_message'])) { ?>
                    <p class="mt-4 text-center alert alert-danger"><?php echo $_GET['error_message']; ?> </p>
                <?php } ?>

                <?php
                    $vkey = $_GET["vkey"]; 

                    if(empty($vkey)) {
                        header("Location: signup.php?error_message=Error - Could not find email to validate.");
                        exit();
                    } else {
                            ?>
                            <h1>Reset your password</h1>
                            <?php 
                            
                            require_once 'connection.php';

                            $sql = "SELECT verified, vkey FROM users WHERE verified = 0 and vkey = ? LIMIT 1";

                            try {
                                $conn = connect_PDO();
                                $stmt = $conn->prepare($sql);
                                $stmt->bindParam(1, $vkey, PDO::PARAM_STR);  
                                $stmt->execute();
                                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                                if (!$row) {
                                    header("Location: login.php?error_message= Already verified, Invalid SQL or account");
                                    exit();
                                }
                                else {
                                    $sql = "UPDATE users SET verified = 1 WHERE vkey = ? LIMIT 1";
                                    if (!$stmt = $conn->prepare($sql)) 
                                    {
                                        header("Location: signup.php?error_message=SQL error");
                                        exit();
                                    } else {
                                        $stmt->bindParam(1, $vkey, PDO::PARAM_STR);  
                                        $stmt->execute();
                                        header("Location: login.php?success_message=Your email has been verified! Please log in.");
                                        exit();
                                    } 
                                }
                            } catch (PDOException $error) {
                                echo $error->getMessage(); 
                                exit;
                            }
                            $conn = null;
                            
                            ?>

                            <?php
                        }
                ?>

                <h1>Verify your email</h1>
                
                

            </div>
        </div>
    </div>
</body>
</html>