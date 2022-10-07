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

                <h1>Reset your password</h1>
                <p>An email will be sent to you with instructions on how to reset your password</p>
            
                <form action="reset-request.inc.php" method="post">
                    <div class="form-group">
                        <div class="login-input">
                            <input type="email" name="email" placeholder="Type your email address...">
                        </div>
                    </div>
                    <div class="btn-group">
                        <button class="login-btn" name="reset-request-submit" type="submit">Receive email for password reset</button>
                    </div>   
                </form>

            </div>
        </div>
    </div>
</body>
</html>