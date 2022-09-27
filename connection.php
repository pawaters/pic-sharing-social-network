<?php
    // $conn = mysqli_connect("localhost", "root", "rootroot", "php_project")
    //     or die("DB connection failed");

    function connect_PDO()
	{
        $DB_DSN = 'mysql:host=localhost;dbname=php_project';
        $DB_USER = 'root';
        $DB_PASSWORD = 'rootroot';
        $DB_HOST = 'mysql:host=localhost';
		try
		{
			$conn_PDO = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
			$conn_PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		}
		catch(PDOException $e)
		{
			echo "Connection failed: " . $e->getMessage();
		}
		return ($conn_PDO);
	}

?>