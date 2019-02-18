<?php
    include("database.php");

    // Connexion to database
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
	$db = null;
	$db = new PDO($DB_DSN.";dbname=CAMAGRU", $DB_USER, $DB_PASSWORD);
	$ntable = "CREATE TABLE Users (
	id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
	username VARCHAR(30) NOT NULL, 
	pseudo VARCHAR(30) NOT NULL, 
	email VARCHAR(30) NOT NULL, 
	password VARCHAR(30) NOT NULL
	)";
	$db->exec($ntable);
?>