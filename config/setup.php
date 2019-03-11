<?php
    include("database.php");

    // Connecion to database
    try {
		$db = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$ndb = "CREATE DATABASE IF NOT EXISTS CAMAGRU DEFAULT CHARACTER SET utf8"; 
		$db->exec($ndb);
	} 
	catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage() . "<br/>";
        die();
	}
	$db = new PDO($DB_DSN.$DB_NAME, $DB_USER, $DB_PASSWORD);
	$ntable = "CREATE TABLE IF NOT EXISTS Users (
	id smallint(5) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
	username VARCHAR(50) NOT NULL, 
	pseudo VARCHAR(50) NOT NULL, 
	email VARCHAR(30) NOT NULL, 
	password VARCHAR(30) NOT NULL
	)";
	$db->exec($ntable);
	$ntable = "CREATE TABLE IF NOT EXISTS Images (
	name INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    pseudo VARCHAR(50) NOT NULL,
    size VARCHAR(25) NOT NULL,
    type VARCHAR(25) NOT NULL,
    descrip VARCHAR(100) NOT NULL,
    img_blob BLOB NOT NULL
	)";
	$db->exec($ntable);
?>