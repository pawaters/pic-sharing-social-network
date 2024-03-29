<?php include("header_no_login.php"); ?>
    
<div class="main-content">    
        <div class="form-container">
            <div class="form-content box">


                <?php if(isset($_GET['success_message'])) { ?>
                    <p class="mt-4 text-center alert alert-success"><?php echo htmlspecialchars($_GET['success_message']); ?> </p>
                <?php } ?>

                <?php if(isset($_GET['error_message'])) { ?>
                    <p class="mt-4 text-center alert alert-danger"><?php echo htmlspecialchars($_GET['error_message']); ?> </p>
                <?php } ?>
            
                <?php
                    $selector = $_GET["selector"];
                    $validator = $_GET["validator"]; 

                    if(empty($selector) || empty($validator) ) {
                        header("Location: login.php?error_message=Could not find selector or validator.");
                        exit();
                    } else {
                        if (ctype_xdigit($selector) !== false && ctype_xdigit($validator) !== false){   
                            ?>
                            <h1>Reset your password</h1>
                            <form action="reset-password.inc.php" method="post">
                                <input type="hidden" name="selector" value="<?php echo $selector ?>">
                                <input type="hidden" name="validator" value="<?php echo $validator ?>">
                                <div class="form-group">
                                    <div class="login-input">
                                        <input type="password" name="pwd" placeholder="Enter a new password" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters">
                                    </div>
                                    <div class="login-input">
                                        <input type="password" name="pwd-repeat" placeholder="Repeat new password" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters">
                                    </div>
                                </div>
                                <div class="btn-group">    
                                    <button class="login-btn" type="submit" name="reset-password-submit">Reset password</button>
                                </div>
                            </form>

                            <?php
                        }
                    }
                ?>

            </div>
        </div>
    </div>
</body>
</html>