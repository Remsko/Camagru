<?php
    include("database.php");

    try {
		$db = new PDO($DB_DSN.';'.$DB_NAME, $DB_USER, $DB_PASSWORD, []);
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$db->exec('DROP DATABASE camagru');

		$db = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
		$newTables = file_get_contents('config/setup.sql');
		$db->exec($newTables);
	} 
	catch (PDOException $e) {
		echo "Connection failed: " . $e->getMessage();
		die();
	}
	
?>