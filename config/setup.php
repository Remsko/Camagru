<?php
    include("database.php");

    try {
		$db = new PDO($DB_DSN.';'.$DB_NAME, $DB_USER, $DB_PASSWORD, []);
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$db->exec('DROP DATABASE camagru');
	} 
	catch (PDOException $e) {
		try {
			$db = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
		}
		catch (PDOException $e) {
			echo "Connection failed (creation): " . $e->getMessage();
			die();
		}
	}
	try {
		$newTables = file_get_contents('config/setup.sql');
		$db->exec($newTables);
	}
	catch (PDOException $e) {
		echo "Connection failed (filling): " . $e->getMessage();
		die();
	}
	
?>