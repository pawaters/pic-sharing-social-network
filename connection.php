<?php
    //to change when applying PDO everywhere based on https://github.com/Microsmosis/Camagru-42/blob/master/php/comments.php
    $conn = mysqli_connect("localhost", "root", "rootroot", "php_project")
        or die("DB connection failed");

    function connect()
	{
        $DB_DSN = 'mysql:host=localhost;dbname=php_project';
        $DB_USER = 'root';
        $DB_PASSWORD = 'rootroot';
        $DB_HOST = 'mysql:host=localhost';
		try
		{
			$conn = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		}
		catch(PDOException $e)
		{
			echo "Connection failed: " . $e->getMessage();
		}
		return ($conn);
	}

?>