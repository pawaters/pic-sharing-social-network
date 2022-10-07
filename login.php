<?php

session_start();

if(isset($_SESSION['id'])) {
    header('location: index.php');
    exit;
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>

    <!-- BOOTSTRAP CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <!-- FONTAWESOME CSS -->
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
                            <img src="assets/img/logo.jpg" class="logo-img">
                        </div>
                        <!-- in the front-end part, we have class id and some inputs
                        // now, to feed into our back-end, we need to add a method "POST", and an action 
                        // the php for the action will define what to do with the form data -->
                        <form class="login-form" id="login-form" method="POST" action="process_login.php">

                        <?php if(isset($_GET['success_message'])) { ?>
                            <p id="success_message" class="text-center alert alert-success"><?php echo $_GET['success_message']; ?> </p>
                        <?php } ?>

                        <?php  if(isset($_GET['error_message'])){  ?>
                            <p id="error_message" class="text-center alert alert-danger"> <?php echo $_GET['error_message']; ?> </p>
                        <?php    }?>
                        
                        
                            <div class="form-group">
                                <div class="login-input">
                                    <!-- <input type="email" name="email" placeholder="Type your email address..."> -->
                                    <input type="text" name="username" placeholder="Type your username..." required pattern="^[a-zA-Z0-9]+$" title="Only letters and numbers, max length 20" maxlength="20">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="login-input">
                                    <input type="password" name="password" id='password' placeholder="Type your password...">
                                </div>
                            </div>

                            <div class="btn-group">
                                <button class="login-btn" id="login_btn" name="login_btn" type="submit">Log In</button>
                            </div>      
                        </form>
                        <div class="or">
                            <hr>
                                <span>OR</span>
                            <hr/>
                        </div>
                        <div class="goto">
                            <p>Don't have an account ? <a href="signup.php">Sign Up</a></p>
                            <div>
                                <p>Forgot your password ? <a href="reset-password.php">Reset your password</a><p>  
                            </div>
                            <div>
                                <p>Just want to check public posts ? <a href="gallery.php">Visit the gallery</a><p>  
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <?php include_once('footer.php'); ?>
    </div>
    
    <!--script to slide images -->
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
