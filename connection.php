<?php

    function connect_PDO()
	{
		$DB_DSN = 'mysql:host=eu-cdbr-west-03.cleardb.net;dbname=heroku_7d09d8625973b2e';
		$DB_USER = 'ba5f59dbcb8ee';
		$DB_PASSWORD = 'de2369e2';
		$DB_HOST = 'mysql:host=eu-cdbr-west-03.cleardb.net'; 
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