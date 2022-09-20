<?php

if (isset($_POST["reset-password-submit"])) {
    
    $selector = $_POST['selector'];
    $validator = $_POST['validator'];
    $password = $_POST['pwd'];
    $passwordRepeat = $_POST['pwd-repeat'];

    if(empty($password) || empty($passwordRepeat) ) {
        header("Location: login.php?error_message=Password or password repeat fields empty. Start again.");
        exit();
    } else if ($password != $passwordRepeat) {
        header("Location: login.php?error_message=Password and repeat do not match. Start again.");
        exit();
    }

    $currentDate = date("U");

    require 'connection.php';

    $sql = "SELECT * FROM pwdReset WHERE pwdResetSelector = ? AND pwdResetExpires >= $currentDate";


    $conn = connect_PDO();
    if (!$stmt = $conn->prepare($sql)) {
        header("Location: login.php?error_message=SQL error 1");
        exit();
    } else {

        $stmt->bindParam(1, $selector, PDO::PARAM_STR);
        $stmt->execute();

        if (!$row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            header("Location: login.php?error_message=".$dump ."SQL error 2. Selector: ".$selector. ".\br Current datE:" . $currentDate);
            exit();
        }
        else {
            $tokenBin = hex2bin($validator);
            $tokenCheck = password_verify($tokenBin, $row["pwdResetToken"]);

            if ($tokenCheck === false) {
                header("Location: login.php?error_message=Tokens do not match");
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
                        header("Location: login.php?error_message=SQL error");
                        exit();
                    }
                    else {
                        
                        $sql = "UPDATE users SET password=? WHERE email=?";
                        if (!$stmt = $conn->prepare($sql)) {
                            header("Location: login.php?error_message=SQL error");
                            exit();
                        } else {
                            $newPwdHash = md5($password); 
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
                            }


                        }
                    }
                }    
            }
        }
    }


} else {
    header("Location: login.php?error_message=Cannot access.");
}