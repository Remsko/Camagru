<?php
    include("database.php");

    // Connexion to database
    try {
        $db = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //foreach($db->query('SELECT * from FOO') as $row) {
        //    print_r($row);
        //}
        //$db = null;
    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage() . "<br/>";
        die();
	}
	$db->exec("CREATE DATABASE USERS DEFAULT CHARACTER SET utf8");
?>