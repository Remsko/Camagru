<?php
    include("database.php");

    try {
		$db = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD, '');
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$newDb = "CREATE DATABASE IF NOT EXISTS CAMAGRU DEFAULT CHARACTER SET utf8"; 
		$db->exec($newDb);
	} 
	catch (PDOException $e) {
        echo "Connection failed (creation): " . $e->getMessage();
        die();
	}
	try {
		$db = new PDO($DB_DSN. ';' .$DB_NAME, $DB_USER, $DB_PASSWORD, '');
		$newUsersTable = "CREATE TABLE IF NOT EXISTS Users(
			id smallint(5) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
			username VARCHAR(15) NOT NULL,
			mail VARCHAR(30) NOT NULL,
			password VARCHAR(150) NOT NULL
		)";
		$db->exec($newUsersTable);
		$newImagesTable = "CREATE TABLE IF NOT EXISTS Images(
			id smallint(5) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
			name VARCHAR(15) NOT NULL,
	    	username VARCHAR(50) NOT NULL,
	    	type VARCHAR(25) NOT NULL,
	    	descrip text NOT NULL,
	    	img_blob longblob NOT NULL
		)";
		$db->exec($newImagesTable);
	}
	catch (PDOException $e) {
		echo "Connection failed (filling): " . $e->getMessage();
		die();
	}
?>