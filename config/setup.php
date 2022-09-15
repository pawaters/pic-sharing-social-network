<?php
	include("database.php");

	try
	{
		$conn = new PDO($DB_HOST, $DB_USER, $DB_PASSWORD);
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "CREATE DATABASE IF NOT EXISTS user_db";
		$conn->exec($sql);
	}
	catch(PDOException $e)
	{
		echo $sql . "<br>" . $e->getMessage();
	}
	$conn = null;

	try
	{
		$conn = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "CREATE TABLE IF NOT EXISTS `user_info` (
		id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
		email VARCHAR(100) NOT NULL,
		userr_name VARCHAR(50) NOT NULL,
		pass_word VARCHAR(1000) NOT NULL,
		activation_code VARCHAR(255) NOT NULL,
		acti_stat int(11) NOT NULL,
		notif_stat int(11) NOT NULL,
		reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
		)";
		$conn->exec($sql);
	}
	catch(PDOException $e)
	{
		echo $sql . "<br>" . $e->getMessage();
	}
	$conn = null;

	try
	{
		$conn = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "CREATE TABLE IF NOT EXISTS `user_images` (
		id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
		img_path TEXT NOT NULL,
		img_name TEXT NOT NULL,
		img_user VARCHAR(50) NOT NULL,
		snap_shot INT(11) NOT NULL
		)";
		$conn->exec($sql);
	}
	catch(PDOException $e)
	{
		echo $sql . "<br>" . $e->getMessage();
	}
	$conn = null;
	
	try
	{
		$conn = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "CREATE TABLE IF NOT EXISTS `comments` (
		id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
		user VARCHAR(50) NOT NULL,
		msg VARCHAR(300) NOT NULL,
		img TEXT NOT NULL,
		submit_time DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
		)";
		$conn->exec($sql);
	}
	catch(PDOException $e)
	{
		echo $sql . "<br>" . $e->getMessage();
	}
	$conn = null;
	
	try
		{
			$conn = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = "CREATE TABLE IF NOT EXISTS `likes` (
			id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
			user VARCHAR(50) NOT NULL,
			img TEXT NOT NULL,
			submit_time DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
			)";
			$conn->exec($sql);
		}
		catch(PDOException $e)
		{
			echo $sql . "<br>" . $e->getMessage();
		}
		$conn = null;
?>