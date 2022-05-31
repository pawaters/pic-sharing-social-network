# camagru

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

Questions:
- what is PDO abstraction driver to communicate with DB?
- how to apply MVC to project

Editing features:
- only accessible to signed up users.
- 2 sections: 
    - main: webcam preview, list of superposable images and capture button
    - side: thumbnails of previous pictures taken

Structure: 
- reuse structure from rush




