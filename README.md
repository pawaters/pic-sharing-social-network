# Pic Sharing social network

Instagram clone, coded in PHP, HTML, CSS without any external library, except Bootstrap for CSS.
For non-commercial purposes only.

You can also go to signup and create your own, with your own profile picture, bio, shared images.

Stack: PHP, HTML, CSS, mySQL. 
Design-pattern: Responsive Single-page application.
UI: inspired from instagram.

## User features:
- sign up with minimum level of complexity
- confirm registration with unique link sent to email
- possible to send a pw reinitialisation email
- user should be able to disconnect in one click
- once connected, able to modify username, mail, password

## Gallery features:
- display all images edited by users, ordered by date of creation
- connected user can comment and like
- when an image receives a comment, image author receives an email (this last feature can be deactivated in preferences)
- image list must be paginated, with at least 5 elements per page

## own local installation indications

Prerequisites:

Install Git on your machine if you haven't already done so.
Install a local PHP environment like XAMPP or WAMP.
Install Composer (PHP dependency manager).
Have a local MySQL server up and running. This is typically included when you install XAMPP or WAMP.
Steps:

Clone the GitHub repository: Open a terminal and navigate to the directory where you want to install the project. Clone the repository with the following command:

bash
Copy code
git clone https://github.com/pawaters/pic-sharing-social-network.git
Navigate to the project directory:

bash
Copy code
cd pic-sharing-social-network
Install dependencies using Composer: Run the following command in your project directory to install the necessary dependencies:

Copy code
composer install
Configure your database connection: You need to change the database.php file to connect to your local MySQL server instead of the remote one. Here's a modified version of database.php that should work with a standard XAMPP setup:

php
Copy code
<?php
    $DB_DSN = 'mysql:host=localhost;dbname=pic_share';
    $DB_USER = 'root';
    $DB_PASSWORD = '';
    $DB_HOST = 'mysql:host=localhost'; 
?>
These settings assume that your MySQL server is running on localhost, that you want to use a database named pic_share, and that the username and password for your MySQL server are root and an empty string respectively. Modify these settings as needed for your specific MySQL setup.

Create your local database: Before you can run the setup.php script, you need to create a new MySQL database on your local server named pic_share. You can do this using phpMyAdmin (included in XAMPP and WAMP) or any other MySQL client.

Run the setup script: The setup.php script creates the necessary tables in the database. You should be able to run this script by navigating to it in your web browser (e.g., http://localhost/pic-sharing-social-network/setup.php). If there are any errors, they will be printed on the page.

Test the installation: Finally, test the project by opening your web browser and navigating to http://localhost/pic-sharing-social-network (or whatever URL corresponds to the local server configuration you're using). You should see the home page of your application.

Project was made with heroku initially, and heroku had to be deactivated to not rack up costs.
Local setup would use composer.json for dependencies, and redefi
I recommend to connect with an already existing user:
- username: PierreA1
- password: Matcha1!
