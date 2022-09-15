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
        header("Location: login.php?error_message=Password and password repeat do not match. Start again.");
        exit();
    }

    $currentDate = date("U");

    require 'connection.php';

    $sql = "SELECT * FROM pwdReset WHERE pwdResetSelector = ? AND pwdResetExpires >= $currentDate";

    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: login.php?error_message=SQL error 1");
        exit();
    } else {
        mysqli_stmt_bind_param($stmt, "s", $selector);
        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);
        $dump = var_dump($result);
        if (!$row = mysqli_fetch_assoc($result)) {
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
                $stmt = mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($stmt, $sql)) {
                    header("Location: login.php?error_message=SQL error");
                    exit();
                } else {
                    mysqli_stmt_bind_param($stmt, "s", $tokenEmail);
                    mysqli_stmt_execute($stmt);
                    $result = mysqli_stmt_get_result($stmt);
                    if (!$row = mysqli_fetch_assoc($result)) {
                        header("Location: login.php?error_message=SQL error");
                        exit();
                    }
                    else {
                        
                        $sql = "UPDATE users SET password=? WHERE email=?";
                        $stmt = mysqli_stmt_init($conn);
                        if (!mysqli_stmt_prepare($stmt, $sql)) {
                            header("Location: login.php?error_message=SQL error");
                            exit();
                        } else {
                            $newPwdHash = md5($password); 
                            mysqli_stmt_bind_param($stmt, "ss", $newPwdHash, $tokenEmail);
                            mysqli_stmt_execute($stmt);

                            $sql = "DELETE FROM pwdReset WHERE pwdResetEmail = ?";
                            $stmt =  mysqli_stmt_init($conn);
                            if (!mysqli_stmt_prepare($stmt, $sql)) {
                                header("Location: login.php?error_message=SQL error");
                                exit();
                            } else {
                                mysqli_stmt_bind_param($stmt, "s", $tokenEmail);
                                mysqli_stmt_execute($stmt);
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