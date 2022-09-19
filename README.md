# camagru - main focus

Macro: follow example - learn best practice - apply to my case - UI first
On days where always with baby, just watch videos and organise 

FOCUS: FRONTEND

1) confirm wireframe
- do index.html (main page with images)
    containers based on example, understand logic
2) take one element, design index, then css
- add style.css
3) when all that done, add functionatilty

Where to start:
- navbar
- 

FILE STRUCTURE I WILL USE:

- BASIC:![image](https://user-images.githubusercontent.com/86101754/183259344-98acdb67-c749-496f-8435-e350956e9c99.png)
- ADVANCED: https://github.com/php-pds/skeleton 
______

Easiest step forward:
- watch video of udemy (daily) fo example project
- follow the steps
- improve my plan as I go


Plan:
1) read and summarise instructions
2) divide problem, research solutions, iterate
3) review discord
4) summarise, test and confirm I understand fully

Summary: 
A web app allowing registered users to make basic video editing using their webcam and some predefined images. 
All captured images are likeable and commentable via a gallery page.

Functionality:
Users should be able to select one or more images (stickers) in a list, 
take a picture with webcam and see the result mixing both pictures.
All images should be public, likeable and commentable.

User features:
- sign up with minimum level of complexity
- confirm registration with unique link sent to email
- possible to send a pw reinitialisation email
- user should be able to disconnect in one click
- once connected, able to modify username, mail, password

Gallery features:
- display all images edited by users, ordered by date of creation
- connected user can comment and like
- when an image receives a comment, image author receives an email
(this last feature can be deactivated in preferences)
- image list must be paginated, with at least 5 elements per page

Editing features:
- only accessible to signed up users.
- 2 sections: 
    - main: webcam preview, list of superposable images and capture button
    - side: thumbnails of previous pictures taken
- superposable images (stickers) are selectable
- photo button is inactive until sticker is selected
- creation of final image must be done on server side, in PHP
- user must be able to upload an image.

Layout:
![Screenshot 2022-05-31 at 16 46 18](https://user-images.githubusercontent.com/86101754/171188870-69dcc1d1-5b4d-4dba-914e-a95035ddeeaa.png)

Languages:
- server: PHP
- client: HTML, CSS, JS

Frameworks:
- server: none
- client: CSS Framework Bootstrap (without anything else but the CSS)

Structure: 
- reuse structure from rush: per file type: css, img, js, html
- must contain: 
    - index.php, --> entry point, located at root
    - config/ 
        setup.php --> to create DB
        database.php --> info for DB creation

Questions:
- what is PDO abstraction driver to communicate with DB?
- how to apply MVC to project
- research bootstrap and other CSS frameworks

References:
- Wireframe:
    - https://github.com/T7Q/Camagru
- Database structure:
    - https://github.com/T7Q/Camagru
 https://github.com/AnthonyLedru/camagru

____________________________________________


