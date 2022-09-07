<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/8da1d76717.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <nav class="navbar"> 
        <div class="nav-wrapper">
            <img src="assets/img/logo.jpg" class="brand-img"/>
            <form class="search-form">
                <input type="text" class="search-box" placeholder="Search"/>
            </form>
            <div class="nav-items">
                <i class="icon fa-solid fa-house-user"></i>
                <i class="icon fas fa-plus"></i>
                <i class="icon fas fa-heart"></i>
                <div class="icon user-profile">
                    <i class="fas fa-user"></i>
                </div>
            </div>
        </div>
    </nav>
    
    <!-- bootstrap classes:
    - for forms: form-group, form-control,
    - for lists: list-group, list-group-item
    -->

    <div class="mt-5 mx-5">
        <form action="">
            <div class="form-group search-component">
                <input type="text" class="form-control" placeholder="Search..." name="search_input">
                <button type="submit" class="search-btn" name="search-btn">Search</button>
            </div>
        </form>
        <ul class="list-group">
            <li class="list-group-item search-result-item">
                <img src="assets/img/profile.jpeg">
                <div>
                    <p>username</p>
                    <span>bio</span>
                </div>
                <div class="search-result-item-btn">
                    <button>Follow</button>
                </div>
                
            </li>
            <li class="list-group-item search-result-item">
                <img src="assets/img/profile.jpeg">
                <div>
                    <p>username</p>
                    <span>bio</span>
                </div>
                <div class="search-result-item-btn">
                    <button>Follow</button>
                </div>
                
            </li>
            <li class="list-group-item search-result-item">
                <img src="assets/img/profile.jpeg">
                <div>
                    <p>username</p>
                    <span>bio</span>
                </div>
                <div class="search-result-item-btn">
                    <button>Follow</button>
                </div>
                
            </li>
        </ul>
    </div>


</body>
</html>