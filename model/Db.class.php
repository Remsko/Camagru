<?php
class Db {
    private static $_instance = null;

    public function getInstance() {
        if (!isset(sef::$_instance)) {
		    try {
                require_once('config/database.php');
                $options  = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];
			    self::$_instance = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD, $options);
		    }
		    catch (PDOException $e) {
                echo 'Connection to database failed: ' . $e->getMessage();
                die();
		    }
        }
        return self::$_instance;
    }
}