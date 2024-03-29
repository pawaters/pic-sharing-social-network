<?php

if (isset($_POST["reset-password-submit"])) {
    
    $selector = ($_POST['selector']);
    $validator = $_POST['validator'];
    $password = $_POST['pwd'];
    $passwordRepeat = $_POST['pwd-repeat'];
    $uppercase = preg_match('@[A-Z]@', $password);
    $lowercase = preg_match('@[a-z]@', $password);
    $number    = preg_match('@[0-9]@', $password);  

    if (ctype_xdigit($selector) == false || ctype_xdigit($validator) == false){   
        header("Location: login.php?error_message=Tokens are not of the right format. Start again.");
        exit();
    }

    if(empty($password) || empty($passwordRepeat) ) {
        header("Location: login.php?error_message=Password or password repeat fields empty. Start again.");
        exit();
    } else if ($password != $passwordRepeat) {
        header("Location: login.php?error_message=Password and repeat do not match. Start again.");
        exit();
    }
    if(empty($selector) || empty($validator) ) {
        header("Location: login.php?error_message=Selector or validator empty. Start again.");
        exit();
    }
    if(strlen($password) < 8){
		header('location: login.php?error_message=Password is shorter than 8 characters');
		exit;
	}

	if(strlen($password) > 20){
		header('location: login.php?error_message=Password too long, maximum 20 characters allowed.');
		exit;
	}
    if(!$uppercase || !$lowercase || !$number) {
        header('location: login.php?error_message=Password complexity not good enough: you should include at least one upper case letter, one lowercase and one number.');
		exit;
    }


    $currentDate = date("U");

    require_once 'connection.php';

    $sql = "SELECT * FROM pwdReset WHERE pwdResetSelector = ? AND pwdResetExpires >= $currentDate";

    try {
        $conn = connect_PDO();
        if (!$stmt = $conn->prepare($sql)) {
            header("Location: login.php?error_message=SQL error.");
            exit();
        } else {

            $stmt->bindParam(1, $selector, PDO::PARAM_STR);
            $stmt->execute();

            if (!$row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                header("Location: login.php?error_message=No such selector token in our database. Did you touch the URL? ;)");
                exit();
            }
            else {
                $tokenBin = hex2bin($validator);
                $tokenCheck = password_verify($tokenBin, $row["pwdResetToken"]);

                if ($tokenCheck === false) {
                    header("Location: login.php?error_message=Validator Tokens do not match. Did you touch the URL? ;)");
                    exit();
                } else if ($tokenCheck === true) {

                    $tokenEmail = $row['pwdResetEmail'];
                    
                    $sql = "SELECT * FROM users WHERE email = ?";
                    if (!$stmt = $conn->prepare($sql)) {
                        header("Location: login.php?error_message=SQL error");
                        exit();
                    } else {
                        $stmt->bindParam(1, $tokenEmail, PDO::PARAM_STR);
                        $stmt->execute();
                        if (!$row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            header("Location: login.php?error_message=No such email in db");
                            exit();
                        }
                        else {
                            
                            $sql = "UPDATE users SET password=? WHERE email=?";
                            if (!$stmt = $conn->prepare($sql)) {
                                header("Location: login.php?error_message=SQL error");
                                exit();
                            } else { 
                                $newPwdHash = password_hash($password, PASSWORD_DEFAULT);
                                $stmt->bindParam(1, $newPwdHash, PDO::PARAM_STR);
                                $stmt->bindParam(2, $tokenEmail, PDO::PARAM_STR);
                                $stmt->execute();

                                $sql = "DELETE FROM pwdReset WHERE pwdResetEmail = ?";

                                if (!$stmt = $conn->prepare($sql)) {
                                    header("Location: login.php?error_message=SQL error");
                                    exit();
                                } else {
                                    $stmt->bindParam(1, $tokenEmail, PDO::PARAM_STR);
                                    $stmt->execute();
                                    header("Location: login.php?success_message=Password Updated Successfully");
                                    exit();
                                }


                            }
                        }
                    }    
                }
            }
        }
    }
    catch (PDOException $e) {
            echo $e->getMessage();
    }

} else {
    header("Location: login.php?error_message=Cannot access.");
    exit();
}