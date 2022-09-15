<?php include("header.php"); ?>
    
    <main>
        <div class="wrapper-main">
            <section class="section-default">

                <?php if(isset($_GET['success_message'])) { ?>
                    <p class="mt-4 text-center alert-success"><?php echo $_GET['success_message']; ?> </p>
                <?php } ?>

                <?php if(isset($_GET['error_message'])) { ?>
                    <p class="mt-4 text-center alert-danger"><?php echo $_GET['error_message']; ?> </p>
                <?php } ?>
            
                <?php
                    $selector = $_GET["selector"];
                    $validator = $_GET["validator"]; 

                    // if(empty($selector) || empty($validator) ) {
                    //     header("Location: index.php?error_message=Could not find selector or validator.");
                    // } else {
                        if (ctype_xdigit($selector) !== false && ctype_xdigit($validator) !== false){   
                            ?>

                            <form action="reset_password.php" method="post">
                                <input type="hidden" name="selector" value="<?php echo $selector ?>">
                                <input type="hidden" name="validator" value="<?php echo $validator ?>">
                                <input type="password" name="pwd" placeholder="Enter a new password">
                                <input type="password" name="pwd-repeat" placeholder="Repeat new password">
                                <button type="submit" name="reset-password-submit">Reset password</button>
                            </form>

                            <?php
                        }
                    // }
                ?>

            </section>
        </div>
    </main>
</body>
</html>