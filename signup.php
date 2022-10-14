<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup Page</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    
    <div class="container">
        <div class="main-container">
            
            <div class="main-content">
                <div class="slide-container" style="background-image: url('assets/img/frame.png');">
                    <div class="slide-content" id="slide-content">
                        <img src="assets/img/screen1.jpeg" class="active" alt="screen1">
                        <img src="assets/img/screen2.jpeg" alt="screen2">
                        <img src="assets/img/screen3.jpeg" alt="screen3">
                        <img src="assets/img/screen4.jpeg" alt="screen4">
                    </div>
                </div>
                <div class="form-container">
                    <div class="form-content box">
                        <div class="logo">
                            <img src="assets/img/logo.png" class="logo-img">
                        </div>
                        <form class="login-form" id="signup-form" action="process_signup.php" method="POST" autocomplete="on">

                            <?php if(isset($_GET['error_message'])) { ?>
                                <p id="error_message" class="text-center alert alert-danger"> <?php echo htmlspecialchars($_GET['error_message']); ?></p>
                            <?php }  ?>
                            
                            <div class="form-group">
                                <div class="login-input">
                                    <input type="email" name="email" placeholder="Type your email address..." required>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="login-input">
                                    <input type="text" name="username" placeholder="Type your username..." required pattern="^[a-zA-Z0-9]+$" title="Only letters and numbers, max length 20" maxlength="20">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="login-input">
                                    <input type="password" name="password" id="password" placeholder="Type your password..." required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" minlength="8" maxlength="20" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="login-input">
                                    <input type="password" name="password_confirm" id="confirm_password" placeholder="Confirm your password..." required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" minlength="8" maxlength="20" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters">
                                </div>
                            </div>
                            <div class="btn-group">
                                <button class="login-btn" name="signup_btn" id="signup_btn" type="submit">Sign Up</button>
                            </div>      
                        </form>
                        <div class="or">
                            <hr>
                                <span>OR</span>
                            <hr/>
                        </div>
                        <div class="goto">
                            <p>Already have an account ? <a href="login.php">Log In</a></p>
                        </div>
                        <div class="app-download">
                            <p >Get the app.</p>
                            <div class="store-link">
                                <a href="#">
                                    <img src="assets/img/store.png" alt="">
                                </a>
                                <a href="#">
                                    <img src="assets/img/gbs.png" alt="">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php include_once('footer.php'); ?>
    </div>
    
    <script> 
    
    setInterval(() => {changeImage();}, 1000);
    
    function changeImage(){
        // retrieve images into an array
        var images = document.getElementById('slide-content').getElementsByTagName('img');
       
       var i = 0;
       //loop through each image
       for (i = 0; i < images.length; i++)
       {
           var image = images[i];
           if (image.classList.contains('active'))
           {
               image.classList.remove('active');
               
                if(i == images.length - 1)
                {
                    var nextImage = images[0];
                    nextImage.classList.add('active');
                    break;
                }

                var nextImage = images[i + 1];
               nextImage.classList.add('active');
               break;
           }
       }
    };

    </script>

</body>
</html>
