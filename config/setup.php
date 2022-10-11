<?php
	include("database.php");

	try
	{
		$conn = new PDO($DB_HOST, $DB_USER, $DB_PASSWORD);
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "CREATE DATABASE IF NOT EXISTS php_project";
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
		$sql = "CREATE TABLE IF NOT EXISTS `users` (
        `id` int(11) NOT NULL AUTO_INCREMENT,
        `username` varchar(500) NOT NULL,
        `password` varchar(50) NOT NULL,
        `email` varchar(50)  NOT NULL,
        `image` text DEFAULT '1.jpeg',
        `followers` int(11) DEFAULT 0,
        `following` int(11) DEFAULT 0,
        `posts` int(11) DEFAULT 0,
		`bio` varchar(1000)  DEFAULT 'default bio',
		`vkey` VARCHAR(45) NOT NULL, 
		`verified` TINYINT(1) NOT NULL DEFAULT '0',
		`createdate` TIMESTAMP(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6),
		`notify` TINYINT(1) NOT NULL DEFAULT '1',
        PRIMARY KEY (`id`)
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
            `id` int(11) NOT NULL AUTO_INCREMENT,
            `post_id` int(11) NOT NULL,
            `user_id` int(11) NOT NULL,
            `username` varchar(50) NOT NULL,
            `profile_image` text  NOT NULL,
            `comment_text` text  NOT NULL,
            `date` DATETIME  NOT NULL DEFAULT CURRENT_TIMESTAMP,
            PRIMARY KEY (`id`)
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
		$sql = "CREATE TABLE IF NOT EXISTS `followings` (
            `id` int(11) NOT NULL AUTO_INCREMENT,
            `user_id` int(11) NOT NULL,
            `other_user_id` int(11) NOT NULL,
              PRIMARY KEY (`id`)
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
		$sql = "CREATE TABLE IF NOT EXISTS `posts` (
            `id` int(11) NOT NULL AUTO_INCREMENT,
            `user_id` int(11) NOT NULL,
            `likes` int(11) NOT NULL,
            `image` text  NOT NULL,
            `caption` varchar(250) NOT NULL,
            `hashtags` varchar(250) NOT NULL,
            `date` DATETIME  NOT NULL DEFAULT CURRENT_TIMESTAMP,
            `username` varchar(50)  NOT NULL,
            `profile_image` text NOT NULL,
			`webcam` text NOT NULL,
            PRIMARY KEY (`id`) 
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
                `id` int(11) NOT NULL AUTO_INCREMENT,
                `user_id` int(11) NOT NULL,
                `post_id` int(11) NOT NULL,
                PRIMARY KEY (`id`)
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
			$sql = "CREATE TABLE IF NOT EXISTS `pwdReset` (
                pwdResetID int(11) PRIMARY KEY AUTO_INCREMENT NOT NULL,
                pwdResetEmail TEXT NOT NULL,
                pwdResetSelector TEXT NOT NULL,
                pwdResetToken LONGTEXT NOT NULL,
                pwdResetExpires TEXT NOT NULL
            )";
			$conn->exec($sql);
		}
		catch(PDOException $e)
		{
			echo $sql . "<br>" . $e->getMessage();
		}
		$conn = null;
?>