<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/8da1d76717.js" crossorigin="anonymous"></script>
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
                        <p id="error_message" class="text-center alert-danger"></p>
                            <div class="form-group">
                                <div class="login-input">
                                    <input type="text" name="email" placeholder="Type your email address...">
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
                            <p>Don't have an account ? <a href="signup.html">Sign Up</a></p>
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
        <div class="footer">
            <div class="links" id="links">
                <a href="#">About</a>
                <a href="#">My Linkedin</a>
                <a href="#">My Github</a>
                <a href="#">Contact me</a>
                <a href="#">Terms</a>
                <a href="#" id="dark-btn">Dark/Light</a>
            </div>
            <div class="copyright">
                @2022 Pierre-Alban Waters, HIVE Helsinki student
            </div>
        </div>
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
 
    function changeMode()
    {
        var body = document.getElementsByTagName('body')[0];
        var footerLinks = document.getElementById('links').getElementsByTagName('a');

        if(body.classList.contains('dark'))
        {
            body.classList.remove('dark');

            for (let i=0; i < footerLinks.length; i++)
            {
                footerLinks[i].classList.remove('dark-mode-link');
            } 
        }
        else 
        {
            body.classList.add('dark');

            for (let i = 0; i < footerLinks.length; i++)
            {
                footerLinks[i].classList.add('dark-mode-link');   
            }
        };

    }
    
    function verifyForm()
        {
            var password = document.getElementById('password').value;
            var error_message = document.getElementById('error_message');

            if(password.length < 6)
            {
                error_message.innerHTML = "Password is too short";
                return false;
            }
            return true;
        }
   
    // TD: why that e?
    document.getElementById('dark-btn').addEventListener('click',(e)=>{
        e.preventDefault();

        changeMode();
    })

    // document.getElementById('login_form').addEventListener('submit', (e)=>{
    //     e.preventDefault();

    //     verifyForm();
    // })

    </script>

</body>
</html>
