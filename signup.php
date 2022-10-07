<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup Page</title>

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
                        <form class="login-form" id="signup-form" action="process_signup.php" method="POST" autocomplete="on">

                            <?php if(isset($_GET['error_message'])) { ?>
                                <p id="error_message" class="text-center alert alert-danger"> <?php echo $_GET['error_message']; ?></p>
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
                                    <input type="password" name="password" id="password" placeholder="Type your password..." required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="login-input">
                                    <input type="password" name="password_confirm" id="confirm_password" placeholder="Confirm your password..." required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters">
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
    
    <!--script to slide images -->
    <script> 
    
    //REWRITE THIS WITH A SIMPLER LOOP

    // why we cant just call directly func but have to use arrow to then call 
    // the reason is that when in a callback, it stays within that specific context,
    // and changes the value in context of setInterval itself, not the value of the CSS out of it.
    // to solve this, we can use the arrow function expression.
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
 
    // function changeMode()
    // {
    //     var body = document.getElementsByTagName('body')[0];
    //     var footerLinks = document.getElementById('links').getElementsByTagName('a');

    //     if(body.classList.contains('dark'))
    //     {
    //         body.classList.remove('dark');

    //         for (let i=0; i < footerLinks.length; i++)
    //         {
    //             footerLinks[i].classList.remove('dark-mode-link');
    //         } 
    //     }
    //     else 
    //     {
    //         body.classList.add('dark');

    //         for (let i = 0; i < footerLinks.length; i++)
    //         {
    //             footerLinks[i].classList.add('dark-mode-link');   
    //         }
    //     };

    // }

    // // function verifyForm()
    // // {
    // //     var password = document.getElementById('password').value;
    // //     var confirm_password = document.getElementById('confirm_password').value;
    // //     var error_message = document.getElementById('error_message');

    // //     if(password.length < 6)
    // //     {
    // //         error_message.innerHTML = "Password is too short";
    // //         return false;
    // //     }

    // //     if(password !== confirm_password)
    // //     {
    // //         error_message.innerHTML = "Passwords do not match";
    // //         return false;
    // //     }
    // //     return true;


    // // }
   
    // // document.getElementById('dark-btn').addEventListener('click',(e)=>{
    // //     e.preventDefault();

    // //     changeMode();
    // // })  

    // //NO NEED TO CHECK WITH JS, WE DO WITH PHP IN SIGNUP_PROCESS

    // // document.getElementById('signup_form').addEventListener('submit', (e)=>
    // //     {
    // //         e.preventDefault();

    // //         verifyForm();
    // //     }
    // // )

    </script>

</body>
</html>
